<?php

/**
 * Action
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Action extends BaseAction
{
  
  public function isOpened() {
    if (strtotime($this->getActionDate()) >= time() && !$this->isFull()) {
      return true;
    }
    else return false;
  }
  
  public function getNumberUsersRegistered() {
    return $this->getUsersRegistered()->count();
  }
  
  public function getUsersRegistered() {
    $q = $this->getUserRegisteredQuery();
    return $q->execute();
  }
  
  public function registerUser($user) {
    $actionUser = new ActionHasUser();
    $actionUser->setUserId($user->getId());
    $actionUser->setType(get_class($this));
    $actionUser->setActionId($this->getId());
    $actionUser->save();
  }
  
  public function unregisterUser($user) {
    $query= $this->getActionUserRegisteredQuery();
    $query->andWhere('ur.user_id = ?',$user->getId());
    $actionUser = $query->execute()->getFirst();
    $actionUser->delete();
  }
  
  public function hasRegistered($user) {
    $query = $this->getActionUserRegisteredQuery()->andWhere('ur.user_id = ?',$user->getId());
    return $query->count();
  }
  
  public function isFull() {
    if (!$this->getMaxUsersAllowed() || ($this->getMaxUsersAllowed() >= $this->getNumberUsersRegistered())) return false;
    else return true;
  }
  
  public function canBeClosed() {
    if ((strtotime($this->getActionDate()) >= date('Y-m-d',time())) && $this->getLocation() && ($this->getNumberUsersRegistered() >= $this->getMinUsersAllowed())) return true;
    else return false;
  }
  
  public function confirm() {
    $i18n = sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
    $action = sfContext::getInstance()->getActionStack()->getFirstEntry()->getActionInstance();
    $message = Swift_Message::newInstance()
    ->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'from@noreply.com'))
    ->setTo($this->getSfGuardUser()->getEmailAddress())
    ->setSubject(sfInflector::humanize(sfInflector::underscore(get_class($this))).' '.__('confirmed !!'))
    ->setBody($action->getPartial('mails/confirmHtmlEmail', array('object' => $this)), 'text/html');
    
    $users = $this->getUsersRegistered();
    foreach ($users as $user) {
      $message->addBcc($user->getEmailAddress(),$user->__toString());
    }

    $action->getMailer()->send($message);
    
    $this->setConfirmed(1);
    $this->save();
  }
  
  protected function getActionUserRegisteredQuery() {
    return Doctrine_Core::getTable('ActionHasUser')->createQuery('ur')->where('ur.action_id = ? ',$this->getId())->andWhere('ur.type = ?',get_class($this));
  }
  
  protected function getUserRegisteredQuery() {
    return Doctrine_Core::getTable('sfGuardUser')->createQuery('u')->LeftJoin('u.ActionHasUser ur')->where('ur.action_id = ? ',$this->getId())->andWhere('ur.type = ?',get_class($this));
  }
  
}
