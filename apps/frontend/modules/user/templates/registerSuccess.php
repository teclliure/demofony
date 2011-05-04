<?php use_helper('I18N') ?>
<div class="box no-tabs no-margin">
  <div class="box-content show">

    <div class="box-title">
      <p><?php echo __('Register', null, 'sf_guard') ?></p>
    </div>
    
    <div class="">
      <?php echo get_partial('user/multipageForm', array('form' => $form)) ?>
    </div>
  </div>
  <div class="clear"></div>
</div>

