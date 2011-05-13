<?php

/**
 * VirtualMeetingAnswer filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVirtualMeetingAnswerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'answer'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'virtual_meeting_question_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VirtualMeetingQuestion'), 'add_empty' => true)),
      'slug'                        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'answer'                      => new sfValidatorPass(array('required' => false)),
      'virtual_meeting_question_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('VirtualMeetingQuestion'), 'column' => 'id')),
      'slug'                        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('virtual_meeting_answer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VirtualMeetingAnswer';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'answer'                      => 'Text',
      'virtual_meeting_question_id' => 'ForeignKey',
      'slug'                        => 'Text',
    );
  }
}
