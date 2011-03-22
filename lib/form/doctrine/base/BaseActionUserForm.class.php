<?php

/**
 * ActionUser form base class.
 *
 * @method ActionUser getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActionUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'action_id'      => new sfWidgetFormInputHidden(),
      'action_user_id' => new sfWidgetFormInputHidden(),
      'slug'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'action_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('action_id')), 'empty_value' => $this->getObject()->get('action_id'), 'required' => false)),
      'action_user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('action_user_id')), 'empty_value' => $this->getObject()->get('action_user_id'), 'required' => false)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ActionUser', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('action_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ActionUser';
  }

}
