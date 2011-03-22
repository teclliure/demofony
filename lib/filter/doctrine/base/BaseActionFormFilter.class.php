<?php

/**
 * Action filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'author'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action_type'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'body'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action_date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'location'            => new sfWidgetFormFilterInput(),
      'min_users_allowed'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'max_users_allowed'   => new sfWidgetFormFilterInput(),
      'register_start_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'register_end_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'price'               => new sfWidgetFormFilterInput(),
      'active'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                => new sfWidgetFormFilterInput(),
      'latitude'            => new sfWidgetFormFilterInput(),
      'longitude'           => new sfWidgetFormFilterInput(),
      'categories_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'users_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'author'              => new sfValidatorPass(array('required' => false)),
      'action_type'         => new sfValidatorPass(array('required' => false)),
      'title'               => new sfValidatorPass(array('required' => false)),
      'body'                => new sfValidatorPass(array('required' => false)),
      'action_date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'location'            => new sfValidatorPass(array('required' => false)),
      'min_users_allowed'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_users_allowed'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'register_start_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'register_end_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'price'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'active'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'user_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                => new sfValidatorPass(array('required' => false)),
      'latitude'            => new sfValidatorPass(array('required' => false)),
      'longitude'           => new sfValidatorPass(array('required' => false)),
      'categories_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'users_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('action_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.ActionHasCategory ActionHasCategory')
      ->andWhereIn('ActionHasCategory.category_id', $values)
    ;
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
      ->leftJoin($query->getRootAlias().'.ActionUser ActionUser')
      ->andWhereIn('ActionUser.action_user_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Action';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'author'              => 'Text',
      'action_type'         => 'Text',
      'title'               => 'Text',
      'body'                => 'Text',
      'action_date'         => 'Date',
      'location'            => 'Text',
      'min_users_allowed'   => 'Number',
      'max_users_allowed'   => 'Number',
      'register_start_date' => 'Date',
      'register_end_date'   => 'Date',
      'price'               => 'Number',
      'active'              => 'Boolean',
      'user_id'             => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'slug'                => 'Text',
      'latitude'            => 'Text',
      'longitude'           => 'Text',
      'categories_list'     => 'ManyKey',
      'users_list'          => 'ManyKey',
    );
  }
}
