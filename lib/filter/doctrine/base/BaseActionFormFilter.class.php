<?php

/**
 * Action filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActionFormFilter extends ContentFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['author'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['author'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['action_date'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate()));
    $this->validatorSchema['action_date'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false))));

    $this->widgetSchema   ['location'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['location'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['min_users_allowed'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['min_users_allowed'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['max_users_allowed'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['max_users_allowed'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['register_start_date'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false));
    $this->validatorSchema['register_start_date'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false))));

    $this->widgetSchema   ['register_end_date'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate()));
    $this->validatorSchema['register_end_date'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false))));

    $this->widgetSchema->setNameFormat('action_filters[%s]');
  }

  public function getModelName()
  {
    return 'Action';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'author' => 'Text',
      'action_date' => 'Date',
      'location' => 'Text',
      'min_users_allowed' => 'Number',
      'max_users_allowed' => 'Number',
      'register_start_date' => 'Date',
      'register_end_date' => 'Date',
    ));
  }
}
