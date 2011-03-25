<?php

/**
 * Content form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContentForm extends BaseContentForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at'],$this['slug']);
    $this->setWidget('gmap', new sfWidgetFormGMap(array(
      'bind_latitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('latitude')),
      'bind_longitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('longitude'))
    )));
    $this->setValidator('gmap', new sfValidatorGMap());
  }
}
