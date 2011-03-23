<?php

/**
 * GovermentConsultation form base class.
 *
 * @method GovermentConsultation getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGovermentConsultationForm extends ContentForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['start_date'] = new sfWidgetFormDate();
    $this->validatorSchema['start_date'] = new sfValidatorDate();

    $this->widgetSchema   ['end_date'] = new sfWidgetFormDate();
    $this->validatorSchema['end_date'] = new sfValidatorDate(array('required' => false));

    $this->widgetSchema->setNameFormat('goverment_consultation[%s]');
  }

  public function getModelName()
  {
    return 'GovermentConsultation';
  }

}
