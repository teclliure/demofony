<?php

/**
 * OpinionLike form base class.
 *
 * @method OpinionLike getObject() Returns the current form's model object
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpinionLikeForm extends PluginOpinionLikeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('opinion_like[%s]');
  }

  public function getModelName()
  {
    return 'OpinionLike';
  }

}
