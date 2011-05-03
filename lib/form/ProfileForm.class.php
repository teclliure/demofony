<?php

class ProfileForm extends sfGuardRegisterForm {
  public function configure()
  {
    unset($this['email'],$this['password'],$this['password_again'],$this['email_address'],$this['actions_list'],$this['opinions_list']);
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
    
    $profileForm = new sfGuardUserProfileForm($this->getObject()->getProfile());
    unset($profileForm['user_id'],$profileForm['subscription_email'],$profileForm['categories_list'],$profileForm['regions_list']);
    $profileForm->widgetSchema->addFormFormatter('custom', $decorator);
    $profileForm->widgetSchema->setFormFormatterName('custom');
    $this->embedForm('profile', $profileForm);
    
    
  }
}