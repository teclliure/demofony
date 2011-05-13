<?php

/**
 * VirtualMeetingAnswer form base class.
 *
 * @method VirtualMeetingAnswer getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVirtualMeetingAnswerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'answer'                      => new sfWidgetFormTextarea(),
      'virtual_meeting_question_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VirtualMeetingQuestion'), 'add_empty' => false)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'answer'                      => new sfValidatorString(array('max_length' => 1000)),
      'virtual_meeting_question_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VirtualMeetingQuestion'))),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'VirtualMeetingAnswer', 'column' => array('virtual_meeting_question_id')))
    );

    $this->widgetSchema->setNameFormat('virtual_meeting_answer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VirtualMeetingAnswer';
  }

}
