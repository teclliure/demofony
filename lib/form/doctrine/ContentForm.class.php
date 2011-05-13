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
    unset($this['created_at'],$this['updated_at'],$this['slug'],$this['views']);
    $this->setWidget('latitude',new sfWidgetFormInputHidden());
    $this->setWidget('longitude',new sfWidgetFormInputHidden());
    $this->setWidget('gmap', new sfWidgetFormGMap(array(
      'bind_latitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('latitude')),
      'bind_longitude'=>$this->widgetSchema->generateId($this->widgetSchema->generateName('longitude')),
      'map.width'=>'200px'
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
   
    $this->setWidget('categories', new sfWidgetFormDoctrineChoice(array('multiple' => true, 'expanded'=>true, 'model' => 'Category')));
    $this->setWidget('regions', new sfWidgetFormDoctrineChoice(array('multiple' => true,'expanded'=>true, 'model' => 'Region')));
    $this->setValidator('categories', new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)));
    $this->setValidator('regions', new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Region', 'required' => false)));
    
    $this->widgetSchema->setHelp('video','You can include a URL from a YouTUbe video');
    $this->widgetSchema->setHelp('gmap','You can click on map or search a location to geolocate the content');
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['categories']))
    {
      $this->setDefault('categories', $this->object->getCategories()->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['regions']))
    {
      $this->setDefault('regions', $this->object->getRegions()->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);
    
    $this->saveCategories($con);
    $this->saveRegions($con);
  }
  
  public function saveRegions($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['regions']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->getRegions()->getPrimaryKeys();
    $values = $this->getValue('regions');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $query = Doctrine::getTable('ContentHasRegion')->createQuery('cr')->where('cr.type = ?',get_class($this->object))->andWhere('cr.content_id = ?',$this->object->getId());
      $query->andWhereIn('cr.region_id',array_values($unlink));
      $query->delete();
      $query->execute();
      // $this->object->unlink('Regions', );
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      foreach (array_values($link) as $region_id) {
        $cr = new ContentHasRegion();
        $cr->setRegionId($region_id);
        $cr->setContentId($this->object->getId());
        $cr->setType(get_class($this->object));
        $cr->save();
      }
    }
  }
  
  public function saveCategories($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['categories']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->getCategories()->getPrimaryKeys();
    $values = $this->getValue('categories');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $query = Doctrine::getTable('ContentHasCategory')->createQuery('cc')->where('cc.type = ?',get_class($this->object))->andWhere('cc.content_id = ?',$this->object->getId());
      $query->andWhereIn('cc.category_id',array_values($unlink));
      $query->delete();
      $query->execute();
      // $this->object->unlink('Regions', );
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      foreach (array_values($link) as $category_id) {
        $cr = new ContentHasCategory();
        $cr->setCategoryId($category_id);
        $cr->setContentId($this->object->getId());
        $cr->setType(get_class($this->object));
        $cr->save();
      }
    }
  }
}
