<?php

class backendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    $this->dispatcher->connect('routing.load_configuration', array('vjCommentRouting', 'addRouteForAdminComments'));
    $this->dispatcher->connect('routing.load_configuration', array('vjCommentRouting', 'addRouteForAdminReportedComments'));
  }
}
