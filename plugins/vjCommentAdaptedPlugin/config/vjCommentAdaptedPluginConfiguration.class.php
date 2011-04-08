<?php
/**
 * vjCommentPlugin configuration.
 * 
 * @package    vjCommentPlugin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 */
class vjCommentAdaptedPluginConfiguration extends sfPluginConfiguration
{
  static protected $HTMLPurifierLoaded = false;
  
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('routing.load_configuration', array('vjCommentRouting', 'listenToRoutingLoadConfigurationEvent'));
    if (in_array('commentAdmin', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('vjCommentRouting', 'addRouteForAdminComments'));
    }
    if (in_array('commentReportAdmin', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('vjCommentRouting', 'addRouteForAdminReportedComments'));
    }
    self::registerHTMLPurifier();
  }

  static public function registerHTMLPurifier()
  {
    if(self::$HTMLPurifierLoaded) {
      return;
    }

    require_once(sfConfig::get('sf_plugins_dir').'/vjCommentAdaptedPlugin/lib/tools/htmlpurifier/library/HTMLPurifier/Bootstrap.php');

    spl_autoload_register(array('HTMLPurifier_Bootstrap', 'autoload'));

    self::$HTMLPurifierLoaded = true;
  }
}
