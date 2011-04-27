<?php

/**
 * Action form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ActionForm extends BaseActionForm
{
  public function configure()
  {
    parent::configure();
    $this->setWidget('action_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->setWidget('register_start_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->setWidget('register_end_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->widgetSchema['min_users_allowed']->setAttributes(array('size'=>4));
    $this->widgetSchema['max_users_allowed']->setAttributes(array('size'=>4));
    $this->widgetSchema->moveField('author', sfWidgetFormSchema::AFTER, 'title');
    $this->widgetSchema->moveField('location', sfWidgetFormSchema::AFTER, 'author');
    $this->widgetSchema->moveField('action_date', sfWidgetFormSchema::AFTER, 'location');
    $this->widgetSchema->moveField('register_start_date', sfWidgetFormSchema::AFTER, 'action_date');
    $this->widgetSchema->moveField('register_end_date', sfWidgetFormSchema::AFTER, 'register_start_date');
  }
}
