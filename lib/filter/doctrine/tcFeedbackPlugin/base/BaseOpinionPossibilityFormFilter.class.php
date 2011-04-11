<?php

/**
 * OpinionPossibility filter form base class.
 *
 * @package    demofony
 * @subpackage filter
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOpinionPossibilityFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'opinion_possibility_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OpinionPossibilityGroup'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                         => new sfValidatorPass(array('required' => false)),
      'opinion_possibility_group_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OpinionPossibilityGroup'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('opinion_possibility_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OpinionPossibility';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'name'                         => 'Text',
      'opinion_possibility_group_id' => 'ForeignKey',
    );
  }
}
