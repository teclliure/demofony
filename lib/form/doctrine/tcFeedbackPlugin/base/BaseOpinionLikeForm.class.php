<?php

/**
 * OpinionLike form base class.
 *
 * @method OpinionLike getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpinionLikeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'    => new sfWidgetFormInputHidden(),
      'opinion_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'opinion_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('opinion_id')), 'empty_value' => $this->getObject()->get('opinion_id'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'OpinionLike', 'column' => array('user_id', 'opinion_id')))
    );

    $this->widgetSchema->setNameFormat('opinion_like[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OpinionLike';
  }

}
