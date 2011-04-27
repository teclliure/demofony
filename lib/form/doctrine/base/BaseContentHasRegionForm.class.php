<?php

/**
 * ContentHasRegion form base class.
 *
 * @method ContentHasRegion getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContentHasRegionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'content_id' => new sfWidgetFormInputHidden(),
      'region_id'  => new sfWidgetFormInputHidden(),
      'type'       => new sfWidgetFormInputHidden(),
      'slug'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'content_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('content_id')), 'empty_value' => $this->getObject()->get('content_id'), 'required' => false)),
      'region_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('region_id')), 'empty_value' => $this->getObject()->get('region_id'), 'required' => false)),
      'type'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('type')), 'empty_value' => $this->getObject()->get('type'), 'required' => false)),
      'slug'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'ContentHasRegion', 'column' => array('region_id', 'content_id', 'type'))),
        new sfValidatorDoctrineUnique(array('model' => 'ContentHasRegion', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('content_has_region[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentHasRegion';
  }

}
