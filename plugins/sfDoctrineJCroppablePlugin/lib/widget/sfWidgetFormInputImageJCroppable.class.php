<?php

/**
 * sfWidgetFormInputFileInputImageJCroppable represents an upload HTML input tag which will
 * also display the uploaded image with the JCrop functionality.
 *
 * @author     Rich Birch <rich@trafficdigital.com>
 */
class sfWidgetFormInputFileInputImageJCroppable extends sfWidgetFormInputFile
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * file_src:     The current image web source path (required)
   *  * with_delete:  Whether to add a delete checkbox or not
   *  * delete_label: The delete label used by the template
   *  * image_field:
   *  * image_ratio:
   *  * invoker:
   *  * template:     The HTML template to use to render this widget
   *                  The available placeholders are:
   *                    * input (the image upload widget)
   *                    * delete (the delete checkbox)
   *                    * delete_label (the delete label text)
   *                    * file (the file tag)
   *  * form:
   *
   * In edit mode, this widget renders an additional widget named after the
   * file upload widget with a "_delete" suffix. So, when creating a form,
   * don't forget to add a validator for this additional field.
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetFormInputFile
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->setOption('type', 'file');
    $this->setOption('needs_multipart', true);
    
    $this->addRequiredOption('file_src');
    $this->addRequiredOption('image_config');
    $this->addOption('with_delete', true);
    $this->addOption('delete_label', 'remove the current file');
    $this->addOption('image_field', null);
    $this->addOption('image_ratio', null);
    $this->addOption('invoker', null);
    $this->addOption('template', '<table><tr><td>%file%</td><td>%preview%</td></tr></table>%input%<br />%delete% %delete_label%');
    $this->addOption('form', null);
    $this->addOption('preview', null);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $input = parent::render($name, $value, $attributes, $errors);
    
    $object = $this->getOption('invoker');
    
    if (!$object->exists())
    {
      return $input;
    }

    if (class_exists('sfJSLibManager'))
    {
      sfJSLibManager::addLib('jcrop');
    }

    if ($this->getOption('with_delete') && $value)
    {
      $deleteName = ']' == substr($name, -1) ? substr($name, 0, -1).'_delete]' : $name.'_delete';
      $form = $this->getOption('form');

      if ($form->getOption('embedded', false) && $form->getOption('parent_model', false))
      {
        $delete = $form->getOption('parent_model')->getDeleteLinkFor($object);
        $deleteLabel = '';
      }
      else
      {
        $delete = $this->renderTag('input', array_merge(array('type' => 'checkbox', 'name' => $deleteName), $attributes));
        $deleteLabel = $this->renderContentTag('label', $this->getOption('delete_label'), array_merge(array('for' => $this->generateId($deleteName))));
      }
    }
    else
    {
      $delete = '';
      $deleteLabel = '';
    }
    
    
    $image_config = $this->getOption('image_config');
    if ($this->getOption('preview')) {
      $image_config_size_width = $image_config['sizes'][$this->getOption('preview')]['width'];
      $image_config_size_height = $image_config_size_width*$image_config['ratio'];
      $preview = '
      <div style="width: '.$image_config_size_width.'px; height: '.$image_config_size_height.'px; overflow: hidden; float: left; margin-left: 5px;">
      <img id="'.$this->getIdStub().'_img_preview" src="'.$this->getOption('file_src').'" >
      </div>
      ';
    }
    else {
      $preview = '';
    }

    return strtr($this->getOption('template') . $this->getJCropJS($image_config), array('%input%' => $input, '%delete%' => $delete, '%delete_label%' => $deleteLabel, '%file%' => $this->getFileAsTag($attributes), '%preview%' => $preview));
  }

  protected function getFileAsTag($attributes)
  {
    $id = $this->getIdStub() . '_img';
    
    return false !== $this->getOption('file_src')
      ?
        $this->renderTag(
          'img',
          array_merge(
            array(
              'src' => $this->getOption('file_src'),
              'id' => $id
            ),
            $attributes
          )
        )
      :
        '';
    
  }
  
  private function getJCropJS($image_config) {
    $idStub = $this->getIdStub();
    $ratio = $this->getOption('image_ratio') ? 'aspectRatio: ' . $this->getOption('image_ratio') . ',' : '';
    if ($this->getOption('preview')) {
      $image_config_size_width = $image_config['sizes'][$this->getOption('preview')]['width'];
      $image_config_size_height = $image_config_size_width*$image_config['ratio'];
      $preview = "
      if (parseInt(c.w) > 0) {
        var rx = {$image_config_size_width} / c.w;
        var ry = {$image_config_size_height} / c.h;
        var img_width = $('#".$this->getIdStub()."_img').width();
        var img_height = $('#".$this->getIdStub()."_img').height();
  
        $('#".$this->getIdStub()."_img_preview').css({
          width: Math.round(rx * img_width) + 'px',
          height: Math.round(ry * img_height) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
      ";
    }
    else {
      $preview = '';
    }
    
    $js = "
<script language=\"Javascript\">
  jQuery(document).ready(function(){

    jQuery('#{$idStub}_img').Jcrop({
      $ratio
      setSelect: [$('#{$idStub}_x1').val(),
                  $('#{$idStub}_y1').val(),
                  $('#{$idStub}_x2').val(),
                  $('#{$idStub}_y2').val()
                  ],
      onChange: _jCropUpdateCoords" . ucfirst($idStub) . ",
      onSelect: _jCropUpdateCoords" . ucfirst($idStub) . "
    });

  });
  
  function _jCropUpdateCoords" . ucfirst($idStub) . "(c) {
    $('#{$idStub}_x1').val(c.x);
    $('#{$idStub}_y1').val(c.y);
    $('#{$idStub}_x2').val(c.x2);
    $('#{$idStub}_y2').val(c.y2);
    {$preview}
  }
</script>
  ";
    
    return $js;
  }

  private function getIdStub() {
    $form = $this->getOption('form');
    $separator = '';

    $imageName = $this->getOption('image_field');
    $tableName = str_replace("[%s]", '', $form->getWidgetSchema()->getNameFormat());

    if ($form->getOption('embedded'))
    {
      $parentTableName = $form->getOption('parent_model')->getTable()->getTableName();
      
      $separator = 'embedded_' . $tableName . '_' . $tableName .
        '_' . $this->getOption('invoker')->getId();

      $idStub = $parentTableName . '_' . $separator . '_' . $imageName;
    }
    else
    {
      $idStub = $tableName . '_' . $imageName;
    }

    return $idStub;
  }
}
