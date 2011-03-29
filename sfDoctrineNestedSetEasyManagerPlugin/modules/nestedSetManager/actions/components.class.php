<?php
/**
 * nestedSetManager components.
 * 
 * @uses sfComponents
 * @package sfDoctrineNestedSetEasyManagerPlugin
 * @subpackage nestedSetManager
 * @version 0.8.5
 * @author David Valin Cabrera, Binarty <info@binarty.com>
 * @license See LICENSE that came packaged with this software
 */

class nestedSetManagerComponents extends sfComponents
{
  public function getTree($model, $rootId = 0)
  {
    return Doctrine::getTable($model)->getTree();
  }

  public function executeManager()
  {
    $this->tree = $this->getTree($this->model);
  }
}