<?php

/**
 * VirtualMeeting form base class.
 *
 * @method VirtualMeeting getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVirtualMeetingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'title'              => new sfWidgetFormInputText(),
      'body'               => new sfWidgetFormTextarea(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'answers_start_date' => new sfWidgetFormDate(),
      'answers_end_date'   => new sfWidgetFormDate(),
      'archived'           => new sfWidgetFormInputCheckbox(),
      'active'             => new sfWidgetFormInputCheckbox(),
      'slug'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'              => new sfValidatorString(array('max_length' => 255)),
      'body'               => new sfValidatorString(),
      'user_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'answers_start_date' => new sfValidatorDate(),
      'answers_end_date'   => new sfValidatorDate(),
      'archived'           => new sfValidatorBoolean(array('required' => false)),
      'active'             => new sfValidatorBoolean(array('required' => false)),
      'slug'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'VirtualMeeting', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('virtual_meeting[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VirtualMeeting';
  }

}
