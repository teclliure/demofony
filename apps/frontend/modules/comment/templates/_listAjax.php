<?php if($has_comments): ?>
<?php use_helper('Date', 'JavascriptBase', 'I18N') ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/comment.min.css") ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/pagination.min.css") ?>
<?php use_javascript("/vjCommentAdaptedPlugin/js/reply.min.js") ?>
<?php if(commentTools::isGravatarAvailable()): ?>
<?php use_helper('Gravatar') ?>
<?php endif ?>
<?php if ($pager->haveToPaginate()): ?>
<?php include_partial('comment/paginationAjax', array('pager' => $pager, 'object' => $object, 'position' => 'top','crypt'=>$crypt)) ?>
<?php endif ?>
<div id="view_list_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId()?>" style="text-align: center; <?php if ($pager->haveToPaginate()): ?>style="min-height: 200px"<?php endif;?>">
  <table class="list-comments" summary="">
<?php foreach($pager->getResults() as $c): ?>
<?php include_partial("comment/commentAjax", array('obj' => $c, 'i' => (++$i + $cpt), 'first_line' => ($i == 1), 'form_name' => $form_name)) ?>
<?php endforeach; ?>
  </table>
</div>
<?php if ($pager->haveToPaginate()): ?>
<?php include_partial('comment/paginationAjax', array('pager' => $pager, 'object' => $object, 'position' => 'back','crypt'=>$crypt)) ?>
<?php endif ?>
<?php else: ?>
  <div>
    <h3><?php echo __('No comments yet.') ?></h3>
  </div>
<?php endif ?>