<?php

class ProfileForm extends sfGuardRegisterForm {
  public function configure()
  {
    unset($this['email'],$this['password'],$this['password_again'],$this['email_address'],$this['actions_list']);
    
    $profileForm = new sfGuardUserProfileForm($this->getObject()->getProfile());
    unset($profileForm['user_id'],$profileForm['subscription_email'],$profileForm['categories_list'],$profileForm['regions_list']);
    $this->embedForm('Profile', $profileForm);
  }
}