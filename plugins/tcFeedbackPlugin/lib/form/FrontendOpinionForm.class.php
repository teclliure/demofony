<?php

class FrontendOpinionForm extends OpinionForm {
  public function configure() {
    parent::configure();
    
    unset($this['user_id'],$this['users_list'],$this['innapropiate'],$this['selected'],$this['created_at'],$this['updated_at']);
    
    $user = $this->getOption('user');
    $object = $this->getOption('object');
    
    $this->widgetSchema['opinion'] = new sfWidgetFormTextarea();
    $this->validatorSchema['opinion'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
    $this->widgetSchema['object_class'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['object_id'] = new sfWidgetFormInputHidden();
    $this->setDefault('object_class',get_class($object));
    $this->setDefault('object_id',$object->getId());
    
    $this->generatePossibilities();
  }
  
  protected function generatePossibilities() {
    $group = $this->getGroup();
    if ($group) {
      $query = Doctrine::getTable('OpinionPossibility')->createQuery('o')->innerJoin('o.OpinionPossibilityGroup g')->where('g.id = ?',$group->getId());
      $this->widgetSchema['opinion_possibility_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibility'), 'expanded'=>true, 'add_empty' => false,'query'=>$query,'renderer_class'=>'sfWidgetFormSelectRadioAdapted','renderer_options'=>array('class'=>'options')));
      $this->validatorSchema['opinion_possibility_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibility'), 'query'=>$query));
      if ($group->getCanTextBeAdded()) {
        $this->validatorSchema['opinion'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
      }
      else {
        unset($this['opinion']);
      }
    
      return true;
    }
    else {
      unset($this['opinion_possibility_id']);
      return false;
    }
  }
  
  public function getGroup() {
    $object = $this->getOption('object');
    $className = get_class($object);
    
    $data = sfYaml::load(sfConfig::get('sf_root_dir').'/config/opinion.yml');
    if (isset($data['class'])) {
      foreach ($data['class'] as $key => $config) {
        if ($key == $className) {
          $group = Doctrine::getTable('OpinionPossibilityGroup')->findOneBy('slug',$config['group']);
          if ($group) {
            return $group;
          }
          else {
            throw new sfException($config['group'].' doesn\'t exist');
          }
        }
      }
    }
    return null;
  }
  
  public function getPossibilities() {
    return Doctrine::getTable('OpinionPossibility')->createQuery('o')->innerJoin('o.OpinionPossibilityGroup g')->where('g.id = ?',$this->getGroup()->getId())->execute();
  }
  
  protected function doUpdateObject($values)
  {
    $values['user_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getId();
    
    parent::doUpdateObject($values);
  }
}
