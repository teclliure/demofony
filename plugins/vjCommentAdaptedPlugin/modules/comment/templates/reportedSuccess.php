<?php use_helper('JavascriptBase', 'I18N') ?>
<?php use_stylesheet('/vjCommentAdaptedPlugin/css/reported.min.css') ?>
<div id="report-sent">
  <span><?php echo __('Report sent.', array(), 'vjComment') ?><br/><?php echo __('The moderation team has been notified.', array(), 'vjComment') ?></span><br /><br />
  <?php echo link_to_function(__('Close the popup', array(), 'vjComment'), 'window.close()') ?>
</div>