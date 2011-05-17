<div class="sf_admin_flashes ui-widget">
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice ui-corner-all">
    <span class="ui-icon ui-icon-comment">&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <?php echo __($sf_user->getFlash('notice')) ?>
  </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error ui-corner-all">
    <span class="ui-icon ui-icon-alert">&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <?php echo __($sf_user->getFlash('error')) ?>
  </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('info')): ?>
  <div class="info ui-corner-all">
    <span class="ui-icon ui-icon-info">&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <?php echo __($sf_user->getFlash('info')) ?>
  </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('msg')): ?>
  <div class="info ui-corner-all">
    <span class="ui-icon ui-icon-info">&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <?php echo __($sf_user->getFlash('msg')) ?>
  </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('success')): ?>
  <div class="success ui-corner-all">
    <span class="ui-icon ui-icon-circle-check">&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <?php echo __($sf_user->getFlash('success')) ?>
  </div>
<?php endif; ?>
</div>
