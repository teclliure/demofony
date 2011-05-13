<?php

/**
 * VirtualMeetingAnswer form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VirtualMeetingAnswerForm extends BaseVirtualMeetingAnswerForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at']);
  }
}
