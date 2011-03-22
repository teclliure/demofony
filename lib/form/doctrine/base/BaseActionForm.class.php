<?php

/**
 * Action form base class.
 *
 * @method Action getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'author'              => new sfWidgetFormInputText(),
      'action_type'         => new sfWidgetFormInputText(),
      'title'               => new sfWidgetFormInputText(),
      'body'                => new sfWidgetFormTextarea(),
      'action_date'         => new sfWidgetFormDate(),
      'location'            => new sfWidgetFormInputText(),
      'min_users_allowed'   => new sfWidgetFormInputText(),
      'max_users_allowed'   => new sfWidgetFormInputText(),
      'register_start_date' => new sfWidgetFormDate(),
      'register_end_date'   => new sfWidgetFormDate(),
      'price'               => new sfWidgetFormInputText(),
      'active'              => new sfWidgetFormInputCheckbox(),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'slug'                => new sfWidgetFormInputText(),
      'latitude'            => new sfWidgetFormInputText(),
      'longitude'           => new sfWidgetFormInputText(),
      'categories_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'users_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'author'              => new sfValidatorString(array('max_length' => 150)),
      'action_type'         => new sfValidatorString(array('max_length' => 100)),
      'title'               => new sfValidatorString(array('max_length' => 255)),
      'body'                => new sfValidatorString(),
      'action_date'         => new sfValidatorDate(array('required' => false)),
      'location'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'min_users_allowed'   => new sfValidatorInteger(),
      'max_users_allowed'   => new sfValidatorInteger(array('required' => false)),
      'register_start_date' => new sfValidatorDate(),
      'register_end_date'   => new sfValidatorDate(array('required' => false)),
      'price'               => new sfValidatorNumber(array('required' => false)),
      'active'              => new sfValidatorBoolean(array('required' => false)),
      'user_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'slug'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'latitude'            => new sfValidatorPass(array('required' => false)),
      'longitude'           => new sfValidatorPass(array('required' => false)),
      'categories_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'users_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Action', 'column' => array('min_users_allowed'))),
        new sfValidatorDoctrineUnique(array('model' => 'Action', 'column' => array('slug', 'title', 'action_date'))),
      ))
    );

    $this->widgetSchema->setNameFormat('action[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Action';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['categories_list']))
    {
      $this->setDefault('categories_list', $this->object->Categories->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['users_list']))
    {
      $this->setDefault('users_list', $this->object->Users->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCategoriesList($con);
    $this->saveUsersList($con);

    parent::doSave($con);
  }

  public function saveCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Categories->getPrimaryKeys();
    $values = $this->getValue('categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Categories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Categories', array_values($link));
    }
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
