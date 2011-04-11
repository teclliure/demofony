<?php

/**
 * commentAdmin admin form
 *
 * @package    vjCommentPlugin
 * @subpackage commentAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    4 mars 2010 10:45:36
 */
class commentAdminForm extends PluginCommentCommonForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    if($this->getObject()->user_id != null )
    {
      unset( $this['author_email'], $this['author_website'], $this['author_name'] );
      $this->widgetSchema['user_name'] = new sfWidgetFormInput(array(), array('readonly' => 'true'));
      $this->widgetSchema['user_name']
        ->setLabel(__('Name', array(), 'vjComment'))
        ->setDefault($this->getObject()->getUser()->getUsername());
    }
    else
    {
      unset( $this['user_id'] );
    }

    $this->validatorSchema['edition_reason']
      ->setOption('required', true)
      ->setMessage('required', $this->required);
  }
}
