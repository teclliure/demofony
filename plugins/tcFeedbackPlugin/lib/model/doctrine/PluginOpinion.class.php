<?php

/**
 * PluginOpinion
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class PluginOpinion extends BaseOpinion
{
  public function __toString() {
    if ($this->getOpinionPossibilityId()) {
      return $this->getOpinionPossibility()->getName();
    }
    else {
      return $this->getOpinion();
    }
  }
  
  public function countOpinionsLike() {
    $query = Doctrine::getTable('OpinionLike')->createQuery('o')->where('o.opinion_id = ?',$this->getId());
    return $query->count();
  }
  
  public function getObject() {
    return Doctrine::getTable($this->getObjectClass())->findOneBy('id',$this->getObjectId());
  }
  
  public function hasMarkedAsSpam($user) {
    $query = Doctrine::getTable('OpinionMarkedAsSpam')->createQuery('os')->where('os.opinion_id = ?',$this->getId())->andWhere('os.user_id = ?',$user->getId());
    return $query->count();
  }
  
  public function setAsSpam() {
    $this->cleanOpinionMarkedAsSpam();
    $this->setInnapropiate(1);
    $this->save();
  }
  
  public function setAsNotSpam() {
    $this->cleanOpinionMarkedAsSpam();
    $this->setInnapropiate(0);
    $this->save();
  }
  
  protected function cleanOpinionMarkedAsSpam() {
    $query = Doctrine::getTable('OpinionMarkedAsSpam')->createQuery('os')->where('os.opinion_id = ?',$this->getId());
    return $query->delete()->execute();
  }

  public function getGmapHtml() {
    SfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag','I18N','Url'));
    return link_to($this->getSfGuardUser(),'user/showProfile?username='.$this->getSfGuardUser()->getUsername()).' '.__('opined').' '.$this->__toString();
  }
  
  public function getGmapIcon() {
    if ($this->getOpinionPossibility()) {
      if ($this->getOpinionPossibility()->getGmapBubbleImage()) {
        SfContext::getInstance()->getConfiguration()->loadHelpers(array('Asset'));
        return image_path('gmap_icons/'.$this->getOpinionPossibility()->getGmapBubbleImage());
      }
    }
    return null;
  }
  
  public function getFrontendUrl() {
    return sfContext::getInstance()->getConfiguration()->generateFrontendUrl($this->getUrl());
  }
  /* RSS Methods */
  public function getTitle() {
    $content = $this->getObject();
    return $content. ' :'.$this->__toString();
  }
  
  public function getUrl() {
    $content = $this->getObject();
    return 'content/show?class='.get_class($content).'&slug='.$content->getSlug();
  }
  
  public function getAuthorName() {
    return $this->getSfGuardUser()->__toString();
  }
  
  public function getFeedPubdate() {
    return strtotime($this->getCreatedAt());
  }
  
  public function getDescription() {
    return $this->getOpinion();
  }
}