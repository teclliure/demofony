<?php

/**
 * Workshop filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWorkshopFormFilter extends ActionFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['price'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['price'] = new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false)));

    $this->widgetSchema->setNameFormat('workshop_filters[%s]');
  }

  public function getModelName()
  {
    return 'Workshop';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'price' => 'Number',
    ));
  }
}
