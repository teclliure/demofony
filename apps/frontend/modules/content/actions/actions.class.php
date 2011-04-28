<?php

class contentActions extends sfActions {
  public function executeShow($request)
  {
    $table = Doctrine::getTable($request->getParameter('class'));
    $this->content = $table->findOneBy('slug',$request->getParameter('slug'));
    $this->forward404Unless($this->content);
    $this->forward404Unless($this->content->getActive());
    $this->content->addView();
  }
  
  public function executeSelectContentType($request) {
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      return $this->renderText('You must be registered and logged in to add content');
    }
  }
  
  public function executeShowPage($request) {
    if ($request->getParameter('class') == 'Proposal') {
      $sql = Doctrine_Core::getTable('Proposal')->getSqlUnion();
      $pager = new sfPdoUnionPager ('Proposal',$request->getParameter('limit'));
      $pager->setSql($sql);
    }
    else {
      $pager = new sfDoctrinePager($request->getParameter('class'), $request->getParameter('limit'));
      $pager->setQuery(Doctrine_Core::getTable($request->getParameter('class'))->getActiveQuery());
    }
    $pager->setPage($request->getParameter('page'));
    $pager->init();
    
    $params = array('contents'=>$pager->getResults(),'pager'=>$pager);
    if ($request->getParameter('id')) {
      $params['id'] = $request->getParameter('id');
    }
    if ($request->getParameter('partial') != 'news' ) {
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
      $params['url'] = url_for('content/showPage?class='.$request->getParameter('class').'&id='.$request->getParameter('id').'&partial='.$request->getParameter('partial').'&limit=5');
    }
    return $this->renderPartial('content/'.$request->getParameter('partial'),$params);
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
  
  public function executeList($request) {
    if ($request->getParameter('title')) {
      $this->title = $request->getParameter('title');
    }
    else {
      $this->title = 'last';
    }
    $order = null;
    if ($this->title == 'more_viewed') {
      $order = 'ORDER BY views DESC';
    }
    $type = null;
    if ($request->getParameter('type')) {
      $type=array($request->getParameter('type'));
    }
    $categories = null;
    if ($request->getParameter('category')) {
      $categories=array($request->getParameter('category'));
    }
    $regions = null;
    if ($request->getParameter('region')) {
      $regions=array($request->getParameter('region'));
    }
    $sql = Doctrine_Core::getTable('Content')->getSqlUnion($order,$type,$categories,$regions);
    $this->pager = new sfPdoUnionPager ('Content',6);
    $this->pager->setSql($sql);
    $this->pager->setPage($request->getParameter('page',1));
    $this->pager->init();
    
    if ($request->isXmlHttpRequest()) {
      return $this->renderPartial('content/list',array('pager'=>$this->pager,'title'=>$this->title));
    }
    
    $this->categories = Doctrine_core::getTable('Category')->findAll();
    $this->regions = Doctrine_core::getTable('Region')->findAll();
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
