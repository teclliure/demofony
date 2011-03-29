<?php

/**
 * VirtualMeeting form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VirtualMeetingForm extends BaseVirtualMeetingForm
{
  public function configure()
  {
    unset($this['slug']);
    $this->setWidget('answers_start_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->setWidget('answers_end_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
  }
}
