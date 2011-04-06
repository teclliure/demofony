<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'born_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'gender'             => new sfWidgetFormFilterInput(),
      'telephone'          => new sfWidgetFormFilterInput(),
      'address'            => new sfWidgetFormFilterInput(),
      'postal_code'        => new sfWidgetFormFilterInput(),
      'location'           => new sfWidgetFormFilterInput(),
      'province'           => new sfWidgetFormFilterInput(),
      'country'            => new sfWidgetFormFilterInput(),
      'web'                => new sfWidgetFormFilterInput(),
      'about'              => new sfWidgetFormFilterInput(),
      'subscription_email' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'latitude'           => new sfWidgetFormFilterInput(),
      'longitude'          => new sfWidgetFormFilterInput(),
      'image'              => new sfWidgetFormFilterInput(),
      'image_x1'           => new sfWidgetFormFilterInput(),
      'image_y1'           => new sfWidgetFormFilterInput(),
      'image_x2'           => new sfWidgetFormFilterInput(),
      'image_y2'           => new sfWidgetFormFilterInput(),
      'categories_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'regions_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Region')),
    ));

    $this->setValidators(array(
      'born_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'gender'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'telephone'          => new sfValidatorPass(array('required' => false)),
      'address'            => new sfValidatorPass(array('required' => false)),
      'postal_code'        => new sfValidatorPass(array('required' => false)),
      'location'           => new sfValidatorPass(array('required' => false)),
      'province'           => new sfValidatorPass(array('required' => false)),
      'country'            => new sfValidatorPass(array('required' => false)),
      'web'                => new sfValidatorPass(array('required' => false)),
      'about'              => new sfValidatorPass(array('required' => false)),
      'subscription_email' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'latitude'           => new sfValidatorPass(array('required' => false)),
      'longitude'          => new sfValidatorPass(array('required' => false)),
      'image'              => new sfValidatorPass(array('required' => false)),
      'image_x1'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_y1'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_x2'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_y2'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'categories_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'regions_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Region', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.SubscriptionCategory SubscriptionCategory')
      ->andWhereIn('SubscriptionCategory.category_id', $values)
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
      ->leftJoin($query->getRootAlias().'.SubscriptionRegion SubscriptionRegion')
      ->andWhereIn('SubscriptionRegion.region_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'user_id'            => 'Number',
      'born_date'          => 'Date',
      'gender'             => 'Number',
      'telephone'          => 'Text',
      'address'            => 'Text',
      'postal_code'        => 'Text',
      'location'           => 'Text',
      'province'           => 'Text',
      'country'            => 'Text',
      'web'                => 'Text',
      'about'              => 'Text',
      'subscription_email' => 'Boolean',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'latitude'           => 'Text',
      'longitude'          => 'Text',
      'image'              => 'Text',
      'image_x1'           => 'Number',
      'image_y1'           => 'Number',
      'image_x2'           => 'Number',
      'image_y2'           => 'Number',
      'categories_list'    => 'ManyKey',
      'regions_list'       => 'ManyKey',
    );
  }
}
