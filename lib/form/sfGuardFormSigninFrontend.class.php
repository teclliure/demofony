<?php

class sfGuardFormSigninFrontend extends sfGuardFormSignin {
  
  public function configure()
  {
    parent::configure();
  
    
    $decorator = new sfWidgetFormSchemaFormatterFrontend($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
    
  }
}