<?php

class FrontendCitizenProposalForm extends CitizenProposalForm {
  public function configure()
  {
    parent::configure();
    unset($this['active'],$this['user_id'],$this['categories'],$this['regions']);
    
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