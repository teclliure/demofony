<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

class sfGuardAuthActions extends BasesfGuardAuthActions {
  public function executeFormLoginAjax($request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      return $this->renderText('User already logged in');
    }

    $this->form = new sfGuardFormSigninFrontend();
    // if we have been forwarded, then the referer is the current URL
    // if not, this is the referer of the current request
    $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());
    $module = sfConfig::get('sf_login_module');
    if ($this->getModuleName() != $module)
    {
      return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
    }
  }
}
