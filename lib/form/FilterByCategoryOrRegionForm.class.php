<?php
class FilterByCategoryOrRegionForm extends sfForm {
  public function configure () {
    $this->setWidget('categories', new sfWidgetFormDoctrineChoice(array('model' => 'Category','add_empty'=>'By category:')));
    $this->setWidget('regions', new sfWidgetFormDoctrineChoice(array('model' => 'Region','add_empty'=>'By neighborhood:')));
    $this->setValidator('categories', new sfValidatorDoctrineChoice(array('model' => 'Category', 'required' => false)));
    $this->setValidator('regions', new sfValidatorDoctrineChoice(array('model' => 'Region', 'required' => false)));
  }
}