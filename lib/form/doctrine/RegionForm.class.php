<?php

/**
 * Region form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RegionForm extends BaseRegionForm
{
  public function configure()
  {
    // create a new widget to represent this region's "parent"
    $this->setWidget('parent', new sfWidgetFormDoctrineChoiceNestedSet(array(
      'model'     => 'Region',
      'add_empty' => true,
    )));

    // if the current region has a parent, make it the default choice
    if ($this->getObject()->getNode()->hasParent())
    {
      $this->setDefault('parent', $this->getObject()->getNode()->getParent()->getId());
    }

    // only allow the user to change the name of the region, and its parent
    $this->useFields(array(
      'name',
      'parent',
      'description'
    ));
    // set labels of fields
    $this->widgetSchema->setLabels(array(
      'name'   => 'Region',
      'parent' => 'Parent region',
      'description' => 'Description'
    ));
    // set a validator for parent which prevents a region being moved to one of its own descendants
    $this->setValidator('parent', new sfValidatorDoctrineChoiceNestedSet(array(
      'required' => false,
      'model'    => 'Region',
      'node'     => $this->getObject(),
    )));
    $this->getValidator('parent')->setMessage('node', 'A region cannot be made a descendent of itself.');
  }
  
  /**
   * Updates and saves the current object. Overrides the parent method
   * by treating the record as a node in the nested set and updating
   * the tree accordingly.
   *
   * @param Doctrine_Connection $con An optional connection parameter
   */
  public function doSave($con = null)
  {
    // save the record itself
    parent::doSave($con);
    // if a parent has been specified, add/move this node to be the child of that node
    if ($this->getValue('parent'))
    {
      $parent = Doctrine::getTable('Region')->findOneById($this->getValue('parent'));
      if ($this->isNew())
      {
        $this->getObject()->getNode()->insertAsLastChildOf($parent);
      }
      else
      {
        $this->getObject()->getNode()->moveAsLastChildOf($parent);
      }
    }
    // if no parent was selected, add/move this node to be a new root in the tree
    else
    {
      $categoryTree = Doctrine::getTable('Region')->getTree();
      if ($this->isNew())
      {
        $categoryTree->createRoot($this->getObject());
      }
      else
      {
        $this->getObject()->getNode()->makeRoot($this->getObject()->getId());
      }
    }
  }
  
}
