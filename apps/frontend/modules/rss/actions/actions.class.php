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
    $feed = new sfAtom1Feed();

    $feed->initialize(array(
      'title'       => 'The mouse blog',
      'link'        => 'http://www.myblog.com/',
      'authorEmail' => 'pclive@myblog.com',
      'authorName'  => 'Peter Clive'
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
}