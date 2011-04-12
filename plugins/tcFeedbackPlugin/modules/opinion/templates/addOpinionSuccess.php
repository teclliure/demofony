<script>
$('#opinions_list').load('<?php echo url_for('opinion/list?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>');
</script>

<h3><?php echo __('Opinion correctly submited') ?></h3>