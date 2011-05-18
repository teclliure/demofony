<?php

/**
 * PluginOpinion form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PluginOpinionForm extends BasePluginOpinionForm
{
public function setup()
  {
    parent::setup();
    unset($this['created_at'],$this['updated_at'],$this['users_list']);
    $this->setWidget('object_class',new sfWidgetFormInputHidden ());
    $this->setWidget('object_id',new sfWidgetFormInputHidden ());
    $this->widgetSchema['opinion'] = new sfWidgetFormTextarea();
    $this->validatorSchema['opinion'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
    $this->generatePossibilities();
  }
  
  protected function generatePossibilities() {
    $group = $this->getGroup();
    if ($group) {
      $query = Doctrine::getTable('OpinionPossibility')->createQuery('o')->innerJoin('o.OpinionPossibilityGroup g')->where('g.id = ?',$group->getId());
      $this->widgetSchema['opinion_possibility_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibility'), 'expanded'=>true, 'add_empty' => false,'query'=>$query,'renderer_class'=>'sfWidgetFormSelectRadioAdapted','renderer_options'=>array('class'=>'options')));
      $this->validatorSchema['opinion_possibility_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibility'), 'query'=>$query));
      $this->widgetSchema->moveField('opinion_possibility_id', sfWidgetFormSchema::FIRST);
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
    $object = $this->getObject()->getObject();
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
}
