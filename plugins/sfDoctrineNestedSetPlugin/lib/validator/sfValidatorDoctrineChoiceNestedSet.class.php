<?php

/**
 * sfValidatorDoctrineNestedSet checks that the destination of the node will not cause it to be
 * a descendant of itself.
 */
class sfValidatorDoctrineChoiceNestedSet extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * model: The model class (required)
   *  * node:  The node being moved (required)
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    $this->addRequiredOption('model');
    $this->addRequiredOption('node');

    $this->addMessage('node', 'A node cannot be set as a child of itself.');
  }

  /**
   * Verifies that the target node will not cause the current node to become a descendant of itself.
   *
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    if (isset($value) && !$value)
    {
      unset($value);
    }
    else
    {
      $targetNode = Doctrine::getTable($this->getOption('model'))->find($value)->getNode();
      if ($targetNode->isDescendantOfOrEqualTo($this->getOption('node')))
      {
        throw new sfValidatorError($this, 'node', array('value' => $value));
      }
      return $value;
    }
  }
}