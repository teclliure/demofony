<?php

class RegisterForm extends sfGuardRegisterForm {
  public function configure()
  {
    unset($this['first_name'],$this['last_name'],$this['username'],$this['actions_list']);
    $this->getWidgetSchema()->setHelp('email_address','Enter your email address. This will be used as login name.');
  }
}