<?php

/**
 * rss actions.
 *
 * @package    demofony
 * @subpackage rss
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rssActions extends sfActions
{
  public function executeLastContents(sfWebRequest $request)
  {
    $this->getContext()->getConfiguration()->loadHelpers('Url');
    $feed = new sfRss201Feed();

    $feed->initialize(array(
      'title'       => 'Demofony',
      'link'        => url_for('@homepage', true),
      'authorEmail' => sfConfig::get('app_info_email', 'info@noreply.com'),
      'authorName'  => sfConfig::get('app_info_author', 'Info')
    ));
    
    $sql = Doctrine_Core::getTable('Content')->getSqlUnion();
    $contentsPager = new sfPdoUnionPager ('Content',10);
    $contentsPager->setSql($sql);
    $contentsPager->setPage(1);
    $contentsPager->init();
    $contents = $contentsPager->getResults();
  
    $contentsItems = sfFeedPeer::convertObjectsToItems($contents);
    $feed->addItems($contentsItems);
  
    $this->feed = $feed;
    $this->setTemplate('rss');
  }
  
  public function executeLastOpinions(sfWebRequest $request)
  {
    $this->getContext()->getConfiguration()->loadHelpers('Url');
    $feed = new sfRss201Feed();

    
    $feed->initialize(array(
      'title'       => 'Demofony',
      'link'        => url_for('@homepage', true),
      'authorEmail' => sfConfig::get('app_info_email', 'info@noreply.com'),
      'authorName'  => sfConfig::get('app_info_author', 'Info')
    ));
    
    
    $contents = Doctrine::getTable('Opinion')->createQuery('o')->andWhere('o.innapropiate = 0')->orderBy('o.created_at desc')->limit(10)->execute();
    
    $contentsItems = sfFeedPeer::convertObjectsToItems($contents);
    $feed->addItems($contentsItems);
  
    $this->feed = $feed;
    $this->setTemplate('rss');
  }
}