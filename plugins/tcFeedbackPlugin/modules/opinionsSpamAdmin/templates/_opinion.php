<?php use_helper('JavascriptBase','Text') ?>
<?php $opinion = $opinion_marked_as_spam->getOpinion()?>
<?php if ($opinion->getOpinionPossibility()): ?>
  <div class="op_possibility"><?php echo $opinion->getOpinionPossibility()?></div>
<?php endif; ?>
<div class="opinion"><?php echo $opinion->getOpinion()?></div>
<?php echo link_to(image_tag('/vjCommentAdaptedPlugin/images/magnifier.png', array('alt' => __('Show content'))).__('Show origin content'),$opinion->getFrontendUrl(),array('target'=>'_blank')); ?>&nbsp;