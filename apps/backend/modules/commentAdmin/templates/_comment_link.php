<?php use_helper('JavascriptBase','Text') ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/commentReportAdmin.min.css", 'last') ?>
<?php if ($comment): ?>
  <a href="<?php echo url_for(sfContext::getInstance()->getConfiguration()->generateFrontendUrl($comment->getAssociatedObject()->getUrl())) ?>" target="_blank"><?php echo image_tag('/vjCommentAdaptedPlugin/images/magnifier.png', array('alt' => __('Show content'))).__('Show content') ?></a>
<?php endif; ?>