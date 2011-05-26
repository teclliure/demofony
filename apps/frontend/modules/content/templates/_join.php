<?php if (!$sf_request->isXmlHttpRequest()): ?>
<div class="box no-tabs" id="join_box">
<?php endif; ?>
  <div class="box-content show">
  <div class="box-title color2">
     <p><?php echo __('Enrolled in this')?> <?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?></p>
  </div>
    <span id="users_joined"><?php echo $object->getNumberUsersRegistered()?> <?php echo __('users enrolled in')?> <?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?>.</span>
    <?php if ($object->isFull()): ?>
      <div id="users_joined"><?php echo __('Maximum registered users archieved.') ?></div>
    <?php endif; ?>
  </div>
<?php if (!$sf_request->isXmlHttpRequest()): ?>
</div>
<?php endif; ?>