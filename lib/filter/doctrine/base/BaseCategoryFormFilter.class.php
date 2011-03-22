<?php

/**
 * Category filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'    => new sfWidgetFormFilterInput(),
      'slug'           => new sfWidgetFormFilterInput(),
      'profiles_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'SfGuardUserProfile')),
      'proposals_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Proposal')),
      'actions_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Action')),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'description'    => new sfValidatorPass(array('required' => false)),
      'slug'           => new sfValidatorPass(array('required' => false)),
      'profiles_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'SfGuardUserProfile', 'required' => false)),
      'proposals_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Proposal', 'required' => false)),
      'actions_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Action', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.SubscriptionCategory SubscriptionCategory')
      ->andWhereIn('SubscriptionCategory.user_profile_id', $values)
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
      ->leftJoin($query->getRootAlias().'.ProposalHasCategory ProposalHasCategory')
      ->andWhereIn('ProposalHasCategory.proposal_id', $values)
    ;
  }

  public function addActionsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.ActionHasCategory ActionHasCategory')
      ->andWhereIn('ActionHasCategory.action_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'description'    => 'Text',
      'slug'           => 'Text',
      'profiles_list'  => 'ManyKey',
      'proposals_list' => 'ManyKey',
      'actions_list'   => 'ManyKey',
    );
  }
}
