<?php

/**
 * Response form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ResponseForm extends BaseResponseForm
{
  public function configure()
  {
    $this->setWidget('content_type',new sfWidgetFormInputHidden ());
    $this->setWidget('content_id',new sfWidgetFormInputHidden ());
  }
}
