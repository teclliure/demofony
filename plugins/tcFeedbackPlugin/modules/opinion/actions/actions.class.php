<?php
class opinionActions extends sfActions
{
  public function executeAddOpinion ($request) {
    $table = Doctrine::getTable($request->getParameter('class'));
    $object = $table->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($object);
    $this->forward404Unless($object->getActive());
    $this->form = new FrontendOpinionForm(null, array('user'=>$this->getUser(),'object'=>$object));
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->object = $object;
        $this->form->save();
      }
      else {
        return $this->renderComponent('opinion','opinate',array('object'=>$object,'form'=>$this->form));
      }
    }
  }
  
  public function executeList($request) {
    $table = Doctrine::getTable($request->getParameter('class'));
    $object = $table->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($object);
    $this->forward404Unless($object->getActive());
    return $this->renderPartial('opinion/list', array('object'=>$object, 'opinions'=>$object->getOpinions()));
  }
  
  public function executeOpinate($request) {
    $table = Doctrine::getTable($request->getParameter('class'));
    $object = $table->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($object);
    $this->forward404Unless($object->getActive());
    return $this->renderComponent('opinion','opinate', array('object'=>$object));
  }
  
  public function executeOpinateLike($request) {
    if (!$this->getUser()->isAuthenticated()) {
      return $this->renderText('You must be logged in to opinate');
    }
    $this->opinion = Doctrine::getTable('Opinion')->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->opinion);
    $this->object = $this->opinion->getObject();
    
    if ($this->object->hasOpinated($this->getUser()->getGuardUser())) {
      return $this->renderText('You have opinated already');
    }
    $opinionLike = new OpinionLike();
    $opinionLike->setOpinionId($this->opinion->getId());
    $opinionLike->setUserId($this->getUser()->getGuardUser()->getId());
    $opinionLike->save();
  }
  
  public function executeMarkAsSpam($request) {
    if (!$this->getUser()->isAuthenticated()) {
      return $this->renderText('You must be logged in to mark as innadecuate');
    }
    $this->opinion = Doctrine::getTable('Opinion')->findOneBy('id',$request->getParameter('id'));
    $this->forward404Unless($this->opinion);
    $this->object = $this->opinion->getObject();
    
    $opinionSpam = new OpinionMarkedAsSpam();
    $opinionSpam->setOpinionId($this->opinion->getId());
    $opinionSpam->setUserId($this->getUser()->getGuardUser()->getId());
    $opinionSpam->save();
  }
}