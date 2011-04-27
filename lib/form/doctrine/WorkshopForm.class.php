<?php

/**
 * Workshop form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WorkshopForm extends BaseWorkshopForm
{
  /**
   * @see ActionForm
   */
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['price']->setAttributes(array('size'=>4));
  }
}
