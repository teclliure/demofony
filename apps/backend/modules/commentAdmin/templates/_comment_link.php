<?php use_helper('JavascriptBase','Text') ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/commentReportAdmin.min.css", 'last') ?>
<?php if ($comment) echo link_to(image_tag('/vjCommentAdaptedPlugin/images/magnifier.png', array('alt' => __('Show content'))).truncate_text( strip_tags($comment->getBodyCleanQuotes(ESC_RAW)), sfConfig::get('app_commentAdmin_max_length', 50), '...', true),$comment_report->getReferer(),array('target'=>'_blank')); ?>&nbsp;