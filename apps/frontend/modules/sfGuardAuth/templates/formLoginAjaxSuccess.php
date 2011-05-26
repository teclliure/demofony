<?php use_helper('I18N') ?>
<a class="dialog-close" href="#" onClick="$('#login_dialog').dialog('close'); return false;">X</a>
<div class="signup-box">
  <div class="column margin login">
    <h1 class="modal-title"><?php echo __('Enter') ?></h1>
    <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['username']->renderRow() ?>
      <?php echo $form['password']->renderRow() ?>
      <?php $routes = $sf_context->getRouting()->getRoutes() ?>
      <?php if (isset($routes['sf_guard_forgot_password'])): ?>
      <div>
        <a href="<?php echo url_for('@sf_guard_forgot_password') ?>" class="remember"><?php echo __('Forgot your password?') ?></a>
      </div>
      <?php endif; ?>
      <div>
        <?php echo $form['remember']->render() ?> <?php echo __('Remember me') ?>
      </div>
      <button type="submit" class="button1"><?php echo __('Enter') ?> ></a>
    </form>
  </div>
  
  <div class="column signup">
    <h1 class="modal-title"><?php echo __('New on PensaEivissa?') ?></h1>
    <div>
      <p><?php echo __('Register and start participating right away') ?>.</p>
      <?php if (isset($routes['register'])): ?>
      <a href="<?php echo url_for('@register') ?>" class="button1 start"><?php echo __('Create account') ?> ></a>
      <?php endif; ?>
    </div>
  </div>
</div>
