<?php

/**
 * PluginComment form.
 *
 * @package    vjCommentPlugin
 * @subpackage filter
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCommentFormFilter extends BaseCommentFormFilter
{
  public function setup()
  {
    parent::setup();
    $this->widgetSchema['record_model'] = new sfWidgetFormDoctrineChoice(array('model' => 'Comment', 'key_method' => 'getRecordModel', 'method' => 'getRecordModel', 'add_empty' => true));
    $this->validatorSchema['record_model'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Comment', 'column' => 'record_model'));
  }

  public function addRecordModelColumnQuery($query, $field, $value)
  {
    if (!empty($value))
    {
      $query->addWhere('record_model=?', $value);
    }
  }

}
