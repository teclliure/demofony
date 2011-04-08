<?php if($has_comments): ?>
<?php use_helper('Date', 'JavascriptBase', 'I18N') ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/comment.min.css") ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/pagination.min.css") ?>
<?php use_javascript("/vjCommentAdaptedPlugin/js/reply.min.js") ?>
<?php if(commentTools::isGravatarAvailable()): ?>
<?php use_helper('Gravatar') ?>
<?php endif ?>
  <div>
    <h1><?php echo __('Comments list', array(), 'vjComment') ?> (<?php echo $pager->getNbResults() ?>)</h1>
  </div>
<?php if ($pager->haveToPaginate()): ?>
<?php include_partial('comment/pagination', array('pager' => $pager, 'route' => $sf_request->getUri(), 'crypt' => $crypt, 'position' => 'top')) ?>
<?php endif ?>
  <table class="list-comments" summary="">
<?php foreach($pager->getResults() as $c): ?>
<?php include_partial("comment/comment", array('obj' => $c, 'i' => (++$i + $cpt), 'first_line' => ($i == 1), 'form_name' => $form_name)) ?>
<?php endforeach; ?>
  </table>
<?php if ($pager->haveToPaginate()): ?>
<?php include_partial('comment/pagination', array('pager' => $pager, 'route' => $sf_request->getUri(), 'crypt' => $crypt, 'position' => 'back')) ?>
<?php else: ?>
<?php include_partial('comment/back_to_top', array('route' => $sf_request->getUri(), 'crypt' => $crypt, 'text' => true)) ?>
<?php endif ?>
<?php else: ?>
  <div>
    <h1><?php echo __('Be the first to post', array(), 'vjComment') ?></h1>
  </div>
<?php endif ?>