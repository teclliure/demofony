<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    demofony
 * @subpackage form
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm
{
  protected $genders = array (0=>'Male',1=>'Female');
  protected $country_list = array(
    "Afghanistan",
    "Albania",
    "Algeria",
    "Andorra",
    "Angola",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegovina",
    "Botswana",
    "Brazil",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cape Verde",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Colombi",
    "Comoros",
    "Congo (Brazzaville)",
    "Congo",
    "Costa Rica",
    "Cote d'Ivoire",
    "Croatia",
    "Cuba",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "East Timor (Timor Timur)",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Fiji",
    "Finland",
    "France",
    "Gabon",
    "Gambia, The",
    "Georgia",
    "Germany",
    "Ghana",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macedonia",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepa",
    "Netherlands",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Vincent",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia and Montenegro",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Vatican City",
    "Venezuela",
    "Vietnam",
    "Yemen",
    "Zambia",
    "Zimbabwe"
  );
  
  
  public function configure()
  {
    unset ($this['created_at'],$this['updated_at']);
    
    // Set lat/long widget
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
    
    // Set Jcrop widgets
    $this->getObject()->configureJCropWidgets($this);
    $this->getObject()->configureJCropValidators($this);
    
    // Configure some widgets
    $this->setWidget('gender',new sfWidgetFormChoice(array('expanded' => true,'choices'=>$this->genders)));
    $this->setWidget('postal_code',new sfWidgetFormInputText(array(),array('size'=>5)));
    $this->setWidget('telephone',new sfWidgetFormInputText(array(),array('size'=>12)));
    $this->setWidget('country',new sfWidgetFormChoice(array('choices'=>$this->country_list)));
    $this->getWidgetSchema()->setDefault('country',160);
    $this->setWidget('born_date', new sfWidgetFormJQueryDate(array(
      'image'=>sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/calendar.png',
      'config' => '{}',
    )));
    $this->setWidget('categories_list', new sfWidgetFormDoctrineChoice(array('multiple' => true, 'expanded'=>true, 'model' => 'Category')));
    $this->setWidget('regions_list', new sfWidgetFormDoctrineChoice(array('multiple' => true,'expanded'=>true, 'model' => 'Region')));
  }
}
