<?php

/**
 * Category form base class.
 *
 * @method Category getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'description'    => new sfWidgetFormInputText(),
      'slug'           => new sfWidgetFormInputText(),
      'profiles_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'SfGuardUserProfile')),
      'proposals_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Proposal')),
      'actions_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Action')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 100)),
      'description'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'profiles_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'SfGuardUserProfile', 'required' => false)),
      'proposals_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Proposal', 'required' => false)),
      'actions_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Action', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Category', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['profiles_list']))
    {
      $this->setDefault('profiles_list', $this->object->profiles->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['proposals_list']))
    {
      $this->setDefault('proposals_list', $this->object->Proposals->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['actions_list']))
    {
      $this->setDefault('actions_list', $this->object->Actions->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveprofilesList($con);
    $this->saveProposalsList($con);
    $this->saveActionsList($con);

    parent::doSave($con);
  }

  public function saveprofilesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['profiles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->profiles->getPrimaryKeys();
    $values = $this->getValue('profiles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('profiles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('profiles', array_values($link));
    }
  }

  public function saveProposalsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['proposals_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Proposals->getPrimaryKeys();
    $values = $this->getValue('proposals_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Proposals', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Proposals', array_values($link));
    }
  }

  public function saveActionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['actions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Actions->getPrimaryKeys();
    $values = $this->getValue('actions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Actions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Actions', array_values($link));
    }
  }

}
