<?php

/**
 * VirtualMeetingQuestion form base class.
 *
 * @method VirtualMeetingQuestion getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVirtualMeetingQuestionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'question'           => new sfWidgetFormTextarea(),
      'active'             => new sfWidgetFormInputCheckbox(),
      'virtual_meeting_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VirtualMeeting'), 'add_empty' => false)),
      'slug'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'question'           => new sfValidatorString(array('max_length' => 1000)),
      'active'             => new sfValidatorBoolean(array('required' => false)),
      'virtual_meeting_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VirtualMeeting'))),
      'slug'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'VirtualMeetingQuestion', 'column' => array('id'))),
        new sfValidatorDoctrineUnique(array('model' => 'VirtualMeetingQuestion', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('virtual_meeting_question[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VirtualMeetingQuestion';
  }

}
