<?php

/**
 * PluginOpinionLike
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class PluginOpinionLike extends BaseOpinionLike
{
  
  public function __toString() {
    sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
    return $this->getOpinion().' '.__('like').' '.$this->getOpinion()->getSfGuardUser();
  }
  
  public function getGmapHtml() {
    SfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag','I18N','Url'));
    return link_to($this->getSfGuardUser(),'user/showProfile?username='.$this->getSfGuardUser()->getUsername()).' '.__('opinated like').' '.$this->getOpinion()->getSfGuardUser();
  }
  
  public function getGmapIcon() {
    return null;
  }
}