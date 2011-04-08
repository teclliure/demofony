<?php

/**
 * PluginCommentCommon form.
 *
 * @package    vjCommentPlugin
 * @subpackage form
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    12 mars 2010 10:09:18
 */
class PluginCommentCommonForm extends BaseCommentForm
{
  public function setup()
  {
    parent::setup();

    sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));
    $this->required     = __('Required', array(), 'vjComment');
    $this->invalid_mail = __('Invalid Mail', array(), 'vjComment');
    $this->invalid_url  = __('Invalid Url', array(), 'vjComment');
    $this->required_msg = __('Required message', array(), 'vjComment');
    
    $this->widgetSchema['record_model'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['record_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['reply'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['reply_author'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_name'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['reply'] = new sfValidatorPass();
    $this->validatorSchema['reply_author'] = new sfValidatorPass();
    $this->validatorSchema['user_name'] = new sfValidatorPass();

    $this->widgetSchema->setLabel('author_name', __('Name', array(), 'vjComment'));
    $this->widgetSchema->setLabel('author_email', 'Email');
    $this->widgetSchema->setLabel('author_website', __('Website', array(), 'vjComment'));
    $this->widgetSchema->setLabel('body', 'Message');
    $this->widgetSchema->setHelp('author_website', __('Must start with http:// or https://', array(), 'vjComment'));

    $this->validatorSchema['author_email'] = new sfValidatorEmail();
    $this->validatorSchema['author_website'] = new sfValidatorUrl();
    
    $this->validatorSchema['author_name']
      ->setMessage('required', $this->required);
    $this->validatorSchema['author_email']
      ->setMessage('required', $this->required)
      ->setMessage('invalid', $this->invalid_mail);
    $this->validatorSchema['author_website']
      ->setOption('required', false)
      ->setMessage('invalid', $this->invalid_url);
    $this->validatorSchema['body']
      ->setOption('required', true)
      ->setMessage('required', $this->required_msg);
  }

  protected function doUpdateObject($values)
  {
    $values['body'] = nl2br($values['body']);

    // if comment is a reply, update the body value
    if(isset($values['reply']) && $values['reply'] != "" && $obj = Doctrine::getTable('Comment')->find($values['reply']))
    {
      $tmp = commentTools::setQuote($obj->getAuthor(), $obj->body);
      $values['body'] = $tmp.$values['body'];
    }
    else
    {
      $values['reply'] = null;
    }
    $purifier = new vjCommentPurifier();
    $values['body'] = $purifier->purify($values['body']);
    parent::doUpdateObject($values);
  }
}
?>
