<?php

/**
 * ProposalHasCategory filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProposalHasCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'slug'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'slug'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proposal_has_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProposalHasCategory';
  }

  public function getFields()
  {
    return array(
      'proposal_id' => 'Number',
      'category_id' => 'Number',
      'slug'        => 'Text',
    );
  }
}
