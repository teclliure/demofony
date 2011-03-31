<?php
sfForm::disableCSRFProtection();

class Test1Form extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormInput(),
      'email' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorString(array('min_length' => 3, 'required' => true)),
      'email' => new sfValidatorEmail(array('required' => true)),
    ));

    $this->widgetSchema->setNameFormat('test1[%s]');
  }
}

class Test2Form extends Test1Form
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema->setNameFormat('test2[%s]');
  }
}

class Test3Form extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'phone' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'phone' => new sfValidatorString(array('min_length' => 3, 'required' => true)),
    ));

    $this->widgetSchema->setNameFormat('test3[%s]');
  }
}

class Test4Form extends Test3Form
{
  public function __construct($firstParameter = null, $secondParameter = null)
  {
    parent::__construct();

    if($firstParameter === null || $secondParameter === null)
    {
      throw new InvalidArgumentException('Both constructor\'s parameters are required.');
    }
  }
}

class StubPageableForm extends psPageableForm
{
  private $bindValues;

  public function __construct(array $values)
  {
    $this->setValues($values);
  }

  public function setValues(array $values)
  {
    $this->bindValues = $values;
  }

  public function getValues()
  {
    return $this->bindValues;
  }
}