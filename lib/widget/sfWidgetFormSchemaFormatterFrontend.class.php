<?php
class sfWidgetFormSchemaFormatterFrontend extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "%error%\n<label>\n%label% %field% %help%</label>\n
                         %hidden_fields%\n\n",
    $errorRowFormat  = "<div class=\"field_error\">%errors%</div>",
    $helpFormat      = '<small>%help%</small>',
    $errorListFormatInARow     = "  <div class=\"msg div_error_list error\">\n%errors%</div>\n",
    $errorRowFormatInARow      = "    - %error%\n",
    $requiredTemplate= '&nbsp;<pow class="requiredFormItem">*</pow>',
    $namedErrorRowFormatInARow = "    - %name%: %error%<br />\n",
    $decoratorFormat = "\n  %content%",
    $validatorSchema = null;
 
  /*public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    $row = parent::formatRow(
      $label,
      $field,
      $errors,
      $help,
      $hiddenFields
    );
 
    return strtr($row, array(
      '%row_class%' => (count($errors) > 0) ? ' form_row_error' : '',
    ));
  }*/
  /**
   * Constructor
   *
   * @param sfWidgetFormSchema $widgetSchema
   */
  public function __construct(sfWidgetFormSchema $widgetSchema, sfValidatorSchema $validatorSchema)
  {
    $this->setWidgetSchema($widgetSchema);
    $this->setValidatorSchema($validatorSchema);
  }
    
   /**
   * Generates a label for the given field name.
   *
   * @param  string $name        The field name
   * @param  array  $attributes  Optional html attributes for the label tag
   *
   * @return string The label tag
   */
  public function generateLabel($name, $attributes = array())
  {
    $labelName = $this->generateLabelName($name);
    return $this->widgetSchema->renderContentTag('span', $labelName, $attributes);
  }

  /**
   * Generates the label name for the given field name.
   *
   * @param  string $name  The field name
   * @return string The label name
   */
  public function generateLabelName($name)
  {
    $label = parent::generateLabelName($name);

    $fields = $this->validatorSchema->getFields();
    if(isset($fields[$name]) && $fields[$name] != null) {
      $field = $fields[$name];
      if($field->hasOption('required') && $field->getOption('required')) {
        $label .= $this->requiredTemplate;
      }
    }
    return $label;
  }

  public function setValidatorSchema(sfValidatorSchema $validatorSchema)
  {
    $this->validatorSchema = $validatorSchema;
  }
}