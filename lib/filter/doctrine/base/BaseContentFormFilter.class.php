<?php

/**
 * Content filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'body'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'video'               => new sfWidgetFormFilterInput(),
      'active'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'views'               => new sfWidgetFormFilterInput(),
      'type'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'tip'                 => new sfWidgetFormFilterInput(),
      'start_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'end_date'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'author'              => new sfWidgetFormFilterInput(),
      'action_date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'location'            => new sfWidgetFormFilterInput(),
      'min_users_allowed'   => new sfWidgetFormFilterInput(),
      'max_users_allowed'   => new sfWidgetFormFilterInput(),
      'register_start_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'register_end_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'price'               => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                => new sfWidgetFormFilterInput(),
      'latitude'            => new sfWidgetFormFilterInput(),
      'longitude'           => new sfWidgetFormFilterInput(),
      'image'               => new sfWidgetFormFilterInput(),
      'image_x1'            => new sfWidgetFormFilterInput(),
      'image_y1'            => new sfWidgetFormFilterInput(),
      'image_x2'            => new sfWidgetFormFilterInput(),
      'image_y2'            => new sfWidgetFormFilterInput(),
      'categories_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'users_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'regions_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Region')),
    ));

    $this->setValidators(array(
      'title'               => new sfValidatorPass(array('required' => false)),
      'body'                => new sfValidatorPass(array('required' => false)),
      'video'               => new sfValidatorPass(array('required' => false)),
      'active'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'views'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'                => new sfValidatorPass(array('required' => false)),
      'user_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'tip'                 => new sfValidatorPass(array('required' => false)),
      'start_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'end_date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'author'              => new sfValidatorPass(array('required' => false)),
      'action_date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'location'            => new sfValidatorPass(array('required' => false)),
      'min_users_allowed'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_users_allowed'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'register_start_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'register_end_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'price'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                => new sfValidatorPass(array('required' => false)),
      'latitude'            => new sfValidatorPass(array('required' => false)),
      'longitude'           => new sfValidatorPass(array('required' => false)),
      'image'               => new sfValidatorPass(array('required' => false)),
      'image_x1'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_y1'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_x2'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_y2'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'categories_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'users_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'regions_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Region', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('content_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.ContentHasCategory ContentHasCategory')
      ->andWhereIn('ContentHasCategory.category_id', $values)
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
      ->leftJoin($query->getRootAlias().'.ActionHasUser ActionHasUser')
      ->andWhereIn('ActionHasUser.user_id', $values)
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
      ->leftJoin($query->getRootAlias().'.ContentHasRegion ContentHasRegion')
      ->andWhereIn('ContentHasRegion.region_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Content';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'title'               => 'Text',
      'body'                => 'Text',
      'video'               => 'Text',
      'active'              => 'Boolean',
      'views'               => 'Number',
      'type'                => 'Text',
      'user_id'             => 'ForeignKey',
      'tip'                 => 'Text',
      'start_date'          => 'Date',
      'end_date'            => 'Date',
      'author'              => 'Text',
      'action_date'         => 'Date',
      'location'            => 'Text',
      'min_users_allowed'   => 'Number',
      'max_users_allowed'   => 'Number',
      'register_start_date' => 'Date',
      'register_end_date'   => 'Date',
      'price'               => 'Number',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'slug'                => 'Text',
      'latitude'            => 'Text',
      'longitude'           => 'Text',
      'image'               => 'Text',
      'image_x1'            => 'Number',
      'image_y1'            => 'Number',
      'image_x2'            => 'Number',
      'image_y2'            => 'Number',
      'categories_list'     => 'ManyKey',
      'users_list'          => 'ManyKey',
      'regions_list'        => 'ManyKey',
    );
  }
}
