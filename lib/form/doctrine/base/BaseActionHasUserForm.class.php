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
      'action_id' => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormInputHidden(),
      'slug'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'action_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('action_id')), 'empty_value' => $this->getObject()->get('action_id'), 'required' => false)),
      'user_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'slug'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'ActionHasUser', 'column' => array('action_id'))),
        new sfValidatorDoctrineUnique(array('model' => 'ActionHasUser', 'column' => array('user_id'))),
        new sfValidatorDoctrineUnique(array('model' => 'ActionHasUser', 'column' => array('slug'))),
      ))
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
