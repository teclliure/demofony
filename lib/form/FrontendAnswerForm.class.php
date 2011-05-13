<?php

class FrontendAnswerForm extends VirtualMeetingAnswerForm {
  public function configure()
  {
    parent::configure();
    
    $this->setWidget('virtual_meeting_question_id',new sfWidgetFormInputHidden());
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
  }
}