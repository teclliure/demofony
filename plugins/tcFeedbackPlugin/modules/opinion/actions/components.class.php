<?php

/**
 * opinion components.
 *
 * @package    demofony
 * @subpackage opinion
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class opinionComponents extends sfComponents
{
  public function executeOpinate ($request) {
    if (!isset($this->form)) {
      $this->form = new FrontendOpinionForm(null, array('user'=>$this->getUser(),'object'=>$this->object));
    }
  }
  
  public function executeList ($request) {
    $this->opinions = $this->object->getNonSelectedOpinions();
    $this->numOpinions = $this->object->countOpinions();
  }
  
  public function executeListSelected ($request) {
    $this->opinions = $this->object->getSelectedOpinions();
  }
}
