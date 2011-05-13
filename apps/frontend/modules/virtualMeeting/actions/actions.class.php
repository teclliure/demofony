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
  
  public function executeShow($request) {
    $this->interview = Doctrine_Core::getTable('VirtualMeeting')->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->interview);
    $this->forward404Unless($this->interview->getActive());
    $this->form = new FrontendQuestionForm();
    $this->form->setDefault('virtual_meeting_id',$this->interview->getId());
  }
  
  public function executeAddQuestion($request) {
    $this->interview = Doctrine_Core::getTable('VirtualMeeting')->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->interview);
    $this->forward404Unless($this->interview->getActive());
    $this->form = new FrontendQuestionForm();
    $this->form->setDefault('virtual_meeting_id',$this->interview->getId());
    $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $object = $this->form->save();
      $this->getUser()->setFlash('success', 'Question added correctly!');
      $this->redirect('virtualMeeting/show?id='.$this->interview->getId());
    }
    else $this->setTemplate('show');
  }
  
  public function executeAddAnswer($request) {
    $this->question = Doctrine_Core::getTable('VirtualMeetingQuestion')->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->question);
    $this->interview = $this->question->getVirtualMeeting();
    $form = new FrontendAnswerForm();
    $form->setDefault('virtual_meeting_question_id',$this->question->getId());
    $form->bind($request->getParameter($form->getName()),$request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $object = $form->save();
      $this->getUser()->setFlash('success', 'Answer added correctly!');
      $this->redirect('virtualMeeting/show?id='.$this->interview->getId());
    }
    else {
      $this->getUser()->setFlash('error', 'Error saving answer. Not saved !');
      $this->redirect('virtualMeeting/show?id='.$this->interview->getId());
    }
  }
}
