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
    $this->setWidget('latitude',new sfWidgetFormInputHidden());
    $this->setWidget('longitude',new sfWidgetFormInputHidden());
    $this->setWidget('gmap', new sfWidgetFormGMap(array(
      'bind_latitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('latitude')),
      'bind_longitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('longitude'))
    )));
    $this->setValidator('gmap', new sfValidatorGMap(array(
      'bind_latitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('latitude')),
      'bind_longitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('longitude')),
      'required'=>false
    )));
   $this->setValidator('latitude', new sfValidatorNumber(array( 'min' => -90, 'max' => 90, 'required' => false)));
   $this->setValidator('longitude', new sfValidatorNumber(array( 'min' => -180, 'max' => 180, 'required' => false)));
   $this->getObject()->configureJCropWidgets($this);
   $this->getObject()->configureJCropValidators($this);
  }
}
