<?php

/**
 * GovermentConsultation filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGovermentConsultationFormFilter extends ProposalFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['start_date'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false));
    $this->validatorSchema['start_date'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false))));

    $this->widgetSchema   ['end_date'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate()));
    $this->validatorSchema['end_date'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false))));

    $this->widgetSchema   ['opinion_possibility_group_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibilityGroup'), 'add_empty' => true));
    $this->validatorSchema['opinion_possibility_group_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OpinionPossibilityGroup'), 'column' => 'id'));

    $this->widgetSchema->setNameFormat('goverment_consultation_filters[%s]');
  }

  public function getModelName()
  {
    return 'GovermentConsultation';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'start_date' => 'Date',
      'end_date' => 'Date',
      'opinion_possibility_group_id' => 'ForeignKey',
    ));
  }
}
