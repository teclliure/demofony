<?php

/**
 * BaseComment actions.
 *
 * @package    vjCommentPlugin
 * @subpackage comment
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseCommentActions extends sfActions
{
  public function executeReporting(sfWebRequest $request)
  {
    $this->form = new CommentReportForm(null, array(
                                'id_comment'  => $request->getParameter('id'),
                                'referer'     => $request->getReferer()."#".$request->getParameter('num')
    ));
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->redirect("@comment_reported");
      }
    }
  }

  public function executeReported(sfWebRequest $request)
  {
  }
}