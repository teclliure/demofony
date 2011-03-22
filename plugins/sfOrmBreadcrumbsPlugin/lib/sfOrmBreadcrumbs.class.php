<?php

/**
 * sfOrmBreadcrumbs
 * 
 * @package    sfOrmBreadcrumbsPlugin
 * @subpackage lib
 * @author     Nicolò Pignatelli <info@nicolopignatelli.com>
 * @version    SVN: $Id: sfOrmBreadcrumbs.class.php 32238 2011-03-11 22:51:28Z gimler $
 */
abstract class sfOrmBreadcrumbs 
{
  protected $config = null;
  protected $module = null;
  protected $action = null; 
  protected $breadcrumbs = array();

  abstract protected function buildBreadcrumb($v);

  public function __construct($module, $action)
  {
    $this->module = $module;
    $this->action = $action;

    $this->getConfig();
    $this->buildBreadcrumbs();
  }

  public function getConfig()
  {
    if($this->config == null)
    {
      $file = sfConfig::get('sf_app_config_dir').'/breadcrumbs.yml';
      $yml = sfYamlConfigHandler::parseYaml($file);
      sfConfig::add($yml);

      $this->config = sfConfig::get('sf_orm_breadcrumbs');
    }

    return $this->config;
  }

  public function getBreadcrumbs()
  {
    return $this->breadcrumbs;
  }

  public function getSeparator()
  {
    $config = $this->getConfig();

    return isset($config['_separator']) ? $config['_separator'] : '>';
  }

  public function getI18nCatalogue()
  {
    $config = $this->getConfig();

    return isset($config['_i18n_catalogue']) ? $config['_i18n_catalogue'] : 'breadcrumb';
  }

  protected function buildBreadcrumbs()
  {
    if(isset($this->config[$this->module]) && isset($this->config[$this->module][$this->action]))
    {
      $breadcrumbs_struct = $this->config[$this->module][$this->action];
    }
    else
    {
      $breadcrumbs_struct = array();
    }

    if(count($breadcrumbs_struct) > 0)
    {
      foreach($breadcrumbs_struct as $item)
      {
        $this->breadcrumbs[] = $this->buildBreadcrumb($item);
      }
    }
    else
    {
      $lost = isset($this->config['_lost']) ? $this->config['_lost'] : 'somewhere...';
      $this->breadcrumbs = array(array('name' => $lost, 'url' => null));
    }

    if(isset($this->config['_root']))
    {
      array_unshift($this->breadcrumbs, $this->buildBreadcrumb($this->config['_root']));
    }
  }

  protected function getCaseForItem($item)
  {
    $case = isset($item['case']) ? $item['case'] : null;

    if($case == null)
    {
      $config = $this->getConfig();
      $case = isset($config['_default_case']) ? $config['_default_case'] : null;
    }

    return $case;
  }

  protected function switchCase($name, $case)
  {
    switch($case)
    {
      case 'ucfirst':
        $name = ucfirst(mb_strtolower($name,'UTF-8'));
        break;

      case 'lcfirst':
        $name = lcfirst(mb_strtolower($name,'UTF-8'));
        break;

      case 'strtolower':
        $name = mb_strtolower($name,'UTF-8');
        break;

      case 'strtoupper':
        $name = mb_strtoupper($name,'UTF-8');
        break;

      case 'ucwords':
        $name = ucwords(mb_strtolower($name,'UTF-8'));
        break;
    }

    return $name;
  } 
}