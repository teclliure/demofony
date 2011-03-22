<?php

/**
 * SfGuardUserProfile form base class.
 *
 * @method SfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSfGuardUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'nickname'           => new sfWidgetFormInputText(),
      'gender'             => new sfWidgetFormInputText(),
      'telephone'          => new sfWidgetFormInputText(),
      'address'            => new sfWidgetFormInputText(),
      'postal_code'        => new sfWidgetFormInputText(),
      'location'           => new sfWidgetFormInputText(),
      'province'           => new sfWidgetFormInputText(),
      'country'            => new sfWidgetFormInputText(),
      'web'                => new sfWidgetFormInputText(),
      'about'              => new sfWidgetFormTextarea(),
      'subscription_email' => new sfWidgetFormInputCheckbox(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'latitude'           => new sfWidgetFormInputText(),
      'longitude'          => new sfWidgetFormInputText(),
      'categories_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'regions_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Region')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'nickname'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'gender'             => new sfValidatorInteger(array('required' => false)),
      'telephone'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'address'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postal_code'        => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'location'           => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'province'           => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'country'            => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'web'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'about'              => new sfValidatorString(array('required' => false)),
      'subscription_email' => new sfValidatorBoolean(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'latitude'           => new sfValidatorPass(array('required' => false)),
      'longitude'          => new sfValidatorPass(array('required' => false)),
      'categories_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'regions_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Region', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'SfGuardUserProfile', 'column' => array('user_id')))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SfGuardUserProfile';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['categories_list']))
    {
      $this->setDefault('categories_list', $this->object->categories->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['regions_list']))
    {
      $this->setDefault('regions_list', $this->object->regions->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savecategoriesList($con);
    $this->saveregionsList($con);

    parent::doSave($con);
  }

  public function savecategoriesList($con = null)
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

    $existing = $this->object->categories->getPrimaryKeys();
    $values = $this->getValue('categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('categories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('categories', array_values($link));
    }
  }

  public function saveregionsList($con = null)
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

    $existing = $this->object->regions->getPrimaryKeys();
    $values = $this->getValue('regions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('regions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('regions', array_values($link));
    }
  }

}
