<?php
$image = image_tag('loading.gif');
$image = str_replace('"','\\\'', $image);
//print $image; exit();
$link = "$('#view_list_comments_".get_class($object->getRawValue())."_".$object->getId()."').html('".$image."');$('#view_comments_".get_class($object->getRawValue())."_".$object->getId()."')";
?>
<div class="pagination">
  <?php if ($pager->getPage() != 1): ?>
  <a href="#" onClick="<?php echo $link ?>.load('<?php echo url_for('comment/listAjax?record_model='.get_class($object->getRawValue()).'&record_id='.$object->getId().'&page-'.$crypt.'=1') ?>'); return false;">
    <?php echo image_tag('/vjCommentAdaptedPlugin/images/resultset_first.png', array('alt' => __('First page of comments', array(), 'vjComment'), 'title' => __('First page of comments', array(), 'vjComment'))) ?>
  </a>
  
  <a href="#" onClick="<?php echo $link ?>.load('<?php echo url_for('comment/listAjax?record_model='.get_class($object->getRawValue()).'&record_id='.$object->getId().'&page-'.$crypt.'='.$pager->getPreviousPage()) ?>'); return false;">
    <?php echo image_tag('/vjCommentAdaptedPlugin/images/resultset_previous.png', array('alt' => __('Previous page of comments', array(), 'vjComment'), 'title' => __('Previous page of comments', array(), 'vjComment'))) ?>
  </a>
  <?php endif; ?>

  <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?><?php echo $page ?><?php else: ?>
      <a href="#" onClick="<?php echo $link ?>.load('<?php echo url_for('comment/listAjax?record_model='.get_class($object->getRawValue()).'&record_id='.$object->getId().'&page-'.$crypt.'='.$page) ?>');  return false;"><?php echo $page ?></a>
    <?php endif; ?>
  <?php endforeach; ?>

  <?php if ($pager->getPage() != $pager->getLastPage()): ?>
  <a href="#" onClick="<?php echo $link ?>.load('<?php echo url_for('comment/listAjax?record_model='.get_class($object->getRawValue()).'&record_id='.$object->getId().'&page-'.$crypt.'='.$pager->getNextPage()) ?>');  return false;">
    <?php echo image_tag('/vjCommentAdaptedPlugin/images/resultset_next.png', array('alt' => __('Next page of comments', array(), 'vjComment'), 'title' => __('Next page of comments', array(), 'vjComment'))) ?>
  </a>
  
  <a href="#" onClick="<?php echo $link ?>.load('<?php echo url_for('comment/listAjax?record_model='.get_class($object->getRawValue()).'&record_id='.$object->getId().'&page-'.$crypt.'='.$pager->getLastPage()) ?>');  return false;">
    <?php echo image_tag('/vjCommentAdaptedPlugin/images/resultset_last.png', array('alt' => __('Last page of comments', array(), 'vjComment'), 'title' => __('Last page of comments', array(), 'vjComment'))) ?>
  </a>
  <?php endif; ?>
</div>