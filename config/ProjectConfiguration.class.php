<?php

require_once '/home/marc/workspace/symfony-1.4/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfOrmBreadcrumbsPlugin');
    $this->enablePlugins('ioMenuPlugin');
  }
}
