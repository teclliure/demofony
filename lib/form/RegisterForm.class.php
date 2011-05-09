<?php

class RegisterForm extends sfGuardRegisterForm {
  public function configure()
  {
    unset($this['first_name'],$this['last_name'],$this['actions_list'],$this['opinions_list']);
    $this->getWidgetSchema()->setHelp('email_address','Enter your email address. This can be used as login name like username.');
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
  }
}