<?php
class FrontendContactForm extends BaseForm
{

  public function configure()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormInputText(),
      'email'   => new sfWidgetFormInputText(),
      'message' => new sfWidgetFormTextarea(),
    ));
    
    $this->setValidators(array(
      'name'    => new sfValidatorString(array('required' => false)),
      'email'   => new sfValidatorEmail(),
      'message' => new sfValidatorString(array('min_length' => 4)),
    ));
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
    
    $this->widgetSchema->setNameFormat('contact[%s]');
  }
}