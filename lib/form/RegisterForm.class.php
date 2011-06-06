<?php

class RegisterForm extends sfGuardRegisterForm {
  public function configure()
  {
    unset($this['first_name'],$this['last_name'],$this['actions_list'],$this['opinions_list']);
    $this->getWidgetSchema()->setHelp('email_address','Enter your email address. This can be used as login name like username.');
    
    $this->setWidget('captcha', new sfWidgetFormReCaptcha(array('public_key'=>sfConfig::get('app_recaptcha_public_key')), array('required'=> false)));
    $this->setValidator('captcha', new sfValidatorReCaptcha(array('required'=>false,'private_key' => sfConfig::get('app_recaptcha_private_key'))));
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
  }
}