<?php

/**
 * CitizenProposal form base class.
 *
 * @method CitizenProposal getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCitizenProposalForm extends ContentForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['tip'] = new sfWidgetFormTextarea();
    $this->validatorSchema['tip'] = new sfValidatorString(array('required' => false));

    $this->widgetSchema->setNameFormat('citizen_proposal[%s]');
  }

  public function getModelName()
  {
    return 'CitizenProposal';
  }

}
