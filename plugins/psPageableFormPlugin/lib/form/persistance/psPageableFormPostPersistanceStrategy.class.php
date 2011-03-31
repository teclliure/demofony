<?php

/**
 * Persistance strategy based on hidden inputs.
 * 
 * Hidden inputs should be display in that way:
 * [code]
 * <?php echo $form->getPersistanceStrategy()->renderHiddenInputs(); ?>
 * [/code]
 * 
 * You should manualy persist data in every request, for example in controller:
 * [code]
 * $form->persist();
 * [/code]
 *
 * This strategy is well for short form (2-3 pages)
 * 
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class psPageableFormPostPersistanceStrategy implements psPageableFormPersistanceStrategy
{
  private $form = null;
  
  public function persist(psPageableForm $pageableForm)
  {
    $this->form = $pageableForm;
  }

  public function renderHiddenInputs(psPageableForm $form = null)
  {
    $form = is_null($form) ? $this->form : $form;

    $output = '';

    foreach($form->getValues() as $name => $value)
    {
      $name = sprintf($form->getNameFormat(), $name);

      $output .= $this->buildHiddenInput($value, $name);
    }

    return $output;
  }

  private function buildHiddenInput($value, $name)
  {
    $output = '';
    
    if(is_array($value))
    {
      foreach($value as $k => $v)
      {
        $output .= $this->buildHiddenInput($v, $name.'['.$k.']');
      }
    }
    else
    {
      $widget = new sfWidgetFormInputHidden();
      $output .= $widget->render($name, $value, array('id' => 'hidden_'.$widget->generateId($name))).PHP_EOL;
    }
    
    return $output;
  }

  public function getValues()
  {
    return array();
  }

  public function clear()
  {
  }
}