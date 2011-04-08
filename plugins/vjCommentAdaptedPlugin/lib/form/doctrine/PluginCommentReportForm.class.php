<?php

/**
 * PluginCommentReport form.
 *
 * @package    vjCommentPlugin
 * @subpackage form
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    4 mars 2010 16:50:08
 */
abstract class PluginCommentReportForm extends BaseCommentReportForm
{
  public function setup()
  {
    parent::setup();
    sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

    unset($this['created_at'], $this['updated_at'], $this['state']);

    $this->widgetSchema['id_comment'] = new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('id_comment')));
    $this->widgetSchema['referer'] = new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('referer')));
    $this->widgetSchema
            ->setLabel('reason', __('Reason', array(), 'vjComment'))
            ->setHelp('reason', __('Why this message should be moderated ?', array(), 'vjComment'));
    $this->validatorSchema['reason']
            ->setMessage('required', __('Required', array(), 'vjComment'));

    $this->validatorSchema['id_comment'] = new sfValidatorDoctrineChoice(array('model' => 'Comment', 'column' => 'id', 'required' => true));
  }
}
?>
