<?php

class Doctrine_Template_Commentable extends Doctrine_Template
{
  public function setTableDefinition()
  {
    $this->addListener(new Doctrine_Template_Listener_Commentable($this->_options));
  }
  
  public function hasComments()
  {
    return $this->getNbComments() > 0;
  }
  
  public function getNbComments()
  {
    return $this->getCommentsQuery()->count();
  }
  
  public function addComment(Comment $comment)
  {
    $comment->set('record_model', $this->_invoker->getTable()->getComponentName());
    $comment->set('record_id', $this->_invoker->get('id'));
    $comment->save();
    
    return $this->_invoker;
  }

  public function getAllComments($order = 'ASC')
  {
    return $this->getCommentsQuery($order);
  }

  public function getCommentsQuery($order = 'ASC')
  {
    $query = Doctrine::getTable('Comment')->createQuery('c')
      ->where('c.record_id = ?', $this->_invoker->get('id'))
      ->andWhere('c.record_model = ?', $this->_invoker->getTable()->getComponentName())
      ->orderBy('c.created_at '.strtoupper($order));
    $query->leftJoin( 'c.User as u');
    return $query;
  }
}
