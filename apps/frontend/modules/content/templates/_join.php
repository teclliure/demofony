<?php if (!$sf_request->isXmlHttpRequest()): ?>
<div class="box no-tabs" id="join_box">
<?php endif; ?>
  <div class="box-content show">
  <div class="box-title color2">
     <p><?php echo __('Joined action')?></p>
  </div>
    <?php echo $object->getNumberUsersRegistered()?> <?php echo __('users joined action.')?>
  </div>
<?php if (!$sf_request->isXmlHttpRequest()): ?>
</div>
<?php endif; ?>