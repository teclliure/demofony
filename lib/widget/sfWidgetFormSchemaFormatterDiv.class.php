<?php
class sfWidgetFormSchemaFormatterDiv extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<div class=\"ctrlHolder form_row%row_class%\">
                        %error% \n%label% <div class=\"form_input\">%field%</div> <div class=\"form_help\">%help%</div>\n
                         %hidden_fields%\n</div>\n",
    $errorRowFormat  = "<div>%errors%</div>",
    $helpFormat      = '%help%',
    $errorListFormatInARow     = "  <div class=\"div_error_list error\">\n%errors%</div>\n",
    $errorRowFormatInARow      = "    - %error%\n",
    $namedErrorRowFormatInARow = "    - %name%: %error%<br />\n",
    $decoratorFormat = "<div>\n  %content%</div>";
 
  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
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
  }
}