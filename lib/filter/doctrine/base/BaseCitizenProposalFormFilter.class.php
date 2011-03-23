<?php

/**
 * CitizenProposal filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCitizenProposalFormFilter extends ContentFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['tip'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['tip'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('citizen_proposal_filters[%s]');
  }

  public function getModelName()
  {
    return 'CitizenProposal';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'tip' => 'Text',
    ));
  }
}
