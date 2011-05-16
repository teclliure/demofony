<?php


class languageComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeLanguage(sfWebRequest $request)
  {
  	$languages = array();
  	
  	$confLanguages = sfConfig::get('app_cultures_enabled');
  	 
  	foreach($confLanguages as $language=>$label)
  	{
  		$languages[] = $language;
  	}
  	$routing = sfContext::getInstance()->getRouting();
 
    // Use the following in article/read action
    $uri = $routing->getCurrentInternalUri();
  	$this->form = new sfFormLanguageAdapted(
      $this->getUser(),
      array('languages' => $languages, 'url'=>$uri)
    );
  }
}
