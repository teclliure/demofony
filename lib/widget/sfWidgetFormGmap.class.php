<?php
class sfWidgetFormGMap extends sfWidgetForm
{
  public function configure($options = array(), $attributes = array())
  {
    $this->addOption('bind_latitude', false);
    $this->addOption('bind_longitude', false);
    $this->addOption('address.options', array('style' => 'width:200px'));
 
    $this->setOption('default', array(
      'address' => '',
      'longitude' => '2.294359',
      'latitude' => '48.858205'
    ));
 
    $this->addOption('div.class', 'sf-gmap-widget');
    $this->addOption('map.height', '300px');
    $this->addOption('map.width', '500px');
    $this->addOption('map.style', "");
    sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
    $this->addOption('lookup.name', __("Lookup"));
 
    $this->addOption('template.html', '
      <div id="{div.id}" class="{div.class}">
        {input.search} <input type="submit" value="{input.lookup.name}"  id="{input.lookup.id}" /> <br />
        {input.longitude}
        {input.latitude}
        <div id="{map.id}" style="width:{map.width};height:{map.height};{map.style}"></div>
      </div>
    ');
 
     $this->addOption('template.javascript', '
      <script type="text/javascript">
        jQuery(window).bind("load", function() {
          new sfGmapWidgetWidget({
            longitude: "{input.longitude.id}",
            latitude: "{input.latitude.id}",
            address: "{input.address.id}",
            lookup: "{input.lookup.id}",
            map: "{map.id}",
            required: {required}
          });
        })
      </script>
    ');
  }
 
  public function getJavascripts()
  {
    return array(
      '/js/sf_widget_gmap_address.js',
      'http://maps.google.com/maps/api/js?sensor=false'
    );
  }
 
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    // define main template variables
    $template_vars = array(
      '{div.id}'             => $this->generateId($name),
      '{div.class}'          => $this->getOption('div.class'),
      '{map.id}'             => $this->generateId($name.'[map]'),
      '{map.style}'          => $this->getOption('map.style'),
      '{map.height}'         => $this->getOption('map.height'),
      '{map.width}'          => $this->getOption('map.width'),
      '{input.lookup.id}'    => $this->generateId($name.'[lookup]'),
      '{input.lookup.name}'  => $this->getOption('lookup.name'),
      '{input.address.id}'   => $this->generateId($name.'[address]'),
      
    );
    
    if ($this->getOption('bind_latitude')) {
      $template_vars['{input.latitude.id}'] = $this->getOption('bind_latitude');
    }
    else {
      $template_vars['{input.latitude.id}'] = $this->generateId($name.'[latitude]');
    }
    
    if ($this->getOption('bind_longitude')) {
      $template_vars['{input.longitude.id}'] = $this->getOption('bind_longitude');
    }
    else {
      $template_vars['{input.longitude.id}'] = $this->generateId($name.'[longitude]');
    }
    
    if ($this->getOption('required')) {
      $template_vars['{required}'] = 'true';
    }
    else {
      $template_vars['{required}'] = 'false';
    }
 
    // avoid any notice errors to invalid $value format
    $value = !is_array($value) ? array() : $value;
    $value['address']   = isset($value['address'])   ? $value['address'] : '';
    $value['longitude'] = isset($value['longitude']) ? $value['longitude'] : '';
    $value['latitude']  = isset($value['latitude'])  ? $value['latitude'] : '';
 
    // define the address widget
    $address = new sfWidgetFormInputText(array(), $this->getOption('address.options'));
    $template_vars['{input.search}'] = $address->render($name.'[address]', $value['address']);
 
    // define the longitude and latitude fields
    $hidden = new sfWidgetFormInputHidden;
    if (!$this->getOption('bind_longitude')) {
      $template_vars['{input.longitude}'] = $hidden->render($name.'[longitude]', $value['longitude']);
    }
    else {
      $template_vars['{input.longitude}'] = '';
    }
    if (!$this->getOption('bind_latitude')) {
      $template_vars['{input.latitude}'] = $hidden->render($name.'[latitude]', $value['latitude']);
    }
    else {
      $template_vars['{input.latitude}'] = '';
    }
    
 
    // merge templates and variables
    return strtr(
      $this->getOption('template.html').$this->getOption('template.javascript'),
      $template_vars
    );
  }
}