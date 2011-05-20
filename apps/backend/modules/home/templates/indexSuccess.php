<?php use_helper('I18N','Date') ?>
<script>
  $(function() {
    $( "#accordion" ).accordion();
  });
</script>

<div id="summary">
  <h1><?php echo __('Administrative pending tasks summary') ?></h1>
  <div id="accordion">
    <h3><a href="#"><?php echo __('Review pending contents') ?> (<?php echo $numContents ?>)</a></h3>
    <div>
      <?php foreach ($contents as $content): ?>
      <p><?php echo link_to($content,array('sf_route' => sfInflector::underscore(get_class($content->getRawValue())).'_edit', 'sf_subject' => $content)) ?> <?php echo __('by') ?> <?php echo $content->getSfGuardUser() ?> <?php echo __('on') ?> <?php echo format_date($content->getCreatedAt()) ?></p>
      <?php endforeach; ?>
    </div>
    <h3><a href="#"><?php echo __('Pending marked as innapropiate opinions') ?> (<?php echo $numOpinions ?>)</a></h3>
    <div>
      <p><center><?php echo link_to (__('Administer pending opinions'),'opinionsSpamAdmin/index') ?></center></p>
    </div>
    <h3><a href="#"><?php echo __('Pending marked as innapropiate comments') ?> (<?php echo $numComments ?>)</a></h3>
    <div>
      <p><center><?php echo link_to (__('Administer pending comments'),'commentReportAdmin/index') ?></center></p>
    </div>
  </div>
</div>