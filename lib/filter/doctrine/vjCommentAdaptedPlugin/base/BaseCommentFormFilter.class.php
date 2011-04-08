<?php

/**
 * Comment filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCommentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'record_model'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'record_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'author_name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'author_email'   => new sfWidgetFormFilterInput(),
      'author_website' => new sfWidgetFormFilterInput(),
      'body'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_delete'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'edition_reason' => new sfWidgetFormFilterInput(),
      'reply'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comment'), 'add_empty' => true)),
      'user_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'record_model'   => new sfValidatorPass(array('required' => false)),
      'record_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author_name'    => new sfValidatorPass(array('required' => false)),
      'author_email'   => new sfValidatorPass(array('required' => false)),
      'author_website' => new sfValidatorPass(array('required' => false)),
      'body'           => new sfValidatorPass(array('required' => false)),
      'is_delete'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'edition_reason' => new sfValidatorPass(array('required' => false)),
      'reply'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Comment'), 'column' => 'id')),
      'user_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'record_model'   => 'Text',
      'record_id'      => 'Number',
      'author_name'    => 'Text',
      'author_email'   => 'Text',
      'author_website' => 'Text',
      'body'           => 'Text',
      'is_delete'      => 'Boolean',
      'edition_reason' => 'Text',
      'reply'          => 'ForeignKey',
      'user_id'        => 'ForeignKey',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
