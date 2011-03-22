<?php

/**
 * ProposalHasCategory form base class.
 *
 * @method ProposalHasCategory getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProposalHasCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'proposal_id' => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormInputHidden(),
      'slug'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'proposal_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('proposal_id')), 'empty_value' => $this->getObject()->get('proposal_id'), 'required' => false)),
      'category_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('category_id')), 'empty_value' => $this->getObject()->get('category_id'), 'required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ProposalHasCategory', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('proposal_has_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProposalHasCategory';
  }

}
