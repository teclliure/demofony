<?php

/**
 * response actions.
 *
 * @package    demofony
 * @subpackage response
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class responseActions extends sfActions
{
  public function executeAdd(sfWebRequest $request)
  {
    $this->content = Doctrine_Core::getTable($request->getParameter('class'))->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->content);
    $this->form = new ResponseForm();
    $this->form->setDefault('content_id',$request->getParameter('id'));
    $this->form->setDefault('content_type',$request->getParameter('class'));
    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $this->getUser()->setFlash('notice', 'Response added correctly!');
        $this->redirect(array('sf_route' => sfInflector::underscore(get_class($this->content)).'_edit', 'sf_subject' => $this->content));
      }
    }
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->content = Doctrine_Core::getTable($request->getParameter('class'))->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->content);
    $this->form = new ResponseForm($this->content->getResponse());
    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $this->getUser()->setFlash('notice', 'Response edited correctly!');
        $this->redirect(array('sf_route' => sfInflector::underscore(get_class($this->content)).'_edit', 'sf_subject' => $this->content));
      }
    }
    $this->setTemplate('add');
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $this->content = Doctrine_Core::getTable($request->getParameter('class'))->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->content);
    $response = $this->content->getResponse();
    $response->delete();
    $this->getUser()->setFlash('success', 'Response deleted correctly!');
    $this->redirect(array('sf_route' => sfInflector::underscore(get_class($this->content)).'_edit', 'sf_subject' => $this->content));
  }
}
