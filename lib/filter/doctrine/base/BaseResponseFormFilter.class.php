<?php

/**
 * Response filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseResponseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'body'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content_type' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'body'         => new sfValidatorPass(array('required' => false)),
      'content_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content_type' => new sfValidatorPass(array('required' => false)),
      'slug'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('response_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Response';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'body'         => 'Text',
      'content_id'   => 'Number',
      'content_type' => 'Text',
      'slug'         => 'Text',
    );
  }
}
