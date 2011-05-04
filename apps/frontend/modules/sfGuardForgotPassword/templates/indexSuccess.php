<?php use_helper('I18N') ?>
<div class="box no-tabs no-margin">
  <div class="box-content show">

    <div class="box-title">
      <p><?php echo __('Forgot your password?', null, 'sf_guard') ?></p>
    </div>
    
    <p>
      <?php echo __('Do not worry, we can help you get back in to your account safely!', null, 'sf_guard') ?>
      <?php echo __('Fill out the form below to request an e-mail with information on how to reset your password.', null, 'sf_guard') ?>
    </p>
    <br />
  <form class="form" action="<?php echo url_for('@sf_guard_forgot_password') ?>" method="post">
    <?php echo $form ?>
    <button class="button1" type="submit"><?php echo __('Request') ?></button>
  </form>
  </div>
  <div class="clear"></div>
</div>