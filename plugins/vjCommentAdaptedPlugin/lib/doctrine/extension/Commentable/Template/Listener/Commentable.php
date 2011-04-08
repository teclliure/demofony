<?php

class Doctrine_Template_Listener_Commentable extends Doctrine_Record_Listener
{

  public function __construct($options = array())
  {
    $this->_options = $options;
  }

  public function postDelete(Doctrine_Event $event)
  {
    $event->getInvoker()->getAllComments()->delete();
  }
}