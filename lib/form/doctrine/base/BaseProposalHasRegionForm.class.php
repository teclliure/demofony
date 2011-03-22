<?php

/**
 * ProposalHasRegion form base class.
 *
 * @method ProposalHasRegion getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProposalHasRegionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'proposal_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proposal'), 'add_empty' => false)),
      'region_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Region'), 'add_empty' => false)),
      'slug'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'proposal_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proposal'))),
      'region_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Region'))),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'ProposalHasRegion', 'column' => array('id'))),
        new sfValidatorDoctrineUnique(array('model' => 'ProposalHasRegion', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('proposal_has_region[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProposalHasRegion';
  }

}
