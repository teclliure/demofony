<?php use_helper('JavascriptBase') ?>
<?php use_stylesheet("/vjCommentPlugin/css/commentReportAdmin.min.css", 'last') ?>
<?php echo link_to_function(
              image_tag('/vjCommentPlugin/images/magnifier.png', array('alt' => '')) ,
              "window.open('".$comment_report->getReferer()."', 'Reporter un commentaire', 'menubar=no, status=no, scrollbars=yes, menubar=no, width=565, height=600')", array('target' => '_blank')) ?>
