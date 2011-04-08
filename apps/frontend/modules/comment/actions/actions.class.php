<?php

require_once(sfConfig::get('sf_plugins_dir').'/vjCommentAdaptedPlugin/modules/comment/lib/BaseCommentActions.class.php');

class commentActions extends BaseCommentActions
{
  public function executeFormCommentAjax(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($request->getParameter('record_model'));
    $this->forward404Unless($request->getParameter('record_id'));
    $table = Doctrine::getTable($request->getParameter('record_model'));
    $this->object = $table->findOneBy('id',$request->getParameter('record_id'));
    $this->form = new CommentForm(null, array('user' => $this->getUser(), 'name' => $this->generateCryptModel($request)));
    $this->form->setDefault('record_model', $request->getParameter('record_model'));
    $this->form->setDefault('record_id', $request->getParameter('record_id'));

    //preparing temporary array with sent values
    $formValues = $request->getParameter($this->form->getName());

    if( vjComment::isCaptchaEnabled() && !vjComment::isUserBoundAndAuthenticated($this->getUser()) )
    {
      $captcha = array(
        'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
        'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
      );
      //Adding captcha
      $formValues = array_merge( $formValues, array('captcha' => $captcha)  );
    }
    if( vjComment::isUserBoundAndAuthenticated($this->getUser()) )
    {
      //adding user id
      $formValues = array_merge( $formValues, array('user_id' => $this->getUser()->getGuardUser()->getId() )  );
    }

    $this->form->bind($formValues);
    if ($this->form->isValid())
    {
      $this->form->save();
      return $this->renderComponent('comment', 'listAjax', array('object' => $this->object, 'i' => 0));
    }
  }
  
  public function executeListAjax(sfWebRequest $request)
  {
    $this->forward404Unless($request->getParameter('record_model'));
    $this->forward404Unless($request->getParameter('record_id'));
    $table = Doctrine::getTable($request->getParameter('record_model'));
    $this->object = $table->findOneBy('id',$request->getParameter('record_id'));
    return $this->renderComponent('comment', 'listAjax', array('object' => $this->object, 'i' => 0));
  }
  
  private function generateCryptModel()
  {
    $model = $this->object->getTable()->getComponentName();
    $id = $this->object->get('id');
    $this->crypt = vjComment::getFormName($model.$id);
    return $this->crypt;
  }
  
  public function executeFormReportAjax($request) {
    $this->form = new CommentReportForm(null, array('id_comment'  => $request->getParameter('id_comment')));
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
      }
      else {
        return $this->renderComponent('comment','formReportAjax',array('id_comment'=>$request->getParameter('id_comment'),'formReport'=>$this->form));
      }
    }
  }
  
/*  private function initPager(sfWebRequest $request)
  {
    if ($this->has_comments = $this->object->hasComments())
    {
      $query = $this->object->getAllComments(vjComment::getListOrder());
      $max_per_page = vjComment::getMaxPerPage($query);
      $page = $request->getParameter('page', 1);

      $this->pager = new sfDoctrinePager('Comment', $max_per_page);
      $this->pager->setQuery($query);
      $this->pager->setPage($page);
      $this->pager->init();
      $this->cpt = $max_per_page * ($page - 1);
    }
  }*/
}
