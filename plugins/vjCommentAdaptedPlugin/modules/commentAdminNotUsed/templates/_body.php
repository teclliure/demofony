<?php use_helper('Text') ?>
<?php use_stylesheet('/vjCommentPlugin/css/infoBulle.min.css') ?>
<a class="info">
  <?php echo truncate_text( strip_tags($comment->getBodyCleanQuotes(ESC_RAW)), sfConfig::get('app_commentAdmin_max_length', 50), '...', true); ?>
  <span class="body">
    <?php echo $comment->getBody(ESC_RAW) ?>
  </span>
</a>