<?php if (!$sf_request->isXmlHttpRequest()): ?>
<div class="box no-tabs" id="count_box">
<?php endif; ?>
  <div class="box-content show">
    <div class="box-title color2">
      <p><?php echo __('Participation')?></p>
    </div>
    <h2><?php echo $object->countOpinions() ?></h2>
    <?php echo __('supports')?>
  </div>
<?php if (!$sf_request->isXmlHttpRequest()): ?>
</div>
<?php endif; ?>