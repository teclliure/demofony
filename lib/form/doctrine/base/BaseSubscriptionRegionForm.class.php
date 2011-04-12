<?php

/**
 * SubscriptionRegion form base class.
 *
 * @method SubscriptionRegion getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSubscriptionRegionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'   => new sfWidgetFormInputHidden(),
      'region_id' => new sfWidgetFormInputHidden(),
      'slug'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'user_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'region_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('region_id')), 'empty_value' => $this->getObject()->get('region_id'), 'required' => false)),
      'slug'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'SubscriptionRegion', 'column' => array('user_id', 'region_id'))),
        new sfValidatorDoctrineUnique(array('model' => 'SubscriptionRegion', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('subscription_region[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SubscriptionRegion';
  }

}
