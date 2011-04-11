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
        $this->form->save();
      }
      else {
        return $this->renderComponent('opinion','opinate',array('object'=>$object));
      }
    }
  }
}