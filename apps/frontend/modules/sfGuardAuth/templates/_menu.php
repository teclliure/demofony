<?php use_helper('jQuery')?>
<div id="menu_user">
<?php if ($sf_user->isAuthenticated()): ?>
  <?php echo __('Hi') ?>, <?php echo $sf_user ?> <?php echo link_to(__('logout'),'@sf_guard_signout') ?>
<?php else: ?>
  <?php echo link_to(__('register'),'@register') ?> <a href="#" class="login_opener"><?php echo __('login') ?></a>
<?php endif; ?>
</div>