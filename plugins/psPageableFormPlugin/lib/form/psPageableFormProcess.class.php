<?php

/**
 * Manager of pageable form.
 *
 * Responsibilities:
 * * bind and validate form
 * * set form right status after bad validation
 * * set form right status when form shouldn't be validated (request method isn't post)
 * * call callback when form is fully valid
 *
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class psPageableFormProcess
{
  private
    $form = null,
    $request = null;

  private $options = array(
    'formParameterName' => null, //request parameter name
    'pageParameterName' => 'step',
  );

  private $invalidForm = false;
  private $valuesProvides = false;

  /**
   * @param psPageableForm $form Pageable form object
   * @param array|ArrayAccess $request Request parameters, array or sfRequest object may be passed
   * @param array $options
   * @param bool New values are provide to pageable form? This means usually request method is post or put
   */
  public function __construct(psPageableForm $form, $request, array $options = array(), $valuesProvides = false)
  {
    if(!is_array($request) && !$request instanceof ArrayAccess)
    {
      throw new InvalidArgumentException('Request parameter should be array or object of ArrayAcces type.');
    }

    $this->form = $form;
    $this->request = $request;
    $this->valuesProvides = $valuesProvides;

    if(class_exists('sfWebRequest') && $request instanceof sfWebRequest && $request->isMethod('post'))
    {
      $this->valuesProvides = true;
    }

    $this->setOptions($options);
  }

  /**
   * Process pageable form
   *
   * @return bool True if form is fully valid (all of subforms are validated), otherwise false
   */
  public function process()
  {
    $key = $this->options['pageParameterName'];
    $page = (int) $this->getRequestParameter($key, 1);
    $this->form->setCurrentPageNumber($page);

    if($this->valuesProvides)
    {
      return $this->bindAndValidate($page);
    }
    else
    {
      $this->processFormState();
    }

    return false;
  }

  private function getRequestParameter($name, $default = null)
  {
    $value = (isset($this->request[$name]) ? $this->request[$name] : $default);
    return $value;
  }

  private function setRequestParameter($name, $value)
  {
    $this->request[$name] = $value;
  }

  private function bindAndValidate($page)
  {
    if(!$this->invalidForm)
    {
      $this->bindForm();
      if(!$this->form->isValid())
      {
        $this->processInvalidForm();
      }
      elseif($page > $this->form->getNumberOfForms())
      {
        $this->form->getPersistanceStrategy()->clear();

        return true;
      }
    }

    return false;
  }

  private function bindForm()
  {
    $key = $this->options['pageParameterName'];
    $page = (int) $this->getRequestParameter($key, 1);
    $values = $this->mergeValues($this->form->getPersistanceStrategy()->getValues(), (array) $this->getRequestParameter($this->options['formParameterName']));
   
    $this->form->bind($values,(array) $this->request->getFiles($this->options['formParameterName']));
  }

  private function mergeValues($values1, $values2)
  {
    foreach($values2 as $key => $value)
    {
      if(is_int($key))
      {
        $values1 = $values2;
      }
      elseif(is_array($value))
      {
        $value = $this->mergeValues(isset($values1[$key]) ? $values1[$key] : array(), $value);
        $values1[$key] = $value;
      }
      else
      {
        $values1[$key] = $value;
      }
    }

    return $values1;
  }

  private function processInvalidForm()
  {
    $page = $this->form->getFirstInvalidForm()->getOption('page');
    $this->setRequestParameter($this->options['pageParameterName'], $page);
    $this->invalidForm = true;

    return $this->process();
  }

  private function processFormState()
  {
    if($this->form->getCurrentPageNumber() != 1)
    {
      $this->form->bind($this->form->getPersistanceStrategy()->getValues());

      if($this->form->getCurrentPageNumber() != 1 && !$this->form->isValid())
      {
        $this->form->setCurrentPageNumber($this->form->getFirstInvalidForm()->getOption('page'));
      }
      else
      {
        $this->form->setCurrentPageNumber($this->form->getCurrentPageNumber() - 1);
      }
    }
  }

  protected function setOptions(array $options)
  {
    foreach($this->options as $key => $value)
    {
      if(is_null($value) && !isset($options[$key]))
      {
        throw new InvalidArgumentException(sprintf('Option "%s" is required.', $key));
      }

      if(isset($options[$key]))
      {
        $this->options[$key] = $options[$key];
      }
    }
  }

  public function reset()
  {
    $this->invalidForm = false;
  }
}