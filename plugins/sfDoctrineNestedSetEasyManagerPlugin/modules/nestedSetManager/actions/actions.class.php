<?php
/**
 * nestedSetManager actions.
 * 
 * @uses sfActions
 * @package sfDoctrineNestedSetEasyManagerPlugin
 * @subpackage nestedSetManager
 * @version 0.8.5
 * @author David Valin Cabrera, Binarty <info@binarty.com>
 * @license See LICENSE that came packaged with this software
 */

class nestedSetManagerActions extends sfActions
{
  public function executeAdd_root()
  {
    $model = $this->getRequestParameter('model');
    $item = new $model;
    $item->save();
    
    Doctrine::getTable($model)->getTree()->createRoot($item);

    return $this->renderComponent('nestedSetManager','manager',array('model' => $this->getRequestParameter('model'), 'field' => $this->getRequestParameter('field')));
  }

  public function executeAdd_child()
  {
    $parent_id = $this->getRequestParameter('parent_id');
    $model = $this->getRequestParameter('model');

    $record = Doctrine::getTable($model)->find($parent_id);

    $child = new $model;
    $record->getNode()->addChild($child);

    return $this->renderComponent('nestedSetManager','manager',array('model' => $this->getRequestParameter('model'), 'field' => $this->getRequestParameter('field')));
  }
  
  public function executeEdit_field()
  {
    // We just need the edit_fieldSuccess.php template
  }

  public function executeDoEditField()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');
    $field = $this->getRequestParameter('field');
    $field_value = $this->getRequestParameter('field_value');
    
    $record = Doctrine::getTable($model)->find($id);
    $record->set($field,$field_value);
    $record->save();

    return $this->renderComponent('nestedSetManager','manager',array('model' => $this->getRequestParameter('model'), 'field' => $this->getRequestParameter('field')));
  }

  public function executeDelete()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');

    $record = Doctrine::getTable($model)->find($id);
    $record->getNode()->delete();

		return $this->renderComponent('nestedSetManager','manager',array('model' => $this->getRequestParameter('model'), 'field' => $this->getRequestParameter('field')));
  }

  public function executeMove()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');
    $field = $this->getRequestParameter('field');
    $direction = $this->getRequestParameter('direction');

    $record = Doctrine::getTable($model)->find($id);

    if( $direction == 'up' )
    {
      if($prev = $record->getNode()->getPrevSibling()) {
        $record->getNode()->moveAsPrevSiblingOf($prev);
      }

    }
    else if( $direction == 'down' )
    {
      $next = $record->getNode()->getNextSibling();
      $record->getNode()->moveAsNextSiblingOf($next);
    }
    return $this->renderComponent('nestedSetManager','manager',array('model' => $this->getRequestParameter('model'), 'field' => $this->getRequestParameter('field')));
  }
}
