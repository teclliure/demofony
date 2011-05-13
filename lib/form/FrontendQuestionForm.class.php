<?php

class FrontendQuestionForm extends VirtualMeetingQuestionForm {
  public function configure()
  {
    parent::configure();
    unset($this['active'],$this['user_id']);
    
    $this->setWidget('virtual_meeting_id',new sfWidgetFormInputHidden());
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
  }
  
  protected function doUpdateObject($values)
  {
    $values['active'] = 0;
    $values['user_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getId();
    
    parent::doUpdateObject($values);
  }
}