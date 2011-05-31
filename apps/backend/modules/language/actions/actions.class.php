<?php

/**
 * language actions.
 *
 * @package    in2planner v.0.1
 * @subpackage language
 * @author     Maria Pascual Cerdan <m.pascual@in2ideas.nl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class languageActions extends sfActions
{
  public function executeChangeLanguage(sfWebRequest $request)
  {
  	$languages = array();

  	foreach(sfConfig::get('app_cultures_enabled') as $language=>$label)
  	{
  		$languages[] = $language;
  	}
  	 
    $form = new sfFormLanguageAdapted(
      $this->getUser(),
      array('languages' => $languages)
    );
 
    $form->process($request);
 
    return $this->redirect($form->getValue('url'));
  }
}
?>