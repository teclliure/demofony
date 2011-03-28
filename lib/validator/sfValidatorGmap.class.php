<?php
class sfValidatorGMap extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addOption('bind_latitude');
    $this->addOption('bind_longitude');
    $this->addOption('send_address');
  }
  
  protected function doClean($value)
  {
    if (!is_array($value))
    {
      throw new sfValidatorError($this, 'invalid');
    }
 
    try
    {
      if (!$this->getOption('bind_latitude')) {
        $latitude = new sfValidatorNumber(array( 'min' => -90, 'max' => 90, 'required' => $this->getOption('required')));
        $value['latitude'] = $latitude->clean(isset($value['latitude']) ? $value['latitude'] : null);
      }
 
      if (!$this->getOption('bind_longitude')) {
        $longitude = new sfValidatorNumber(array( 'min' => -180, 'max' => 180, 'required' => $this->getOption('required') ));
        $value['longitude'] = $longitude->clean(isset($value['longitude']) ? $value['longitude'] : null);
      }
      
      if (!$this->getOption('send_address')) {
        $address = new sfValidatorString(array( 'min_length' => 10, 'max_length' => 255, 'required' =>  $this->getOption('required')));
        $value['address'] = $address->clean(isset($value['address']) ? $value['address'] : null);
      }
      else {
        unset ($value['address']);
      }
    }
    catch(sfValidatorError $e)
    {
      throw new sfValidatorError($this, 'invalid');
    }
 
    return $value;
  }
}