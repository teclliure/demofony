<?php

/**
 * commentAdmin module helper.
 *
 * @package    vjCommentPlugin
 * @subpackage commentAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: helper.php 12474 2008-10-31 10:41:27Z fabien $
 */
class commentAdminGeneratorHelper extends BaseCommentAdminGeneratorHelper
{
  public function linkToEdit($object, $params)
  {
    $params['ui-icon'] = $this->getIcon('edit', $params);
    $params['params'] = UIHelper::addClasses($params, '');
    return '<li class="sf_admin_action_edit">'.link_to(UIHelper::addIcon($params) . __($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object, $params['params']).'</li>';
  }
  
  public function linkToIsDelete($object, $params)
  {
    $params['ui-icon'] = $this->getIcon('delete', $params);
    $params['params'] = UIHelper::addClasses($params, '');
    return '<li class="sf_admin_action_delete">'.link_to(UIHelper::addIcon($params).__($params['label'], array(), 'sf_admin'), 'commentAdmin/isDelete?id='.$object->getId(),$params['params']).'</li>';
  }

  public function linkToRestore($object, $params)
  {
    $params['ui-icon'] = $this->getIcon('arrowrefresh-1-w', $params);
    $params['params'] = UIHelper::addClasses($params, '');
    return '<li class="sf_admin_action_restore">'.link_to(UIHelper::addIcon($params).__($params['label'], array(), 'sf_admin'), 'commentAdmin/restore?id='.$object->getId(),$params['params']).'</li>';
  }

  /*public function linkToReply($object, $params)
  {
    $params['ui-icon'] = $this->getIcon('comment', $params);
    $params['params'] = UIHelper::addClasses($params, '');
    return '<li class="sf_admin_action_reply">'.link_to(UIHelper::addIcon($params).__($params['label'], array(), 'sf_admin'), 'commentAdmin/reply?id='.$object->getId(),$params['params']).'</li>';
  }*/

  public function linkToSaveAndDelete($object, $params)
  {
    $params['ui-icon'] = $this->getIcon('delete', $params);
    return '<li class="sf_admin_action_save_and_delete"><button type="submit" class="fg-button ui-state-default fg-button-icon-left" name="save_and_delete">'.UIHelper::addIcon($params).__($params['label'], array(), 'sf_admin').'</button></li>';
  }

  public function linkToSaveAndRestore($object, $params)
  {
    $params['ui-icon'] = $this->getIcon('arrowrefresh-1-w', $params);
    return '<li class="sf_admin_action_save_and_restore"><button type="submit" class="fg-button ui-state-default fg-button-icon-left" name="save_and_restore">'.UIHelper::addIcon($params).__($params['label'], array(), 'sf_admin').'</button></li>';
  }
}
