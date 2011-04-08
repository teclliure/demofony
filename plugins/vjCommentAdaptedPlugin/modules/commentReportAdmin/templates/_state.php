<?php if($comment_report->getState() == "valid"): ?>
  <?php $image = "green"; ?>
<?php elseif($comment_report->getState() == "invalid"): ?>
  <?php $image = "red"; ?>
<?php else: ?>
  <?php $image = "orange"; ?>
<?php endif ?>
<?php echo image_tag('/vjCommentPlugin/images/flag_'.$image.'.png') ?>