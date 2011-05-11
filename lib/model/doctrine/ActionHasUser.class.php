<?php

/**
 * ActionHasUser
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class ActionHasUser extends BaseActionHasUser
{
  public function __toString() {
    SfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
    return $this->getSfGuardUser().' '.__('has joined').' '.__($this->getType());
  }
  
  public function getGmapHtml() {
    SfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag','I18N','Url'));
    return link_to($this->getSfGuardUser(),'user/showProfile?username='.$this->getSfGuardUser()->getUsername()).' '.__('has joined').' '.__($this->getType());
  }
  
  public function getGmapIcon() {
    return null;
  }
}
