<a href="#" onClick="$('#view_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>').fadeToggle('slow');"><?php echo __('View/hide comments') ?> (<?php echo $object->getNbComments() ?>)</a>
<a href="#" onClick="$('#form_comment_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>').fadeToggle('slow');"><?php echo __('Add comment', array(), 'vjComment') ?></a>
<div id="form_comment_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>" style="display: none;">
<?php include_component('comment', 'formCommentAjax', array('object' => $object)) ?>
</div>
<div id="view_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>" style="display: none;">
<?php include_component('comment', 'listAjax', array('object' => $object, 'i' => 0,'crypt'=>$crypt)) ?>
</div>