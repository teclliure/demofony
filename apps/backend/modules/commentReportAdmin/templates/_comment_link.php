<?php use_helper('JavascriptBase','Text') ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/commentReportAdmin.min.css", 'last') ?>
<?php $comment = $comment_report->getComment() ?>
<?php if ($comment) echo truncate_text( strip_tags($comment->getBodyCleanQuotes(ESC_RAW)), sfConfig::get('app_commentAdmin_max_length', 50), '...', true); ?>&nbsp;
<?php echo link_to_function(
              image_tag('/vjCommentAdaptedPlugin/images/magnifier.png', array('alt' => '')) ,
              "window.open('".$comment_report->getReferer()."', '".__('Report a comment')."', 'menubar=no, status=no, scrollbars=yes, menubar=no, width=565, height=600')", array('target' => '_blank')) ?>
