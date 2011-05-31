<?php

/**
 * PluginOpinionPossibilityGroup form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PluginOpinionPossibilityGroupForm extends BaseOpinionPossibilityGroupForm
{
   public function setup() {
     parent::setup();
     unset($this['slug'],$this['can_text_be_added']);
    
     $cultures = sfConfig::get('app_cultures_enabled');
     $emptyFields = array();
     foreach($cultures as $key=>$culture) {
       $emptyFields[] = array($key=>'name');
     }
     $this->embedRelations(array(
       'OpinionPossibility' => array(
         'considerNewFormEmptyFields' => $emptyFields,
         'newFormAfterExistingRelations' => true,
         'multipleNewForms'=>true,
         'newFormsInitialCount'=>1,
         'formFormatter' => 'Div',
         'newRelationButtonLabel'        => '+',
         'newRelationAddByCloning'       => true,
         'newRelationUseJSFramework'     => 'jQuery',
       )
     ));
    
     $this->getWidgetSchema()->setHelp('show_stats','Must stats graphs be shown under opinions');
     $decorator = new sfWidgetFormSchemaFormatterDiv($this->widgetSchema, $this->validatorSchema);
     $this->widgetSchema->addFormFormatter('custom', $decorator);
     $this->widgetSchema->setFormFormatterName('custom');
   }
}
