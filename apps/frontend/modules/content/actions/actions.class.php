<?php

class contentActions extends sfActions {
  public function executeShow($request)
  {
    $this->content = Doctrine::getTable('Content')->findOneBy('slug',$request->getParameter('slug'));
    $this->forward404Unless($this->content);
    $this->forward404Unless($this->content->getActive());
  }
  
  public function executeSelectContentType($request) {
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      return $this->renderText('You must be registered and logged in to add content');
    }
  }
  
  public function executeAdd($request) {
    $this->class = $request->getParameter('class');
    $formName = 'Frontend'.$this->class.'Form';
    $this->form = new $formName();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $this->getUser()->setFlash('success', sfInflector::humanize(sfInflector::underscore($this->class)).' added correctly! It will be revised and published by administrator.');
        $this->redirect('@homepage');
        // $this->redirect('content/addedOk?class='.$this->class.'&id='.$object->getId());
      }
    }
  }
  
  /*public function executeAddOk($request) {
    $this->class = $request->getParameter('class');
    $this->id = $request->getParameter('id');
    $formName = 'Frontend'.$this->class.'Form';
    $this->form = new $formName();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->redirect('content/addedOk');
      }
    }
  }*/
}
