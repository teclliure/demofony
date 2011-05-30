<?php

/**
 * PluginOpinionPossibility form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PluginOpinionPossibilityForm extends BaseOpinionPossibilityForm
{
  public function setup() {
    parent::setup();
    unset($this['opinion_possibility_group_id'],$this['icon']);
    $cultures = sfConfig::get('app_cultures_enabled');
    $this->embedI18n(array_keys($cultures));
    foreach($cultures as $key=>$culture) {
      $this->widgetSchema->setLabel($key, $culture);
    }
    
    /*$this->widgetSchema['opionion_possibility_group_id'] = new sfWidgetFormJQueryAdminHijackDoctrineChoice(array(
      'model' => $this->getRelatedModelName('OpinionPossibilityGroup'),
      'module' => 'opinion_possibility_group',
      'fields' => array('name','show_stats')
     ));*/
   
    $images = sfFinder::type('file')->name('*.png')->relative()->maxdepth(0)->in(sfConfig::get('sf_web_dir').'/images/gmap_icons/');
    $choices = array();
    foreach ($images as $image) {
      $choices[$image] = $image;
    }
    $this->widgetSchema['gmap_bubble_image'] = new sfWidgetFormSelectRadio(array(
                    'choices' => $choices,
                    'formatter' => array($this, 'showAsImages'),
    ));
    
    $this->widgetSchema->moveField('gmap_bubble_image', sfWidgetFormSchema::LAST);
    $this->getWidgetSchema()->setHelp('gmap_bubble_image','Image to show on map. If you want to choose a new image you should previously upload image to web/images/gmap_icons/ in png format.');
    
    $decorator = new sfWidgetFormSchemaFormatterDiv($this->widgetSchema, $this->validatorSchema);
    $this->widgetSchema->addFormFormatter('custom', $decorator);
    $this->widgetSchema->setFormFormatterName('custom');
  }
  
  public function showAsImages($widget, $inputs)
  {
    $rows = array();
    foreach ($inputs as $image)
    {
      //var_dump($image);
      $domdoc = new DOMDocument();
      $domdoc->loadHTML($image['input']);
      $node = $domdoc->getElementsByTagName('input')->item(0);
      foreach ($node->attributes as $name => $attrNode) {
        if ($name == 'value') {
          $imageName = $attrNode->value;
        }
      }
      // var_dump($node->attributes);
      $label = '<img src="'.sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/gmap_icons/'.$imageName.'" alt="image" />';
      
      // $rows[] = $widget->renderContentTag('li',$image['input'].' &nbsp;'.$label.$widget->getOption('label_separator').$image['label']);
      $rows[] = $widget->renderContentTag('li',$image['input'].' &nbsp;'.$label);
    }
    return $widget->renderContentTag('ul',
                         implode($widget->getOption('separator'), $rows),
                         array('class' => $widget->getOption('class')));
  }
  
}
