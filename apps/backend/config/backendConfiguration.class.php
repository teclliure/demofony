<?php

class backendConfiguration extends sfApplicationConfiguration
{
  protected $frontendRouting = null;
  
  public function configure()
  {
    $this->dispatcher->connect('routing.load_configuration', array('vjCommentRouting', 'addRouteForAdminComments'));
    $this->dispatcher->connect('routing.load_configuration', array('vjCommentRouting', 'addRouteForAdminReportedComments'));
    //sfWidgetFormSchema::setDefaultFormFormatterName('Div');
  }
 
  public function generateFrontendUrl($url)
  {
    return sfContext::getInstance()->getRequest()->getRelativeUrlRoot().$this->genUrl($url);
  }
 
  public function getFrontendRouting()
  {
    if (!$this->frontendRouting)
    {
      $this->frontendRouting = new sfPatternRouting(new sfEventDispatcher());
 
      $config = new sfRoutingConfigHandler();
      $routes = $config->evaluate(array(sfConfig::get('sf_apps_dir').'/frontend/config/routing.yml'));
 
      $this->frontendRouting->setRoutes($routes);
    }
 
    return $this->frontendRouting;
  }
  
 /**
   * Generates an URL from an array of parameters.
   *
   * @param mixed   $parameters An associative array of URL parameters or an internal URI as a string.
   * @param boolean $absolute   Whether to generate an absolute URL
   *
   * @return string A URL to a symfony resource
   */
  public function genUrl($parameters = array(), $absolute = false)
  {
    $route = '';
    $fragment = '';

    if (is_string($parameters))
    {
      // absolute URL or symfony URL?
      if (preg_match('#^[a-z][a-z0-9\+.\-]*\://#i', $parameters))
      {
        return $parameters;
      }

      // relative URL?
      if (0 === strpos($parameters, '/'))
      {
        return $parameters;
      }

      if ($parameters == '#')
      {
        return $parameters;
      }
  
      // strip fragment
      if (false !== ($pos = strpos($parameters, '#')))
      {
        $fragment = substr($parameters, $pos + 1);
        $parameters = substr($parameters, 0, $pos);
      }

      list($route, $parameters) = $this->convertUrlStringToParameters($parameters);
    }
    else if (is_array($parameters))
    {
      if (isset($parameters['sf_route']))
      {
        $route = $parameters['sf_route'];
        unset($parameters['sf_route']);
      }
    }

    // routing to generate path
    $url = $this->getFrontendRouting()->generate($route, $parameters, $absolute);

    if ($fragment)
    {
      $url .= '#'.$fragment;
    }

    return $url;
  }

  /**
   * Converts an internal URI string to an array of parameters.
   *
   * @param string $url An internal URI
   *
   * @return array An array of parameters
   */
  public function convertUrlStringToParameters($url)
  {
    $givenUrl = $url;

    $params = array();
    $queryString = '';
    $route = '';

    // empty url?
    if (!$url)
    {
      $url = '/';
    }

    // we get the query string out of the url
    if ($pos = strpos($url, '?'))
    {
      $queryString = substr($url, $pos + 1);
      $url = substr($url, 0, $pos);
    }

    // 2 url forms
    // @routeName?key1=value1&key2=value2...
    // module/action?key1=value1&key2=value2...

    // first slash optional
    if ($url[0] == '/')
    {
      $url = substr($url, 1);
    }

    // routeName?
    if ($url[0] == '@')
    {
      $route = substr($url, 1);
    }
    else if (false !== strpos($url, '/'))
    {
      list($params['module'], $params['action']) = explode('/', $url);
    }
    else if (!$queryString)
    {
      $route = $givenUrl;
    }
    else
    {
      throw new InvalidArgumentException(sprintf('An internal URI must contain a module and an action (module/action) ("%s" given).', $givenUrl));
    }

    // split the query string
    if ($queryString)
    {
      $matched = preg_match_all('/
        ([^&=]+)            # key
        =                   # =
        (.*?)               # value
        (?:
          (?=&[^&=]+=) | $  # followed by another key= or the end of the string
        )
      /x', $queryString, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);
      foreach ($matches as $match)
      {
        $params[urldecode($match[1][0])] = urldecode($match[2][0]);
      }

      // check that all string is matched
      if (!$matched)
      {
        throw new sfParseException(sprintf('Unable to parse query string "%s".', $queryString));
      }
    }

    return array($route, $params);
  }
}
