<?php

/**
 * GovermentProposal form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GovermentProposalForm extends BaseGovermentProposalForm
{
  /**
   * @see ContentForm
   */
  public function configure()
  {
    parent::configure();
    
    $this->setWidget('publish_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->widgetSchema->moveField('publish_date', sfWidgetFormSchema::AFTER, 'title');
  }
}
