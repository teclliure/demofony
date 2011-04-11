<?php

require_once(sfConfig::get('sf_plugins_dir').'/vjCommentAdaptedPlugin/modules/comment/lib/BaseCommentComponents.class.php');

/**
 * comment component.
 *
 * @package    vjCommentPlugin
 * @subpackage comment
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class commentComponents extends BaseCommentComponents
{
  public function executeCommentBoxAjax($request) {
    $this->form_name = $this->generateCryptModel();
  }
  
  public function executeFormCommentAjax(sfWebRequest $request)
  {
    $this->form = new CommentForm(null, array('user' => $this->getUser(), 'name' => $this->generateCryptModel()));
    $this->form->setDefault('record_model', $this->object->getTable()->getComponentName());
    $this->form->setDefault('record_id', $this->object->get('id'));
  }

  public function executeListAjax(sfWebRequest $request)
  {
    $this->executeList($request);
  }
  
  public function executeFormReportAjax($request) {
    // If we come from the action because forms has errors we don't create a new form
    if (!isset($this->formReport)) {
      $this->formReport = new CommentReportForm(null, array('id_comment'  => $this->id_comment,'referer'=>url_for($request->getUri())."#".$this->num));
    }
  }
}
