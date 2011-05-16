<?php

/**
 * CitizenProposal form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CitizenProposalForm extends BaseCitizenProposalForm
{
  /**
   * @see ContentForm
   */
  public function configure()
  {
    parent::configure();
    $this->widgetSchema->setLabel('tip','Comments to Administrator (This text will NOT be published)');
  }
}
