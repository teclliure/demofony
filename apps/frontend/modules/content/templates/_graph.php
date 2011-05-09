<?php if (!$sf_request->isXmlHttpRequest()): ?>
<div class="box no-tabs" id="graph_box">
<?php endif; ?>
  <div class="box-content show">
  <div class="box-title color2">
     <p><?php echo __('Participation results')?></p>
  </div>
  <?php foreach ($object->getPossibilities() as $possibility): ?>
    <h2><?php echo $possibility ?> (<?php echo $object->getPossibilityPercent($possibility) ?>%)</h2>
    <div class="rating"><div class="graph"><strong class="bar" style="width:<?php echo $object->getPossibilityPercent($possibility) ?>%;"></strong></div></div>
    <div class="clear"></div>
  <?php endforeach; ?>
  </div>
<?php if (!$sf_request->isXmlHttpRequest()): ?>
</div>
<?php endif; ?>