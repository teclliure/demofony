<?php

/**
 * OpinionPossibility form base class.
 *
 * @method OpinionPossibility getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpinionPossibilityForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'gmap_bubble_image'            => new sfWidgetFormInputText(),
      'icon'                         => new sfWidgetFormInputText(),
      'opinion_possibility_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibilityGroup'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'gmap_bubble_image'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'icon'                         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'opinion_possibility_group_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibilityGroup'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('opinion_possibility[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OpinionPossibility';
  }

}
