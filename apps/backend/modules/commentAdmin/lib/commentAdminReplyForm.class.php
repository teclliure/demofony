<?php

/**
 * commentAdminReply  admin form
 *
 * @package    vjCommentPlugin
 * @subpackage commentAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    4 mars 2010 10:45:36
 */
class commentAdminReplyForm extends commentAdminForm
{
  public function configure()
  {
    parent::configure();
    unset($this['created_at'], $this['updated_at'], $this['edition_reason']);
    
    $this->widgetSchema['reply_author'] = new sfWidgetFormInputText(array(), array('readonly' => "readonly"));
    $this->widgetSchema->setLabel('reply_author', __('Reply to', array(), 'vjComment'));
  }
}
?>
