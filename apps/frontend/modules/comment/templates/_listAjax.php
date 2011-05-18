<?php use_helper('Date', 'JavascriptBase', 'I18N') ?>
<?php if ($sf_request->isXmlHttpRequest()): ?>
<script type="text/javascript">
<!--
$('#number_view_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>').html('<?php echo $object->getNbComments()?>');
//-->
</script>
<?php else: ?>
  <?php use_stylesheet("/vjCommentAdaptedPlugin/css/comment.min.css") ?>
  <?php use_javascript("/vjCommentAdaptedPlugin/js/reply.min.js") ?>
<?php endif; ?>

<a href="#" onClick="$('#form_comment_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>').fadeToggle('slow'); return false;"><span class="inline icon-add_comment"></span> <?php echo __('Add comment') ?></a>
<div id="form_comment_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>" style="display: none;">
<?php include_component('comment', 'formCommentAjax', array('object' => $object)) ?>
</div>

<?php if($has_comments): ?>
  <?php if(commentTools::isGravatarAvailable()): ?>
    <?php use_helper('Gravatar') ?>
  <?php endif ?>
  <div id="view_list_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId()?>" style="<?php if ($pager->haveToPaginate()): ?>min-height: 200px;<?php endif;?>">
    <?php foreach($pager->getResults() as $c): ?>
    <?php include_partial("comment/commentAjax", array('obj' => $c, 'i' => (++$i + $cpt), 'first_line' => ($i == 1), 'form_name' => $form_name)) ?>
    <?php endforeach; ?>
  </div>
  <?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('comment/paginationAjax', array('pager' => $pager, 'object' => $object, 'position' => 'back','crypt'=>$crypt)) ?>
  <?php endif ?>
<?php else: ?>
  <div>
    <h3><?php echo __('No comments yet.') ?></h3>
  </div>
<?php endif ?>
