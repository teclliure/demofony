<?php
/**
 * home components.
 *
 * @package    demofony
 * @subpackage home
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeComponents extends sfComponents
{
  public function executeMenu(sfWebRequest $request)
  {
    $arr = sfConfig::get('app_menus_admin_menu');
    try
    {
      sfYaml::setSpecVersion('1.2');
      
      $arr = sfYaml::load(sfConfig::get('sf_root_dir').'/apps/backend/config/menus.yml');
      $this->menu = ioMenuItem::createFromArray($arr);
    }
    catch (Exception $e)
    {
      throw new Exception ('Unable to load menu yml: '.$e->getMessage());
    }
   
    // $this->forward('default', 'module');
  }
}
