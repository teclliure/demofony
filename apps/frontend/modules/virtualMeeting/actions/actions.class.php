<?php

/**
 * virtualMeeting actions.
 *
 * @package    demofony
 * @subpackage virtualMeeting
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class virtualMeetingActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->notArchivedVirtualMeetingsPager = new sfDoctrinePager('VirtualMeeting', '5');
    $this->notArchivedVirtualMeetingsPager->setQuery(Doctrine_Core::getTable('VirtualMeeting')->getActiveAndNotArchivedQuery());
    $this->notArchivedVirtualMeetingsPager->setPage(1);
    $this->notArchivedVirtualMeetingsPager->init();
    
    $this->archivedVirtualMeetingsPager = new sfDoctrinePager('VirtualMeeting', '5');
    $this->archivedVirtualMeetingsPager->setQuery(Doctrine_Core::getTable('VirtualMeeting')->getActiveAndArchivedQuery());
    $this->archivedVirtualMeetingsPager->setPage(1);
    $this->archivedVirtualMeetingsPager->init();
  }
  
  public function executeShowPage($request) {
    $pager = new sfDoctrinePager('VirtualMeeting', '5');
    if ($request->getParameter('class') == 'archived') {
      $query = Doctrine_Core::getTable('VirtualMeeting')->getActiveAndArchivedQuery();
    }
    else {
      $query = Doctrine_Core::getTable('VirtualMeeting')->getActiveAndNotArchivedQuery();
    }
    $pager->setQuery($query);
    $pager->setPage($request->getParameter('page'));
    $pager->init();
    
    return $this->renderPartial('virtualMeeting/meetingList',array('meetings'=>$pager->getResults(),'id'=>$request->getParameter('class'),'pager'=>$pager,'url'=>'virtualMeeting/showPage/class/'.$request->getParameter('class')));
  }
}
