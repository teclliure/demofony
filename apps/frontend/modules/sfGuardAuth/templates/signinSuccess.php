<?php use_helper('I18N') ?>

<center>
<div id="login_box" class="ui-widget-content ui-corner-all">
  <h1><?php echo __('Signin', null, 'sf_guard') ?></h1>
  
  <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
</div>
</center>