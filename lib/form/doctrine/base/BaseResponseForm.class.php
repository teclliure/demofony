<?php

/**
 * Response form base class.
 *
 * @method Response getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResponseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'body'         => new sfWidgetFormTextarea(),
      'content_id'   => new sfWidgetFormInputText(),
      'content_type' => new sfWidgetFormInputText(),
      'slug'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'body'         => new sfValidatorString(),
      'content_id'   => new sfValidatorInteger(),
      'content_type' => new sfValidatorString(array('max_length' => 100)),
      'slug'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Response', 'column' => array('content_id', 'content_type'))),
        new sfValidatorDoctrineUnique(array('model' => 'Response', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('response[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Response';
  }

}
