<?php

/**
 * ContentHasCategory form base class.
 *
 * @method ContentHasCategory getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContentHasCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'content_id'  => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormInputHidden(),
      'type'        => new sfWidgetFormInputHidden(),
      'slug'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'content_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('content_id')), 'empty_value' => $this->getObject()->get('content_id'), 'required' => false)),
      'category_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('category_id')), 'empty_value' => $this->getObject()->get('category_id'), 'required' => false)),
      'type'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('type')), 'empty_value' => $this->getObject()->get('type'), 'required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'ContentHasCategory', 'column' => array('content_id', 'category_id', 'type'))),
        new sfValidatorDoctrineUnique(array('model' => 'ContentHasCategory', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('content_has_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentHasCategory';
  }

}
