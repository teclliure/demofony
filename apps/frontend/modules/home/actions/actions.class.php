<?php

/**
 * home actions.
 *
 * @package    demofony
 * @subpackage home
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // $this->forward('default', 'module');
    $this->last_proposals = Doctrine_Core::getTable('Proposal')->getActiveCombined(10);
    $this->last_goverment_proposals = Doctrine_Core::getTable('GovermentProposal')->getActive(10);
    $this->last_citizen_proposals = Doctrine_Core::getTable('CitizenProposal')->getActive(10);
    $this->last_goverment_consultations = Doctrine_Core::getTable('GovermentConsultation')->getActive(10);
  }
}
