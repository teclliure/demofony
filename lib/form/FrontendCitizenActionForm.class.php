<?php

class FrontendCitizenActionForm extends CitizenActionForm {
  public function configure()
  {
    parent::configure();
    unset($this['active'],$this['user_id'],$this['categories_list'],$this['regions_list'],$this['users_list']);
  }
  
  protected function doUpdateObject($values)
  {
    $values['active'] = 0;
    $values['user_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getId();
    
    parent::doUpdateObject($values);
  }
}