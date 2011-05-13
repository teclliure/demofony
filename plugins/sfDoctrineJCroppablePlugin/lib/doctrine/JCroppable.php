<?php

class Doctrine_Template_JCroppable extends Doctrine_Template
{
  /**
  * Array of ageable options
  *
  * @var string
  */
  protected $_options = array();
  
  private $editableImages = array();
  private $originalImages = array();
  
  /**
  * __construct
  *
  * @param string $array
  * @return void
  */
  public function __construct(array $options = array())
  {
    $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
  }

  /**
   * Set table definition for JCroppable behavior
   *
   * @return void
   */
  public function setTableDefinition()
  {
    if (empty($this->_options['images']))
    {
      return false;
    }
    
    foreach ($this->_options['images'] as $fieldName) {
      $this->hasColumn($fieldName, 'string', 255, array('type' => 'string', 'length' => '255'));
      
      foreach (array('x1', 'y1', 'x2', 'y2') as $suffix) {
        $this->hasColumn($fieldName . '_' . $suffix, 'integer', null, array('type' => 'integer'));
      }
    }
    
    $this->addListener(new Doctrine_Template_Listener_JCroppable($this->_options));

    $this->createChildFormClass();
  }

  private function getTableNameCamelCase() {
    return preg_replace('/(?:^|_)(.?)/e',"strtoupper('$1')",
      $this->getInvoker()->getTable()->getTableName());
  }
  
  /**
   * Performs the following operations for a given image:
   *  1) removes any old files if the image has been re-uploaded
   *  2) creates a scaled down version for editing in the cropper if the image has been (re)uploaded
   *  3) creates the cropped versions of the image
   *
   * This method is called from the listener if the image has been edited in any way
   *
   * @param string $fieldName
   */
  public function updateImage($fieldName) {
//    die($fieldName);
    $oldValues = $this->getInvoker()->getModified(true);
    
    if (!empty($oldValues[$fieldName]) && $oldValues[$fieldName] != $this->getInvoker()->$fieldName) {
      $this->removeImages($fieldName, $oldValues[$fieldName]);
    }

    if (in_array($fieldName, array_keys($this->getInvoker()->getModified()))) {

      $this->createEditableImage($fieldName);
      
    }
    
    $this->createCrops($fieldName);
  }
  
  /**
   * Takes a form and configures each image's widget.
   *
   * This is one of only 2 methods the user needs to call manually (the other being configureJCropValidators)
   * Should be called from the form's configure() method
   *
   * @param sfForm $form
   */
  public function configureJCropWidgets(sfForm $form, $formOptions = array()) {
    
    foreach ($this->_options['images'] as $fieldName) {
      if (!$imageConfig = $this->getImageConfig($fieldName))
      {
        continue;
      }
      
      $form->setWidget($fieldName,
        new sfWidgetFormInputFileInputImageJCroppable(array(
          'invoker' => $this->getInvoker(),
          'image_field' => $fieldName,
          'image_ratio' => isset($imageConfig['ratio']) ? $imageConfig['ratio'] : false,
          'with_delete' => true,
          'file_src' => $this->getImageSrc($fieldName, 'editable'),
          'form' => $form,
          'preview' => isset($imageConfig['preview']) ? $imageConfig['preview'] : false,
          'image_config' => $imageConfig
          ))
      );
      
      foreach (array('x1', 'y1', 'x2', 'y2') as $suffix) {
        $form->setWidget($fieldName . '_' . $suffix, new sfWidgetFormInputHidden());
      }
    }
  }
  
  /**
   * Takes a form and configures each image's widget.
   *
   * This is one of only 2 methods the user needs to call manually (the other being configureJCropWidgets)
   * Should be called from the form's configure() method
   *
   * @param sfForm $form
   */
  public function configureJCropValidators($form) {
    
    foreach ($this->_options['images'] as $fieldName) {
      
      $form->setValidator($fieldName . '_delete',  new sfValidatorPass());
      
      $form->setValidator($fieldName,
        new sfValidatorFile(array(
            'required'   => false,
            'path'       => $this->getImageDir(),
            'mime_types' => 'web_images',
          ),
          array('mime_types' => 'Unsupported image type (%mime_type%)')
        )
      );
      
      foreach (array('x1', 'y1', 'x2', 'y2') as $suffix) {
        $form->setValidator($fieldName . '_' . $suffix, new sfValidatorPass());
      }
    }
  }
  
  /**
   * Get the directory to store the images in by looking in the following places:
   *
   *  1) table specific config
   *  2) global plugin config
   *  3) default location
   *
   * @return string
   */
  private function getImageDir() {
    $basePath = sfConfig::get('sf_upload_dir');

    if ($this->getModelConfig('directory')) {
      $relativePath = $this->getModelConfig('directory');
    } else {
      $relativePath = $this->getImageDirDefault();
    }
    
    return $basePath . DIRECTORY_SEPARATOR . $relativePath;
  }
  
  /**
   * Generate's the default directory to store the model's images in (relative to uploads/)
   *
   * @return string
   */
  private function getImageDirDefault() {
    return 'images' . DIRECTORY_SEPARATOR . $this->getTableNameCamelCase();
  }
  
  /**
   * Gets the model's image directory relative to the web root (sf_web_dir)
   *
   * @return string
   */
  public function getImageDirWeb() {
  	$webDir = str_replace('\\', '/', sfConfig::get('sf_web_dir'));
	  $imageDir = str_replace('\\', '/', $this->getImageDir());
	
    return (string)str_replace($webDir . '/', '', $imageDir);
  }
  
  /**
   * Gets the given field's absolute editable image path, and warns if the directory
   *  doesn't exist or is not writable
   *
   * @param string $fieldName
   * @return string
   */
  public function getImageSrc($fieldName, $size = 'thumb') {
    $fileDir = $this->getImageDirWeb();
    
    if (!file_exists($fileDir)) {
      print("image upload directory <strong>$fileDir</strong> doesn't exist");
    }
    if (!is_writable($fileDir)) {
      print("image upload directory <strong>$fileDir</strong> is not writable");
    }
    
    $relative_url = sfContext::getInstance()->getRequest()->getRelativeUrlRoot();
    $fileSrc = $relative_url . '/' . $fileDir . '/' . $this->getImageFromName($fieldName, $size);
    
    return $fileSrc;
  }

  /**
   * Returns an img tag for the specified image field & size (default thumb)
   *
   * @param string $fieldName
   * @param string $size
   * @param array $attributes
   * @return string
   */
  public function getImageTag($fieldName, $size = 'thumb', $attributes = array())
  {
    return tag(
      'img',
      array_merge(
        $attributes,
        array('src' => $this->getImageSrc($fieldName, $size))
      )
    );
  }
  
  /**
   * Takes the original image, adds and padding to it and creates an editable version
   *  for use in the cropper
   *
   * @param string $fieldName
   */
  private function createEditableImage($fieldName) {
    $imageConfig = $this->getImageConfig($fieldName);
    /**
     * Get the filenames for the editoable and original versions of the image
     */
    $original = $this->getImageFromName($fieldName, 'original');
    $editable = $this->getImageFromName($fieldName, 'editable');

    if (empty($original) || empty($editable))
    {
      return false;
    }
    
    $dir = $this->getImageDir();
    
    /**
     * Move the new image to be named as the original
     */
    rename($dir . DIRECTORY_SEPARATOR . $editable, $dir . DIRECTORY_SEPARATOR . $original);
    //print("mv $editable $original<br/>");exit;
    /**
     * Load the original and resize it for the editable version
     */
    $img = new sfImage($dir . DIRECTORY_SEPARATOR . $original);
    
    if (isset($imageConfig['padding'])) {
      $img = $this->addPadding($img, $imageConfig['padding']);
      
      $img->saveAs($dir . DIRECTORY_SEPARATOR . $original);
    }
    
    $img->resize(250, null,true, true);
    
    $img->saveAs($dir . DIRECTORY_SEPARATOR . $editable);
    
    $this->getInvoker()->{$fieldName . '_x1'} = 0;
    $this->getInvoker()->{$fieldName . '_y1'} = 0;
    $this->getInvoker()->{$fieldName . '_x2'} = $img->getWidth();
    $this->getInvoker()->{$fieldName . '_y2'} = $img->getHeight();
  }
  
  /**
   * Adds any padding to the given image using the supplied padding config
   *
   * @param $img
   * @param array $padding
   * @return $img
   */
  private function addPadding($img, $padding) {
    if (!$padding) {
      return $img;
    }
    
    if (isset($padding['percent']) && is_numeric($padding['percent'])) {
      
      $width = $img->getWidth() * (1 + ($padding['percent'] / 100));
      $height = $img->getHeight() * (1 + ($padding['percent'] / 100));
      
    } else if (isset($padding['pixels']) && is_numeric($padding['pixels'])) {
      
      $width = $img->getWidth() + $padding['pixels'];
      $height = $img->getHeight() + $padding['pixels'];
      
    } else {
      
      return $img;
      
    }
    
    $canvas = new sfImage();
    $canvas
      ->fill(0, 0, isset($padding['color']) ? $padding['color'] : '#ffffff')
      ->resize($width, $height,true, true)
      ->overlay($img, 'center');
    
    return $canvas;
  }
  
  /**
   * Gets the filename for the given image field and size. Uses the current field value,
   *  but can be overriden by passing a different value as the 3rd parameter
   *
   * @param $fieldName
   * @param $size
   * @param $editable
   * @return $image
   */
  private function getImageFromName($fieldName, $size = 'editable', $editable = null) {
    if (!$imageConfig = $this->getImageConfig($fieldName)) {
      return false;
    }
    
    if ($editable == null) {
      $editable = $this->getInvoker()->$fieldName;
    }
    
    if ($size == 'editable' || (!isset($imageConfig['sizes'][$size]) && $size != 'original')) {
      return $editable;
    }
    
    $extensionPosition = strrpos($editable, '.');
    $stub = substr($editable, 0, $extensionPosition);
    
    $image = str_replace($stub, $stub . '_' . $size, $editable);
    
    return $image;
  }
  
  /**
   * Creates the cropped version of the given field's images
   *
   * @param string $fieldName
   * @return bool
   */
  private function createCrops($fieldName) {
    if (!$imageConfig = $this->getImageConfig($fieldName)) {
      return false;
    }
    
    $this->loadImage($fieldName, 'editable');
    $this->loadImage($fieldName, 'original');
    
    foreach ($imageConfig['sizes'] as $size => $dims) {
      $this->createCropForSize($fieldName, $size);
    }
    
    return true;
  }
  
  /**
   * Loads either the editable or original version of the given image field
   *
   * @param string $fieldName
   * @param string $version - editable or original
   * @param $force - try to load the image even if there's no config for image
   */
  private function loadImage($fieldName, $version, $force = false) {
    $imageConfig = $this->getImageConfig($fieldName);
    
    if (!$this->getInvoker()->$fieldName || (!$imageConfig && !$force)) {
      return;
    }
    
    $this->{$version . 'Images'}[$fieldName] =
      new sfImage($this->getImageDir() . DIRECTORY_SEPARATOR . $this->getImageFromName($fieldName, $version));
  }
  
  /**
   * Creates the crop of the given field's image at the specified size
   *
   * @param $fieldName
   * @param $size
   */
  private function createCropForSize($fieldName, $size) {
    if (!$imageConfig = $this->getImageConfig($fieldName)) {
      return false;
    }
    
    $this->loadImage($fieldName, 'original');
    $this->loadImage($fieldName, 'editable');

    if (empty($this->originalImages[$fieldName]) || empty($this->editableImages[$fieldName]))
    {
      return false;
    }
    
    $ratio = $this->originalImages[$fieldName]->getWidth() /
      $this->editableImages[$fieldName]->getWidth();
    
    $dims['x'] = (int)$this->getInvoker()->{$fieldName . '_x1'} * $ratio;
    $dims['y'] = (int)$this->getInvoker()->{$fieldName . '_y1'} * $ratio;
    $dims['w'] = (int)($this->getInvoker()->{$fieldName . '_x2'} * $ratio) - $dims['x'];
    $dims['h'] = (int)($this->getInvoker()->{$fieldName . '_y2'} * $ratio) - $dims['y'];
    
    $origCrop = $this->originalImages[$fieldName]
      ->crop($dims['x'], $dims['y'], $dims['w'], $dims['h']);
      
    $finalCrop = $origCrop->resize(
      $imageConfig['sizes'][$size]['width'],
      empty($imageConfig['ratio']) ?
        null :
        $imageConfig['sizes'][$size]['width'] / $imageConfig['ratio'],true, true);
    
    $fullPath = $this->getImageDir() . DIRECTORY_SEPARATOR . $this->getImageFromName($fieldName, $size);
    
    $finalCrop->saveAs($fullPath);
  }
  
  /**
   * Removes all existing images for the given field, and the field's value
   *  can be overridden using the second parameter
   *
   * @param $fieldName
   * @param $editable
   */
  private function removeImages($fieldName, $editable) {
    if (!$imageConfig = $this->getImageConfig($fieldName)) {
      return;
    }
    
    /**
     * Remove the editable & original images
     */
    foreach (array('editable', 'original') as $type) {
      $fullPath = $this->getImageDir() . DIRECTORY_SEPARATOR
        . $this->getImageFromName($fieldName, $type, $editable);
      
      if (file_exists($fullPath)) {
        unlink($fullPath);
      }
    }
    
    /**
     * Loop through the sizes and remove them
     */
    foreach ($imageConfig['sizes'] as $size => $dims) {
      
      $filename = $this->getImageFromName($fieldName, $size, $editable);
      
      $fullPath = $this->getImageDir() . DIRECTORY_SEPARATOR . $filename;
      
      if (file_exists($fullPath)) {
        unlink($fullPath);
      }
      
    }
  }
  
  /**
   * Get's the config for the given field's image
   *
   * @param $fieldName
   * @return array
   */
  private function getImageConfig($fieldName) {
    $config = sfConfig::get('app_sfDoctrineJCroppablePlugin_models');

    $images = $this->getModelConfig('images',array());
    
    if (!isset($images[$fieldName])) {
      return array('sizes' => array(
        'thumb' => array('width' => 120),
        'main' => array('width' => 360)
      ));
    }
    
    return $images[$fieldName];
  }
  
  /**
   * Get's the table name of the invoking model
   *
   * @return string
   */
  private function getTableName() {
    return $this->getInvoker()->getTable()->getTableName();
  }

  private function createChildFormClass()
  {
    $tableName = $this->getTableNameCamelCase();

    $baseForm = $tableName . 'Form';
    $extendedForm = 'JCroppable' . $baseForm;
    
    if (!class_exists($tableName . 'Form') || class_exists($extendedForm))
    {
      return false;
    }

    $class = '
class ' . $extendedForm . ' extends ' . $baseForm . '
{

  public function configure()
  {
    $this->getObject()->configureJCropWidgets($this, $this->options);
    $this->getObject()->configureJCropValidators($this);

    parent::configure();
  }
}';
    
    eval($class);
  }
  
  private function getModelConfig($option, $default_value = null) {
    $config = sfConfig::get('app_sfDoctrineJCroppablePlugin_models');
    $tableName = $this->getTableNameCamelCase();
    $found = false;

    while (!$found) {
      if (!empty($config[$tableName][$option])) {
        $option_value = $config[$tableName][$option];
        $found = true;
      }
      else {
        if ($tableName == 'sfDoctrineRecord') {
          break;
        }
        $tableName = get_parent_class($tableName);
      }
    }
    if ($found) {
      return $option_value;
    }
    else {
      return $default_value;
    }
  }
}
