<?php

/**
 * ActionHasUser form base class.
 *
 * @method ActionHasUser getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActionHasUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'action_id'  => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'action_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('action_id')), 'empty_value' => $this->getObject()->get('action_id'), 'required' => false)),
      'user_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'type'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('type')), 'empty_value' => $this->getObject()->get('type'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ActionHasUser', 'column' => array('action_id', 'user_id')))
    );

    $this->widgetSchema->setNameFormat('action_has_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ActionHasUser';
  }

}
