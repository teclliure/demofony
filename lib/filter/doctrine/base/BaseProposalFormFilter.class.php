<?php

/**
 * Proposal filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProposalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'proposal_type'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'publish_date'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'title'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'body'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'           => new sfWidgetFormFilterInput(),
      'video'           => new sfWidgetFormFilterInput(),
      'tip'             => new sfWidgetFormFilterInput(),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'active'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'            => new sfWidgetFormFilterInput(),
      'latitude'        => new sfWidgetFormFilterInput(),
      'longitude'       => new sfWidgetFormFilterInput(),
      'categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'regions_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Region')),
    ));

    $this->setValidators(array(
      'proposal_type'   => new sfValidatorPass(array('required' => false)),
      'publish_date'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'title'           => new sfValidatorPass(array('required' => false)),
      'body'            => new sfValidatorPass(array('required' => false)),
      'image'           => new sfValidatorPass(array('required' => false)),
      'video'           => new sfValidatorPass(array('required' => false)),
      'tip'             => new sfValidatorPass(array('required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'active'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'            => new sfValidatorPass(array('required' => false)),
      'latitude'        => new sfValidatorPass(array('required' => false)),
      'longitude'       => new sfValidatorPass(array('required' => false)),
      'categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'regions_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Region', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proposal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('ProposalHasCategory.category_id', $values)
    ;
  }

  public function addRegionsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.ProposalHasRegion ProposalHasRegion')
      ->andWhereIn('ProposalHasRegion.region_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Proposal';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'proposal_type'   => 'Text',
      'publish_date'    => 'Date',
      'title'           => 'Text',
      'body'            => 'Text',
      'image'           => 'Text',
      'video'           => 'Text',
      'tip'             => 'Text',
      'user_id'         => 'ForeignKey',
      'active'          => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'slug'            => 'Text',
      'latitude'        => 'Text',
      'longitude'       => 'Text',
      'categories_list' => 'ManyKey',
      'regions_list'    => 'ManyKey',
    );
  }
}
