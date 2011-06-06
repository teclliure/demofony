<?php

class userActions extends sfActions {
  public function executeRegister($request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }
    
    $form = new RegisterMultipageForm();
 
    //set persistance strategy
    $form->setPersistanceStrategy(new psPageableFormSessionPersistanceStrategy($this->getUser()));
     
    $processOptions = array(
        'formParameterName' => 'register' //parameter of $request->getParameter() method
    );
    
    if ($request->getParameter('recaptcha_challenge_field')) {
      $data = $request->getParameter('register');
      $data['sf_guard_user']['captcha'] = array();
      $data['sf_guard_user']['captcha']['recaptcha_challenge_field'] = $request->getParameter('recaptcha_challenge_field');
      $data['sf_guard_user']['captcha']['recaptcha_response_field'] = $request->getParameter('recaptcha_response_field');
      
      $request->setParameter('register',$data);
    }
    
    //create and execute form processing
    $process = new psPageableFormProcess($form, $request, $processOptions);
     
    if($process->process())
    {
      //save and redirect
      $forms = $form->getForms();
      
      try {
        $conn = Doctrine_Manager::connection();

        $conn->beginTransaction();
        foreach ($forms as $form) {
          $form->updateObject();
          if (get_class($form) == 'RegisterForm') {
            $userValues = $form->getValues();
          }
          elseif (get_class($form) == 'ProfileForm') {
            $userProfile = $form->getObject();
          }
        }
        $userProfile->setUsername($userValues['username']);
        $userProfile->setEmailAddress($userValues['email_address']);
        $userProfile->setPassword($userValues['password']);
        $userProfile->save($conn);
        
        $conn->commit();
        $this->getUser()->signIn($userProfile);
        $this->getUser()->setFlash('success', 'You are already registered and signed in!');
        $this->redirect('@homepage');
      }
      catch(Doctrine_Exception $e) {
        $this->getUser()->setFlash('error', 'Error saving to database: '.$e->getMessage(),true);
        $conn->rollback();
        $this->redirect('@homepage');
      }
    }
    
    $this->form = $form;
  }
  
  public function executeProfile($request)
  {
    if (!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'You must be signed in to edit your profile!');
      $this->redirect('@homepage');
    }

    $this->form = new ProfileForm($this->getUser()->getGuardUser());
    $validatorSchema = $this->form->getValidatorSchema();
    $validatorSchema['password']->setOption('required', false);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()),$request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $user = $this->form->save();
        $this->getUser()->setFlash('success', 'Profile saved!');

        $this->redirect('@profile');
      }
    }
  }
  
  public function executeShowProfile($request) {
    $this->userProfile = Doctrine_Core::getTable('sfGuardUser')->retrieveByUsername($request->getParameter('username'));
    $this->section = $request->getParameter('section');
    if (!$this->section) $this->section = 'opinions';
    $this->forward404Unless($this->userProfile);
    $this->map = $this->userProfile->getProfile()->getGmap();
    if ($this->map) {
      $this->getResponse()->addJavascript($this->map->getGMapsJSUrl());
    }
  }
  
  public function executeUnsubscribe() {
    if (!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'You must be signed in to unsubscribe');
      $this->redirect('@homepage');
    }
    $guardUser = $this->getUser()->getGuardUser();
    $guardUser->setIsActive(0);
    $this->getUser()->signOut();
    $this->getUser()->setFlash('msg', 'You have been correctly unsubscribed.');
    $this->redirect('@homepage');
  }
}
