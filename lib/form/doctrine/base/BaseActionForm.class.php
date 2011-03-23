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

    $this->widgetSchema   ['users_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser'));
    $this->validatorSchema['users_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false));

    $this->widgetSchema->setNameFormat('action[%s]');
  }

  public function getModelName()
  {
    return 'Action';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['users_list']))
    {
      $this->setDefault('users_list', $this->object->Users->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveUsersList($con);

    parent::doSave($con);
  }

  public function saveUsersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['users_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Users->getPrimaryKeys();
    $values = $this->getValue('users_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Users', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Users', array_values($link));
    }
  }

}
