<?php

/**
 * CommentReport filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCommentReportFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reason'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'referer'    => new sfWidgetFormFilterInput(),
      'state'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'valid' => 'valid', 'invalid' => 'invalid', 'untreated' => 'untreated'))),
      'id_comment' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comment'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'reason'     => new sfValidatorPass(array('required' => false)),
      'referer'    => new sfValidatorPass(array('required' => false)),
      'state'      => new sfValidatorChoice(array('required' => false, 'choices' => array('valid' => 'valid', 'invalid' => 'invalid', 'untreated' => 'untreated'))),
      'id_comment' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comment'), 'column' => 'id')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('comment_report_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CommentReport';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'reason'     => 'Text',
      'referer'    => 'Text',
      'state'      => 'Enum',
      'id_comment' => 'ForeignKey',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
