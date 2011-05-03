<?php
class sfWidgetFormSchemaFormatterFrontend extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "%error%\n<label>\n%label% %field% %help%</label>\n
                         %hidden_fields%\n\n",
    $errorRowFormat  = "<div class=\"field_error\">%errors%</div>",
    $helpFormat      = '<small>%help%</small>',
    $errorListFormatInARow     = "  <div class=\"div_error_list error\">\n%errors%</div>\n",
    $errorRowFormatInARow      = "    - %error%\n",
    $namedErrorRowFormatInARow = "    - %name%: %error%<br />\n",
    $decoratorFormat = "\n  %content%";
 
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
    $labelName = strtoupper($labelName).':';
    return $this->widgetSchema->renderContentTag('span', $labelName, $attributes);
  }
  
}