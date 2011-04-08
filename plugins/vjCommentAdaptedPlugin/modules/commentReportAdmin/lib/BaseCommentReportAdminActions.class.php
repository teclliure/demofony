<?php
require_once dirname(__FILE__).'/commentReportAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/commentReportAdminGeneratorHelper.class.php';

/**
 * BaseCommentReportAdmin actions.
 *
 * @package    vjCommentPlugin
 * @subpackage commentReportAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    12 mars 2010 13:55:42
 */
class BaseCommentReportAdminActions extends autoCommentReportAdminActions
{
  public function preExecute()
  {
    parent::preExecute();
    $this->getContext()->getConfiguration()->loadHelpers('I18N');
    $this->setFilters($this->getFilters());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->getUser()->setFlash('error', __('You can\'t add new report.', array(), 'sf_admin'));
    $this->redirect('@commentReportAdmin');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->getUser()->setFlash('error', __('You can\'t edit report.', array(), 'sf_admin'));
    $this->redirect('@commentReportAdmin');
  }

  protected function setFilters(array $filters)
  {
    if($filters == array())
    {
      $filters['state'] = "untreated";
    }
    return $this->getUser()->setAttribute($this->getModuleName().'.filters', $filters, 'admin_module');
  }

  public function executeValidate(sfWebRequest $request)
  {
    $this->changeState("valid");
    $this->getUser()->setFlash('notice', __('Report validated', array(), 'sf_admin'));
    $this->redirect('@commentReportAdmin');
  }

  public function executeInvalidate(sfWebRequest $request)
  {
    $this->changeState("invalid");
    $this->getUser()->setFlash('notice', __('Report invalidated', array(), 'sf_admin'));
    $this->redirect('@commentReportAdmin');
  }

  private function changeState($state)
  {
    $obj = $this->getRoute()->getObject();
    $obj->state = $state;
    $obj->save();
    return $obj;
  }

  public function executeEditComment(sfWebRequest $request)
  {
    $this->redirect(array('sf_route' => 'commentAdmin_edit', 'sf_subject' => $this->getRoute()->getObject()->getComment()));
  }

  public function executeDeleteComment(sfWebRequest $request)
  {
    $obj = $this->changeState("valid");;
    if($comment = Doctrine::getTable('Comment')->find($obj->getIdComment()))
    {
      $comment->is_delete = true;
      $comment->save();
      $this->getUser()->setFlash('notice', __('Comment removed and report validated.', array(), 'sf_admin'));
      $this->redirect('@commentReportAdmin');
    }
  }
}
?>
