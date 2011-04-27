<?php

/**
 * Workshop form base class.
 *
 * @method Workshop getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkshopForm extends ActionForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['price'] = new sfWidgetFormInputText();
    $this->validatorSchema['price'] = new sfValidatorNumber(array('required' => false));

    $this->widgetSchema->setNameFormat('workshop[%s]');
  }

  public function getModelName()
  {
    return 'Workshop';
  }

}
