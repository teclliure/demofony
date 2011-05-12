<?php

/**
 * Action form base class.
 *
 * @method Action getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActionForm extends ContentForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['author'] = new sfWidgetFormInputText();
    $this->validatorSchema['author'] = new sfValidatorString(array('max_length' => 150));

    $this->widgetSchema   ['action_date'] = new sfWidgetFormDate();
    $this->validatorSchema['action_date'] = new sfValidatorDate(array('required' => false));

    $this->widgetSchema   ['location'] = new sfWidgetFormInputText();
    $this->validatorSchema['location'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

    $this->widgetSchema   ['min_users_allowed'] = new sfWidgetFormInputText();
    $this->validatorSchema['min_users_allowed'] = new sfValidatorInteger();

    $this->widgetSchema   ['max_users_allowed'] = new sfWidgetFormInputText();
    $this->validatorSchema['max_users_allowed'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['register_start_date'] = new sfWidgetFormDate();
    $this->validatorSchema['register_start_date'] = new sfValidatorDate();

    $this->widgetSchema   ['register_end_date'] = new sfWidgetFormDate();
    $this->validatorSchema['register_end_date'] = new sfValidatorDate(array('required' => false));

    $this->widgetSchema   ['confirmed'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['confirmed'] = new sfValidatorBoolean(array('required' => false));

    $this->widgetSchema->setNameFormat('action[%s]');
  }

  public function getModelName()
  {
    return 'Action';
  }

}
