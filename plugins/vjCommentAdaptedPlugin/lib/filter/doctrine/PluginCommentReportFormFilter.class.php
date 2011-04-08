<?php

/**
 * PluginCommentReport form.
 *
 * @package    vjCommentPlugin
 * @subpackage filter
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCommentReportFormFilter extends BaseCommentReportFormFilter
{
  public function setup()
  {
    parent::setup();
    $choices = $this->getStateChoices();
    $this->widgetSchema['state'] = new sfWidgetFormChoice(array('choices' => $choices));
  }

  private function getStateChoices()
  {
    $choices = array('' => '');
    foreach(array('valid', 'invalid', 'untreated') as $c)
    {
      $choices[$c] = __($c, array(), 'sf_admin');
    }
    return $choices;
  }
}
