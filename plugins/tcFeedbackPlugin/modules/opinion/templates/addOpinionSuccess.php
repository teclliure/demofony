<script>
if ($('#opinions_list').length) $('#opinions_list').load('<?php echo url_for('opinion/list?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>');
if ($('#count_box').length) $('#count_box').load('<?php echo url_for('opinion/count?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>');
if ($('#graph_box').length) $('#graph_box').load('<?php echo url_for('opinion/graph?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>');
</script>
<div class="form-opinate box color1 no-tabs participate" id="form_opinate_Workshop_1">
  <span class="icon-box-arrow"></span>
  <div class="box-content show">
    <div class="hdr"><span class="icon-ficha_accion_header"></span><strong><?php echo __('Participate') ?></strong></div>
    <?php if($object->hasJoinBox()): ?>
        <?php include_partial('content/joinButton', array('object' => $object, 'not_ajax'=>true)) ?>
    <?php endif; ?>
    <div id="alreadyopinated"><?php echo __('Opinion correctly submited') ?></div>
  </div>
</div>