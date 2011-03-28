<?php

/**
 * Region filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRegionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'    => new sfWidgetFormFilterInput(),
      'root_id'        => new sfWidgetFormFilterInput(),
      'lft'            => new sfWidgetFormFilterInput(),
      'rgt'            => new sfWidgetFormFilterInput(),
      'level'          => new sfWidgetFormFilterInput(),
      'profiles_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUserProfile')),
      'proposals_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Content')),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'description'    => new sfValidatorPass(array('required' => false)),
      'root_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lft'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rgt'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'profiles_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUserProfile', 'required' => false)),
      'proposals_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Content', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('region_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addProfilesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.SubscriptionRegion SubscriptionRegion')
      ->andWhereIn('SubscriptionRegion.user_id', $values)
    ;
  }

  public function addProposalsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.ContentHasRegion ContentHasRegion')
      ->andWhereIn('ContentHasRegion.content_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Region';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'description'    => 'Text',
      'root_id'        => 'Number',
      'lft'            => 'Number',
      'rgt'            => 'Number',
      'level'          => 'Number',
      'profiles_list'  => 'ManyKey',
      'proposals_list' => 'ManyKey',
    );
  }
}
