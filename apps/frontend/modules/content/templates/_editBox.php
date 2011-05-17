<?php if (!$sf_request->isXmlHttpRequest()): ?>
<div class="box no-tabs" id="admin_box">
<?php endif; ?>
  <div class="box-content show">
    <div class="box-title color2">
       <p><?php echo __('Admin')?> <?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?></p>
    </div>
    <div class="edit">
      <?php if ($object->getConfirmed()): ?>
        <p><?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?> <?php echo __('already confirmed') ?></p>
        <br /><br />
        <center><?php  echo link_to(__('Edit'),'content/edit?class='.get_class($object->getRawValue()).'&slug='.$object->getSlug(),array('class'=>'button1','confirm'=>__('Are you sure ? You may not change your').' '.__(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))).' '.__('after it is confirmed'))) ?></center>
      <?php else: ?>
        <center><?php  echo link_to(__('Edit'),'content/edit?class='.get_class($object->getRawValue()).'&slug='.$object->getSlug(),array('class'=>'button1')) ?></center>
      <?php endif; ?>
    </div>
    <br />
    <div class="close">
      <p><?php echo __('There must be at least the minimum of users subscribed and location filled by you to allow confirm the') ?> <?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?>.</p>
      <p><?php echo __('When you confirm an email is sent to all subscribed users whith the') ?> <?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?> <?php echo __('information and the register is closed.') ?></p>
      <?php if ($object->canBeClosed() && !$object->getConfirmed()): ?>
        <br />
        <center><?php echo link_to(__('Confirm'),'content/close?class='.get_class($object->getRawValue()).'&slug='.$object->getSlug(),array('class'=>'button1')) ?></center>
        <br />
        <br />
      <?php endif; ?>
    </div>
  </div>
<?php if (!$sf_request->isXmlHttpRequest()): ?>
</div>
<?php endif; ?>