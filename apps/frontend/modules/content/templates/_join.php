<?php if (!$sf_request->isXmlHttpRequest()): ?>
<div class="box no-tabs" id="join_box">
<?php endif; ?>
  <div class="box-content show">
  <div class="box-title color2">
     <p><?php echo __('Join action')?></p>
  </div>
    <?php echo $object->getNumberUsersRegistered()?> <?php echo __('users joined action.')?>
    <br />
    <?php if ($sf_user->isAuthenticated()): ?>
      <?php if ($object->hasRegistered($sf_user->getGuardUser())): ?>
        <h2><?php echo __('You are already registered.')?></h2>
        <br />
        <br />
        <a href="#" class="button1" onCLick="$('#join_box').load('<?php echo url_for('content/unjoin?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>')"><?php echo __('Remove myself') ?></a>
      <?php else: ?>
        <br />
        <a href="#" class="button1" onCLick="$('#join_box').load('<?php echo url_for('content/join?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>')"><?php echo __('Join') ?></a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
<?php if (!$sf_request->isXmlHttpRequest()): ?>
</div>
<?php endif; ?>