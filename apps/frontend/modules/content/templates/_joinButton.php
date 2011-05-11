<?php if (!$sf_request->isXmlHttpRequest() || isset($not_ajax)): ?>
<div id="join_button">
<?php else: ?>
<script>
 $('#join_box').load('<?php echo url_for('content/joinBox?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>');
</script>
<?php endif; ?>
<?php if ($sf_user->isAuthenticated()): ?>
  <?php if ($object->hasRegistered($sf_user->getGuardUser())): ?>
    <h2><?php echo __('You are already registered.')?></h2>
    <br />
    <br />
    <a href="#" class="button1" onCLick="$('#join_button').load('<?php echo url_for('content/unjoin?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>')"><?php echo __('Remove myself') ?></a>
  <?php else: ?>
    <br />
    <a href="#" class="button1" onCLick="$('#join_button').load('<?php echo url_for('content/join?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>')"><?php echo __('Join') ?></a>
  <?php endif; ?>
<?php endif; ?>
<?php if (!$sf_request->isXmlHttpRequest() || isset($not_ajax)): ?>
</div>
<?php endif; ?>
    
  
