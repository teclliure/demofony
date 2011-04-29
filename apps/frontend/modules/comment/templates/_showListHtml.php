<div id="view_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>" class="featured" style="display: none;">
<?php include_component('comment', 'listAjax', array('object' => $object, 'i' => 0,'crypt'=>$crypt)) ?>
</div>