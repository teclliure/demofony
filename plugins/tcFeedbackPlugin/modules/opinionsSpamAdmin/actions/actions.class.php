<?php

/**
 * opinionsSpamAdmin actions.
 *
 * @package    demofony
 * @subpackage opinionsSpamAdmin
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class opinionsSpamAdminActions extends autoOpinionsSpamAdminActions
{
  public function executeListSpam($request) {
    $this->opinion_marked_as_spam = $this->getRoute()->getObject();
    $opinion = $this->opinion_marked_as_spam->getOpinion();
    $opinion->setAsSpam();
    $this->getUser()->setFlash('notice', 'The item was marked as spam successfully.');

    $this->redirect('@opinion_marked_as_spam');
  }
  
  public function executeListNotSpam($request) {
    $this->opinion_marked_as_spam = $this->getRoute()->getObject();
    $opinion = $this->opinion_marked_as_spam->getOpinion();
    $opinion->setAsNotSpam();
    $this->getUser()->setFlash('notice', 'The item was marked as NOT spam successfully.');

    $this->redirect('@opinion_marked_as_spam');
  }
}
