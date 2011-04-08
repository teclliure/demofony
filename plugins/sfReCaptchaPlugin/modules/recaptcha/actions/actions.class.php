<?php
/**
 * recaptcha actions.
 *
 * @author Arthur Koziel <arthur@arthurkoziel.com>
 */
class recaptchaActions extends sfActions
{
  /**
   * Executes index action
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new reCaptchaForm();

    if ($request->isMethod(sfRequest::POST))
    {  
      $requestData = array(
        'challenge' => $this->getRequestParameter('recaptcha_challenge_field'),
        'response'  => $this->getRequestParameter('recaptcha_response_field'),
      );

      $this->form->bind($requestData);
      if ($this->form->isValid()) 
      {
        // captcha is valid
      }
    }
  }
  
  public function executeMailhide()
  {
  }
}
