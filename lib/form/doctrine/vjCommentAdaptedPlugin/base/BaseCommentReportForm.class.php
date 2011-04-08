<?php

/**
 * CommentReport form base class.
 *
 * @method CommentReport getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentReportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'reason'     => new sfWidgetFormTextarea(),
      'referer'    => new sfWidgetFormInputText(),
      'state'      => new sfWidgetFormChoice(array('choices' => array('valid' => 'valid', 'invalid' => 'invalid', 'untreated' => 'untreated'))),
      'id_comment' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Comment'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reason'     => new sfValidatorString(),
      'referer'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'state'      => new sfValidatorChoice(array('choices' => array(0 => 'valid', 1 => 'invalid', 2 => 'untreated'), 'required' => false)),
      'id_comment' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Comment'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comment_report[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CommentReport';
  }

}
