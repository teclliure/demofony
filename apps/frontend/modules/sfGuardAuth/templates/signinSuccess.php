<?php use_helper('I18N') ?>

<div class="box no-tabs no-margin">
  <div class="box-content show">

    <div class="box-title">
      <p><?php echo __('Signin', null, 'sf_guard') ?></p>
    </div>
    
    <form class="form" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['username']->renderRow() ?>
      <?php echo $form['password']->renderRow() ?>
      <?php $routes = $sf_context->getRouting()->getRoutes() ?>
      <?php if (isset($routes['sf_guard_forgot_password'])): ?>
      <div>
        <a href="<?php echo url_for('@sf_guard_forgot_password') ?>" class="remember"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
      </div>
      <?php endif; ?>
      <div>
        <?php echo $form['remember']->render() ?> <?php echo __('Remember me') ?>
      </div>
      <br />
      <button type="submit" class="button1"><?php echo __('Enter') ?> ></a>
    </form>
  </div>
  <div class="clear"></div>
</div>
