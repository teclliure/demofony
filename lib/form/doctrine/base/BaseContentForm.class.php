<?php

/**
 * Content form base class.
 *
 * @method Content getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'title'               => new sfWidgetFormInputText(),
      'body'                => new sfWidgetFormTextarea(),
      'video'               => new sfWidgetFormInputText(),
      'active'              => new sfWidgetFormInputCheckbox(),
      'views'               => new sfWidgetFormInputText(),
      'type'                => new sfWidgetFormInputText(),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'tip'                 => new sfWidgetFormTextarea(),
      'start_date'          => new sfWidgetFormDate(),
      'end_date'            => new sfWidgetFormDate(),
      'author'              => new sfWidgetFormInputText(),
      'action_date'         => new sfWidgetFormDate(),
      'location'            => new sfWidgetFormInputText(),
      'min_users_allowed'   => new sfWidgetFormInputText(),
      'max_users_allowed'   => new sfWidgetFormInputText(),
      'register_start_date' => new sfWidgetFormDate(),
      'register_end_date'   => new sfWidgetFormDate(),
      'price'               => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'slug'                => new sfWidgetFormInputText(),
      'latitude'            => new sfWidgetFormInputText(),
      'longitude'           => new sfWidgetFormInputText(),
      'image'               => new sfWidgetFormInputText(),
      'image_x1'            => new sfWidgetFormInputText(),
      'image_y1'            => new sfWidgetFormInputText(),
      'image_x2'            => new sfWidgetFormInputText(),
      'image_y2'            => new sfWidgetFormInputText(),
      'categories_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'users_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'regions_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Region')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'               => new sfValidatorString(array('max_length' => 255)),
      'body'                => new sfValidatorString(),
      'video'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'active'              => new sfValidatorBoolean(array('required' => false)),
      'views'               => new sfValidatorInteger(array('required' => false)),
      'type'                => new sfValidatorString(array('max_length' => 255)),
      'user_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'tip'                 => new sfValidatorString(array('required' => false)),
      'start_date'          => new sfValidatorDate(array('required' => false)),
      'end_date'            => new sfValidatorDate(array('required' => false)),
      'author'              => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'action_date'         => new sfValidatorDate(array('required' => false)),
      'location'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'min_users_allowed'   => new sfValidatorInteger(array('required' => false)),
      'max_users_allowed'   => new sfValidatorInteger(array('required' => false)),
      'register_start_date' => new sfValidatorDate(array('required' => false)),
      'register_end_date'   => new sfValidatorDate(array('required' => false)),
      'price'               => new sfValidatorNumber(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'slug'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'latitude'            => new sfValidatorPass(array('required' => false)),
      'longitude'           => new sfValidatorPass(array('required' => false)),
      'image'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image_x1'            => new sfValidatorInteger(array('required' => false)),
      'image_y1'            => new sfValidatorInteger(array('required' => false)),
      'image_x2'            => new sfValidatorInteger(array('required' => false)),
      'image_y2'            => new sfValidatorInteger(array('required' => false)),
      'categories_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'users_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'regions_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Region', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Content', 'column' => array('id'))),
        new sfValidatorDoctrineUnique(array('model' => 'Content', 'column' => array('slug', 'title', 'type'))),
      ))
    );

    $this->widgetSchema->setNameFormat('content[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Content';
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

    if (isset($this->widgetSchema['regions_list']))
    {
      $this->setDefault('regions_list', $this->object->Regions->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCategoriesList($con);
    $this->saveUsersList($con);
    $this->saveRegionsList($con);

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

  public function saveRegionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['regions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Regions->getPrimaryKeys();
    $values = $this->getValue('regions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Regions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Regions', array_values($link));
    }
  }

}
