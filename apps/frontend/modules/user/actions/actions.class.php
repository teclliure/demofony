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
        'formParameterName' => 'register' //parameter of $reqeust->getParameter() method
    );
     
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

    $this->form = new ProfileForm($this->getUser());

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $user = $this->form->save();

        $this->redirect('@profile');
      }
    }
  }
}
