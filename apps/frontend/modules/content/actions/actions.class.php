<?php

class contentActions extends sfActions {
  public function executeShow($request)
  {
    $table = Doctrine::getTable($request->getParameter('class'));
    $this->content = $table->findOneBy('slug',$request->getParameter('slug'));
    $this->forward404Unless($this->content);
    $this->forward404Unless($this->content->getActive());
    $this->content->addView();
    $this->map = $this->content->getGmap();
    $this->mapOpinions = $this->content->getGmapOpinions();
    if ($this->map || $this->mapOpinions) {
      if ($this->map) $this->getResponse()->addJavascript($this->map->getGMapsJSUrl());
      else $this->getResponse()->addJavascript($this->mapOpinions->getGMapsJSUrl());
    }
  }
  
  public function executeSelectContentType($request) {
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      $this->getContext()->getConfiguration()->loadHelpers('I18N');
      return $this->renderText(__('You must be registered and logged in to add content'));
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
    $this->getContext()->getConfiguration()->loadHelpers('I18N');
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      return $this->renderText(__('You must be registered and logged in to add content'));
    }
    $this->class = $request->getParameter('class');
    $formName = 'Frontend'.$this->class.'Form';
    $this->form = new $formName();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $this->getUser()->setFlash('success', __(sfInflector::humanize(sfInflector::underscore($this->class))).' '.__('added correctly! It will be revised and published by administrator.'));
        $this->redirect('@homepage');
        // $this->redirect('content/addedOk?class='.$this->class.'&id='.$object->getId());
      }
    }
  }
  
  public function executeClose($request) {
    $this->getContext()->getConfiguration()->loadHelpers('I18N');
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      return $this->renderText(__('You must be registered and logged in to confirm content'));
    }
    $table = Doctrine::getTable($request->getParameter('class'));
    $this->content = $table->findOneBy('slug',$request->getParameter('slug'));
    $this->forward404Unless($this->content);
    $this->forward404Unless($this->content->getActive());
    if (!$this->content->hasEditPerms($this->getUser())) {
      return $this->renderText(__("You don't have permissions to confirm this action"));
    }
    if (!$this->content->canBeClosed()) {
      return $this->renderText(__("This action can't be confirmed"));
    }
    $this->content->confirm();

    $this->getUser()->setFlash('notice', __($this->content).' '.__('confirmed. An email was sent to all registered users.'));
    $this->redirect('content/show?class='.$request->getParameter('class').'&slug='.$request->getParameter('slug'));
  }
  
  public function executeEdit($request) {
    $this->getContext()->getConfiguration()->loadHelpers('I18N');
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      return $this->renderText(__('You must be registered and logged in to edit content'));
    }
    $table = Doctrine::getTable($request->getParameter('class'));
    $this->content = $table->findOneBy('slug',$request->getParameter('slug'));
    $this->forward404Unless($this->content);
    $this->forward404Unless($this->content->getActive());
    if (!$this->content->hasEditPerms($this->getUser())) {
      return $this->renderText(__("You don't have permissions to edit this content"));
    }
    $formName = 'Frontend'.$request->getParameter('class').'Form';
    $this->form = new $formName($this->content);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $this->getUser()->setFlash('success', sfInflector::humanize(sfInflector::underscore($request->getParameter('class'))).' edited correctly!');
        $this->redirect('content/show?class='.$request->getParameter('class').'&slug='.$request->getParameter('slug'));
        // $this->redirect('content/addedOk?class='.$this->class.'&id='.$object->getId());
      }
    }
    $this->setTemplate('add');
  }
  
  public function executeList($request) {
    $where = 'active = 1';
    if ($request->getParameter('q'))
    {
      $conn = Doctrine_Manager::connection();
      $where .= ' AND title LIKE '.$conn->quote('%'.$request->getParameter('q').'%');
      $this->title = 'SEARCH';
      $this->searchStr = $request->getParameter('q');
    }
    else {
      $this->searchStr = '';
    }
    if ($request->getParameter('title')) {
      $this->title = $request->getParameter('title');
    }
    elseif (!isset($this->title)) {
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
    $sql = Doctrine_Core::getTable('Content')->getSqlUnion($order,$type,$categories,$regions, $where);
    $this->pager = new sfPdoUnionPager ('Content',6);
    $this->pager->setSql($sql);
    $this->pager->setPage($request->getParameter('page',1));
    $this->pager->init();
    
    if ($request->isXmlHttpRequest()) {
      return $this->renderPartial('content/list',array('pager'=>$this->pager,'title'=>$this->title,'searchStr'=>$this->searchStr));
    }
    
    $this->categories = Doctrine_core::getTable('Category')->findAll();
    $this->regions = Doctrine_core::getTable('Region')->findAll();
  }
  
  public function executeFilter($request) {
    $form = new FilterByCategoryOrRegionForm();

    if ($request->isMethod('post'))
    {
      $form->bind($request->getParameter($form->getName()),$request->getFiles($form->getName()));
      if ($form->isValid())
      {
        $url = '';
        if ($form->getValue('regions')) {
          $url = 'region='.$form->getValue('regions');
        }
        if ($form->getValue('categories')) {
          $url = 'category='.$form->getValue('categories');
        }
        $this->redirect('content/list?title=filter&'.$url);
      }
    }
    elseif ($request->getParameter('q')) {
      $this->redirect('content/list?q='.$request->getParameter('q'));
    }
    $this->redirect('content/list?title=filter');
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
  
  public function executeJoin($request)
  {
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      $this->getContext()->getConfiguration()->loadHelpers('I18N');
      return $this->renderText(__('You must be registered and logged in to join'));
    }
    $table = Doctrine::getTable($request->getParameter('class'));
    $content = $table->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($content);
    $this->forward404Unless($content->getActive());
    $this->forward404Unless($content->hasJoinBox());
    $content->registerUser($this->getUser()->getGuardUser());
    return $this->renderPartial('content/joinButton',array('object'=>$content));
  }
  
  public function executeJoinBox($request)
  {
    $table = Doctrine::getTable($request->getParameter('class'));
    $content = $table->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($content);
    $this->forward404Unless($content->getActive());
    $this->forward404Unless($content->hasJoinBox());
    return $this->renderPartial('content/join',array('object'=>$content));
  }
  
  public function executeUnjoin($request)
  {
    $user = $this->getUser();
    if (!$user->isAuthenticated())
    {
      $this->getContext()->getConfiguration()->loadHelpers('I18N');
      return $this->renderText(__('You must be registered and logged in to join'));
    }
    $table = Doctrine::getTable($request->getParameter('class'));
    $content = $table->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($content);
    $this->forward404Unless($content->getActive());
    $this->forward404Unless($content->hasJoinBox());
    $content->unregisterUser($this->getUser()->getGuardUser());
    return $this->renderPartial('content/joinButton',array('object'=>$content));
  }
}
