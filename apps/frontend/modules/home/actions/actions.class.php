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
    $sql = Doctrine_Core::getTable('Proposal')->getSqlUnion();
    $this->pager_last_proposals = new sfPdoUnionPager ('Proposal',5);
    $this->pager_last_proposals->setSql($sql);
    $this->pager_last_proposals->setPage(1);
    $this->pager_last_proposals->init();
    
    $this->pager_last_goverment_proposals = new sfDoctrinePager('GovermentProposal', '5');
    $this->pager_last_goverment_proposals->setQuery(Doctrine_Core::getTable('GovermentProposal')->getActiveQuery());
    $this->pager_last_goverment_proposals->setPage(1);
    $this->pager_last_goverment_proposals->init();
    
    $this->pager_last_citizen_proposals = new sfDoctrinePager('CitizenProposal', '5');
    $this->pager_last_citizen_proposals->setQuery(Doctrine_Core::getTable('CitizenProposal')->getActiveQuery());
    $this->pager_last_citizen_proposals->setPage(1);
    $this->pager_last_citizen_proposals->init();
    
    $this->pager_last_goverment_consultations = new sfDoctrinePager('GovermentConsultation', '5');
    $this->pager_last_goverment_consultations->setQuery(Doctrine_Core::getTable('GovermentConsultation')->getActiveQuery());
    $this->pager_last_goverment_consultations->setPage(1);
    $this->pager_last_goverment_consultations->init();
    
    $this->pager_last_workshops = new sfDoctrinePager('Workshop', '5');
    $this->pager_last_workshops->setQuery(Doctrine_Core::getTable('Workshop')->getActiveQuery());
    $this->pager_last_workshops->setPage(1);
    $this->pager_last_workshops->init();
    
    $this->pager_last_citizen_actions = new sfDoctrinePager('CitizenAction', '5');
    $this->pager_last_citizen_actions->setQuery(Doctrine_Core::getTable('CitizenAction')->getActiveQuery());
    $this->pager_last_citizen_actions->setPage(1);
    $this->pager_last_citizen_actions->init();
    
    $this->pager_last_news = new sfDoctrinePager('GovermentNew', '4');
    $this->pager_last_news->setQuery(Doctrine_Core::getTable('GovermentNew')->getActiveQuery());
    $this->pager_last_news->setPage(1);
    $this->pager_last_news->init();
  }
}
