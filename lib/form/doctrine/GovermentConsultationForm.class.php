<?php

/**
 * GovermentConsultation form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GovermentConsultationForm extends BaseGovermentConsultationForm
{
  /**
   * @see ContentForm
   */
  public function configure()
  {
    parent::configure();
    $this->setWidget('start_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->setWidget('end_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->widgetSchema->moveField('start_date', sfWidgetFormSchema::AFTER, 'title');
    $this->widgetSchema->moveField('end_date', sfWidgetFormSchema::AFTER, 'start_date');
  }
}
