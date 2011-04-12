<?php

/**
 * PluginOpinion filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePluginOpinionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'opinion'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'opinion_possibility_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibility'), 'add_empty' => true)),
      'object_class'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'object_id'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'innapropiate'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'selected'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'user_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'users_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'opinion'                => new sfValidatorPass(array('required' => false)),
      'opinion_possibility_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OpinionPossibility'), 'column' => 'id')),
      'object_class'           => new sfValidatorPass(array('required' => false)),
      'object_id'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'innapropiate'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'selected'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'user_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'users_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plugin_opinion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.OpinionMarkedAsSpam OpinionMarkedAsSpam')
      ->andWhereIn('OpinionMarkedAsSpam.user_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'PluginOpinion';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'opinion'                => 'Text',
      'opinion_possibility_id' => 'ForeignKey',
      'object_class'           => 'Text',
      'object_id'              => 'Number',
      'innapropiate'           => 'Boolean',
      'selected'               => 'Boolean',
      'user_id'                => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'users_list'             => 'ManyKey',
    );
  }
}
