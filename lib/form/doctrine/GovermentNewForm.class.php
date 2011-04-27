<?php

/**
 * GovermentNew form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GovermentNewForm extends BaseGovermentNewForm
{
  /**
   * @see ContentForm
   */
  public function configure()
  {
    parent::configure();
    
    $this->setWidget('created_at', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->widgetSchema->moveField('created_at', sfWidgetFormSchema::AFTER, 'title');
    $this->setValidator('created_at',new sfValidatorDateTime());
  }
}
