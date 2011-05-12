<?php if (!$sf_request->isXmlHttpRequest()): ?>
<div class="box no-tabs" id="admin_box">
<?php endif; ?>
  <div class="box-content show">
    <div class="box-title color2">
       <p><?php echo __('Admin action')?></p>
    </div>
    <?php if($object->getConfirmed()): ?>
      <p><?php echo __('Action already confirmed') ?>
    <?php else: ?>
    <div class="edit"><?php echo link_to(__('Edit'),'content/edit?class='.get_class($object->getRawValue()).'&slug='.$object->getSlug(),array('class'=>'button1')) ?></div>
    <br />
    <div class="close">
      <p><?php echo __('There must be at least the minimum of users subscribed and location filled by you to allow confirm the action.') ?></p>
      <p><?php echo __('When you confirm the action a email is sent to all subscribed users whith the action information and the register is closed.') ?></p>
      <?php if ($object->canBeClosed()): ?>
        <?php echo link_to(__('Confirm'),'content/close?class='.get_class($object->getRawValue()).'&slug='.$object->getSlug(),array('class'=>'button1')) ?>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
<?php if (!$sf_request->isXmlHttpRequest()): ?>
</div>
<?php endif; ?>