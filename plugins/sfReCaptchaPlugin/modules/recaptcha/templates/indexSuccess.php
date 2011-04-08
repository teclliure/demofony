<?php use_helper('recaptcha') ?>

<form action="<?php echo url_for('recaptcha/index') ?>" method="post">
  <?php echo recaptcha_get_html(sfConfig::get('app_recaptcha_publickey'), $form['response']->getError()) ?>
  <input type="submit" />
</form>
