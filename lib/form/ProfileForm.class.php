<?php

class ProfileForm extends sfGuardRegisterForm {
  public function configure()
  {
    unset($this['email'],$this['username'],$this['email_address'],$this['actions_list'],$this['opinions_list']);
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
    
    $this->validatorSchema['first_name']->setOption('required', true);
    $this->validatorSchema['last_name']->setOption('required', true);
    
    $profileForm = new sfGuardUserProfileForm($this->getObject()->getProfile());
    unset($profileForm['user_id']);
    $profileForm->widgetSchema->addFormFormatter('custom', $decorator);
    $profileForm->widgetSchema->setFormFormatterName('custom');
    $this->embedForm('profile', $profileForm);
  }
}