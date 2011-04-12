<?php

/**
 * GovermentProposal form base class.
 *
 * @method GovermentProposal getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGovermentProposalForm extends ContentForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('goverment_proposal[%s]');
  }

  public function getModelName()
  {
    return 'GovermentProposal';
  }

}
