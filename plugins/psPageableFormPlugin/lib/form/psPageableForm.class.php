<?php

/**
 * Class of pageable form
 *
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class psPageableForm implements ArrayAccess
{
  private
    $forms = array(),
    $nameFormat = '%s',
    $useGlobalNamespace = true,
    $formsKeys = array(),
    $currentPage = null,
    $persistanceStrategy = null,
    $values = array(),
    $taintedValues = null,
    $taintedFiles = null,
    $isBound = false,
    $options = array();

  /**
   * @var sfValidatorErrorSchema
   */
  private $errorSchema = null;


  public function __construct(array $options = array())
  {
    $this->setOptions($options);

    $this->setup();
    $this->configure();
  }

  public function setOptions(array $options)
  {
    foreach($options as $name => $value)
    {
      $this->setOption($name, $value);
    }
  }

  public function setOption($name, $value)
  {
    $this->options[$name] = $value;
  }

  /**
   * template method, called in the end of constructor
   */
  public function setup()
  {
  }

  /**
   * template method, called after setup()
   */
  public function configure()
  {
  }

  public function getOption($name, $default = null)
  {
    return isset($this->options[$name]) ? $this->options[$name] : $default;
  }

  public function setCurrentPageNumber($page)
  {
    $page = $this->filterPageNumber($page);
    $this->currentPage = $page;
  }

  private function filterPageNumber($page)
  {
    $page = (int) $page;

    return $page;
  }


  public function getNumberOfForms()
  {
    return count($this->forms);
  }

  public function getCurrentPageNumber()
  {
    if($this->currentPage === null)
    {
      throw new LogicException('You must set current page number previously.');
    }

    return $this->currentPage;
  }

  /**
   * @return sfForm First form which dosn't pass validation. If all of forms are valid or multiform isn't bound, it return null.
   */
  public function getFirstInvalidForm()
  {
    $count = $this->getNumberOfForms();
    for($i=0; $i<$count; $i++)
    {
      $form = $this->getAndCreateFormIfNecessary($i);
      if(!$form->isValid())
        return $form;
    }

    return null;
  }

  /**
   * Added form is form from last page. First added form = first page.
   *
   * Option "page" (page number for this form) is set on every added form. Also name format is changed.
   *
   * @param sfForm|string|array $form Form to add or form's creation data
   */
  public function addForm($form)
  {
    $this->doSetForm($form, $this->getNumberOfForms());
  }

  private function doSetForm($form, $index, $setNameFormat = true)
  {
    if(is_string($form))
    {
      $form = array('class' => $form, 'arguments' => array());
    }
    
    if(!$form instanceof sfForm && is_array($form) && (!isset($form['class']) || !is_string($form['class'])))
    {
      throw new InvalidArgumentException(sprintf('Invalid format of form\'s creation array, there no "class" element or this element isn\'t a string.'));
    }
    elseif(!is_array($form) && !$form instanceof sfForm)
    {
      throw new InvalidArgumentException('Form object must extends sfForm class.');
    }
    
    $this->forms[$index] = $form;
    
    if($form instanceof sfForm)
    {
      $form->setOption('page', $this->convertIndexToPageNumber($index));

      if($setNameFormat)
      {
        $this->setFormNameFormat($form);
      }
    }
  }

  public function setForm($form, $page)
  {
    $index = $this->convertPageNumberToIndex($page);

    for($i = $this->getNumberOfForms() - 1; $i >= $index; $i--)
    {
      $newIndex = $i+1;
      $this->doSetForm($this->forms[$i], $newIndex, false);
      $this->form[$i] = null;
    }

    $this->doSetForm($form, $index);
  }

  private function convertIndexToPageNumber($index)
  {
    return ($index+1);
  }

  private function setFormNameFormat(sfForm $form)
  {
    if($this->shouldBeUsedGlobalNamespace($form))
    {
      $form->getWidgetSchema()->setNameFormat($this->getNameFormat());
    }
    else
    {
      $format = $form->getWidgetSchema()->getNameFormat();
      $format = sprintf($this->getNameFormat(), substr($format, 0, $k = strpos($format, '['))).substr($format, $k);
      $form->getWidgetSchema()->setNameFormat($format);
    }
  }

  private function shouldBeUsedGlobalNamespace(sfForm $form)
  {
    return ((bool) ($this->isUseGlobalNamespace() || !$this->hasNameFormat($form)));
  }

  private function hasNameFormat(sfForm $form)
  {
    $format = $form->getWidgetSchema()->getNameFormat();

    return ((bool) substr($format, 0, strpos($format, '[')));
  }

  public function setForms(array $forms)
  {
    $this->forms = array();
    $this->formsKeys = array();
    $this->currentPage = null;

    $this->addForms($forms);
  }

  /**
   * Adds forms to the end of the chain.
   *
   * @see addForm()
   * @param array $forms Tablica obiektów sfForm
   */
  public function addForms(array $forms)
  {
    $count = count($forms);
    for($i=0; $i<$count; $i++)
    {
      $this->addForm($forms[$i]);
    }
  }

  /**
   * Merge pageable form with another.
   *
   * All name formats of subforms of $pageableForm are changed if form,
   * which is subject of merge, has global namespace (@see isUseGlobalNamespace())
   *
   * @param psPageableForm $pageableForm
   */
  public function mergeForm(psPageableForm $pageableForm)
  {
    $this->addForms($pageableForm->getForms());
  }

  /**
   * Embed pageable form into this form.
   *
   * @todo To implementation
   */
  public function embedForm(psPageableForm $pageableForm)
  {
    throw new BadMethodCallException('Method have not been yet implement.');
  }

  /**
   * @return sfForm
   */
  public function getForm($page)
  {
    $index = $this->convertPageNumberToIndex($page);

    return $this->getAndCreateFormIfNecessary($index);
  }

  private function getAndCreateFormIfNecessary($index)
  {
    if(is_string($this->forms[$index]))
    {
      $this->forms[$index] = array(
          'class' => $this->forms[$index],
          'arguments' => array(),
      );
    }

    if(is_array($this->forms[$index]))
    {
      $formCreationData = $this->forms[$index];
      $reflectionClass = new ReflectionClass($formCreationData['class']);
      $arguments = $formCreationData['arguments'];
      $form = $reflectionClass->newInstanceArgs($arguments);

      if(!$form instanceof sfForm)
      {
        throw new InvalidArgumentException(sprintf('Class "%s" dosn\'t extend sfForm', $formCreationData['class']));
      }

      $this->forms[$index] = $form;
      $this->setFormNameFormat($form);

      $form->setOption('page', $this->convertIndexToPageNumber($index));
    }

    return $this->forms[$index];
  }

  private function convertPageNumberToIndex($page)
  {
    return ($this->filterPageNumber($page) - 1);
  }

  /**
   * Returns subset of the forms.
   *
   * If $page is null, it returns all of forms, else if $page is integer, it returns forms for less pages.
   *
   * @param int $page Page number of the first form, which dosn't be returned.
   * @return array Subset of form array
   */
  public function getForms($page = null)
  {
    $forms = array();

    if(is_null($page))
    {
      $forms = $this->forms;
    }
    else
    {
      $index = $this->convertPageNumberToIndex($page);

      for($i=0; $i < $index; $i++)
      {
        $forms[$i] = $this->forms[$i];
      }
    }

    $count = count($forms);
    for($i=0; $i<$count; $i++)
    {
      $this->forms[$i] = $forms[$i] = $this->getAndCreateFormIfNecessary($i);
    }

    return $forms;
  }

  /**
   * @return sfForm Form object from current page
   * @throws LogicException Page number isn't set
   * @throws OutOfBoundsException Form for current page dosn't exists or forms array is empty.
   */
  public function getCurrentForm()
  {
    $index = $this->convertPageNumberToIndex($this->getCurrentPageNumber());
    if(!isset($this->forms[$index]))
    {
      throw new OutOfBoundsException(sprintf('Multipage form %s haven\'t form for %d page.', get_class($this), $this->getCurrentPageNumber()));
    }

    if(count($this->forms) > 0)
    {
      return $this->getAndCreateFormIfNecessary($index);
    }

    throw new OutOfBoundsException(sprintf('Multipage form %s is empty.', get_class($this)));
  }

  /**
   * @return psPageableFormPersistanceStrategy Persistance strategy object. If this property is empty, it returns post persistance strategy as default.
   */
  public function getPersistanceStrategy()
  {
    if(is_null($this->persistanceStrategy))
    {
      $this->persistanceStrategy = new psPageableFormPostPersistanceStrategy();
    }

    return $this->persistanceStrategy;
  }

  /**
   * @param psPageableFormPersistanceStrategy $strategy Persistance strategy object
   */
  public function setPersistanceStrategy(psPageableFormPersistanceStrategy $strategy)
  {
    $this->persistanceStrategy = $strategy;
  }

  /**
   * Persist data between two requests.
   *
   * @return mixed
   */
  public function persist()
  {
    $strategy = $this->getPersistanceStrategy();

    return $strategy->persist($this);
  }

  /**
   * Bind forms only from previous pages without current form. For example after sending second form (current page is 3),
   * only second and first form will be bound.
   *
   * @param array $taintedValues
   * @param array $taintedFiles
   */
  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    if($this->getCurrentPageNumber() > $this->getNumberOfForms()+1 || $this->getCurrentPageNumber() < 1)
    {
      throw new InvalidArgumentException(sprintf('"%s" - invalid page value for form %s, possible value from 1 to %d', $this->getCurrentPageNumber(), get_class($this), count($this->forms)+1));
    }

    $this->taintedValues = $taintedValues;
    $this->taintedFiles  = $taintedFiles;
    $this->resetFormState();

    $index = $this->convertPageNumberToIndex($this->getCurrentPageNumber());

    //binds all previous form without current form
    for($i=0; $i < $index; $i++)
    {
      $iterationForm = $this->getAndCreateFormIfNecessary($i);
      $this->bindForm($iterationForm, $taintedValues,$taintedFiles);
      $this->addValuesFromForm($iterationForm);

      if(!$iterationForm->isValid())
      {
        break;
      }
    }

    if($this->getCurrentPageNumber() <= $this->getNumberOfForms())
    {
      $defaultValues = $this->getValuesForForm($this->getCurrentForm(), $taintedValues);
      $form = $this->getCurrentForm();
      $form->setDefaults(array_merge($form->getDefaults(), $this->removeEmptyValues($defaultValues)));
    }
  }

  private function resetFormState()
  {
    $this->values = array();
    $this->isBound = true;
    $this->errorSchema = new sfValidatorErrorSchema(new sfValidatorSchema());
  }

  private function bindForm(sfForm $form, array $taintedValues, array $taintedFiles)
  {
    $values = $this->getValuesForForm($form, $taintedValues);
    if ($form->isMultipart() && $taintedFiles) {
      //print_r ($values); print_r ($taintedFiles); print $form->getName(); print_r($this->getFormKeyNames($form)); exit();
      $formKeyName = $this->getFormKeyNames($form);
      $formKeyName = $formKeyName[0];
      $form->bind($values, $taintedFiles[$formKeyName]);
    }
    else {
      $form->bind($values);
    }

    //pass possible validation errors
    $this->errorSchema->addErrors($form->getErrorSchema()->getErrors());
  }

  public function getErrorSchema()
  {
    return $this->errorSchema;
  }

  /**
   * Returns subset of values for $form
   *
   * This method can be overwrite if for example you build shema of one of
   * form in runtime based on passed values.
   */
  protected function getValuesForForm(sfForm $form, array $values)
  {
    if($keys = $this->getFormKeyNamesIfNoUseGlobalNamespace($form))
    {
      $values = $this->getValuesByKeyNames($values, $keys);

      $valuesCurrent = $this->buildValuesForForm($form, $values);
    }
    else
    {
      $valuesCurrent = $this->buildValuesForForm($form, $values);
    }

    return $valuesCurrent;
  }
  
  private function &getValuesByKeyNames(array &$values, array $keys)
  {
      $i=0;
      $count = count($keys);

      do
      {
        $key = $keys[$i];
        if(!isset($values[$key]))
        {
          $values[$key] = array();
        }

        $values =& $values[$key];

        $i++;
      }
      while($i<$count);

      return $values;
  }

  private function getFormKeyNamesIfNoUseGlobalNamespace(sfForm $form)
  {
    return ($this->isUseGlobalNamespace() ? false : $this->getFormKeyNames($form));
  }

  private function buildValuesForForm(sfForm $form, array $values)
  {
    $fields = $form->getWidgetSchema()->getFields();

    $valuesCurrent = array();
    foreach($fields as $key => $field)
    {
      $valuesCurrent[$key] = isset($values[$key]) ? $values[$key] : null;
    }

    return $valuesCurrent;
  }

  private function addValuesFromForm(sfForm $form)
  {
    $values = $form->getValues();

    if($keys = $this->getFormKeyNamesIfNoUseGlobalNamespace($form))
    {
      $thisValues =& $this->getValuesByKeyNames($this->values, $keys);
      $thisValues = array_merge($values, $thisValues);
    }
    else
    {
      $this->values = array_merge($values, (array)$this->values);
    }
  }
  

  private function removeEmptyValues(array $values)
  {
    foreach($values as $name => $value)
    {
      if(empty($value))
      {
        unset($values[$name]);
      }
    }

    return $values;
  }

  /**
   * Returns array of base keys for $form.
   *
   * For example if form has namespace1[namespace2][%s] name forma, key names are array('namespace1', 'namespace2')
   */
  private function getFormKeyNames(sfForm $form)
  {
    $formIndex = $form->getOption('page');
    if(!isset($this->formsKeys[$formIndex]))
    {
      $format = $form->getWidgetSchema()->getNameFormat();
      $this->formsKeys[$formIndex] = $this->buildFormKeyNames($format);
    }

    return $this->formsKeys[$formIndex];
  }

  private function buildFormKeyNames($format)
  {
    $format = substr($format, strpos($this->getNameFormat(), '['));

    $c = strpos($format, '[%s]');
    $key = $c ? explode('][', trim(substr($format, 0, $c), '[]')) : array();

    return $key;
  }

  /**
   * @return boolean All of validated forms are valid?
   */
  public function isValid()
  {
    $valid =  $this->isBound ? count($this->errorSchema) == 0 : false;

    if($valid)
    {
      $this->persist();
    }

    return $valid;
  }

  /**
   * @return array All validated and cleaned values
   */
  public function getValues()
  {
    return $this->values;
  }
  

  /**
   * @param string $name Value name
   * @return mixed Clean value
   */
  public function getValue($name)
  {
    return isset($this->values[$name]) ? $this->values[$name] : null;
  }

  public function getTaintedValues()
  {
    return $this->taintedValues;
  }

  public function getTaintedFiles()
  {
    return $this->taintedFiles();
  }

  /**
   * Sets name format for form elements.
   *
   * @param string $format It must contain "%s"
   * @throws InvalidArgumentException Passed $format dosn't contain "%s"
   */
  public function setNameFormat($format)
  {
    $format = (string) $format;
    if(!strpos($format, '%s'))
      throw new InvalidArgumentException("Format \"$format\" dosn't contain \"%s\".");

    $this->nameFormat = (string) $format;
  }

  public function isUseGlobalNamespace()
  {
    return $this->useGlobalNamespace;
  }

  public function setUseGlobalNamespace($bool)
  {
    $this->useGlobalNamespace = (boolean) $bool;
  }

  /**
   * @return string Forms name format
   */
  public function getNameFormat()
  {
    return $this->nameFormat;
  }

  /**
   * Access to current form fields via ArrayAccess interface
   *
   * @param $name
   * @return sfFormField
   */
  public function offsetGet($name)
  {
    $form = $this->getCurrentForm();
    return $form[$name];
  }

  public function offsetExists($name)
  {
    $form = $this->getCurrentForm();
    return isset($form[$name]);
  }

  public function offsetSet($name, $value)
  {
    $form = $this->getCurrentForm();

    $form[$name] = $value;
  }

  public function offsetUnset($name)
  {
    $form = $this->getCurrentForm();

    unset($form[$name]);
  }

  public function reset()
  {
    $this->values = array();
    $this->errorSchema = null;
    $this->currentPage = null;
    $this->forms = array();
    $this->isBound = false;
    $this->formsKeys = array();
    $this->options = array();
    $this->persistanceStrategy = null;
    $this->taintedFiles = null;
    $this->taintedValues = null;
  }

  public function __clone()
  {
    foreach($this->forms as $index => $form)
    {
      $this->forms[$index] = clone $form;
    }
  }

  /**
   * Try to call current form method, if fails, exception will be thrown.
   *
   * @throws BadMethodCallException Method dosn't exist
   */
  public function __call($method, $args)
  {
    try
    {
      $form = $this->getCurrentForm();
      if(method_exists($form, $method))
      {
        return call_user_func_array(array($form, $method), $args);
      }
    }
    catch(Exception $e)
    {
    }

    throw new BadMethodCallException(sprintf('Method %s::%s() dosn\'t exist and were catch in %s:__call() method.', get_class($this), $method, get_class($this)));
  }
}
