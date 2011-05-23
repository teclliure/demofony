<?php

/**
 * home actions.
 *
 * @package    demofony
 * @subpackage home
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->contents = Doctrine_Core::getTable('Content')->getObjectsUnion('ORDER BY created_at asc', array('CitizenProposal','CitizenAction','Workshop'),null, null, 'active = 0');
    $this->numContents = count($this->contents);
    $this->numComments = Doctrine_Core::getTable('CommentReport')->count();
    $this->numOpinions = Doctrine_Core::getTable('OpinionMarkedAsSpam')->count();
    // $this->forward('default', 'module');
  }
}
