<?php

/**
 * GovermentProposal filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGovermentProposalFormFilter extends ProposalFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('goverment_proposal_filters[%s]');
  }

  public function getModelName()
  {
    return 'GovermentProposal';
  }
}
