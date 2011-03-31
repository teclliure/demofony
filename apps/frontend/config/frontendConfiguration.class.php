<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    sfWidgetFormSchema::setDefaultFormFormatterName('Div');
  }
}
