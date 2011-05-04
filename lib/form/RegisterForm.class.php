<?php

class RegisterForm extends sfGuardRegisterForm {
  public function configure()
  {
    unset($this['first_name'],$this['last_name'],$this['username'],$this['actions_list'],$this['opinions_list']);
    $this->getWidgetSchema()->setHelp('email_address','Enter your email address. This will be used as login name.');
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
  }
}