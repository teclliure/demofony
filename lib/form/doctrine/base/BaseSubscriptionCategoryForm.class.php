<?php

/**
 * SubscriptionCategory form base class.
 *
 * @method SubscriptionCategory getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSubscriptionCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_profile_id' => new sfWidgetFormInputHidden(),
      'category_id'     => new sfWidgetFormInputHidden(),
      'slug'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'user_profile_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_profile_id')), 'empty_value' => $this->getObject()->get('user_profile_id'), 'required' => false)),
      'category_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('category_id')), 'empty_value' => $this->getObject()->get('category_id'), 'required' => false)),
      'slug'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'SubscriptionCategory', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('subscription_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SubscriptionCategory';
  }

}
