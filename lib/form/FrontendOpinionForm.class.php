<?php

class FrontendOpinionForm extends OpinionForm {
  public function configure() {
    parent::configure();
    
    $user = $this->getOption('user');
    $object = $this->getOption('object');
    
    //$this->widgetSchema['record_model'] = new sfWidgetFormInputHidden();
    //$this->widgetSchema['record_id'] = new sfWidgetFormInputHidden();
    
  }
}