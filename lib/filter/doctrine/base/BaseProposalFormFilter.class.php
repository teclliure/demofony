<?php

/**
 * Proposal filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProposalFormFilter extends ContentFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('proposal_filters[%s]');
  }

  public function getModelName()
  {
    return 'Proposal';
  }
}
