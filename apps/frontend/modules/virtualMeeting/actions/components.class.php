<?php

class virtualMeetingComponents extends sfComponents {
  public function executeAnswer($request) {
    $this->formAnswer = new FrontendAnswerForm();
    $this->formAnswer->setDefault('virtual_meeting_question_id',$this->question->getId());
  }
}