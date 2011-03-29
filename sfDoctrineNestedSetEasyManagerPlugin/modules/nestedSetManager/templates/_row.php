<span class="move_controls">
  <?php if($current_record->getNode()->hasNextSibling()): ?>
    <span>
      <?php echo jq_link_to_remote(image_tag('/sfDoctrineNestedSetEasyManagerPlugin/images/move_down.png', array('alt' => 'move down this item', 'title' => 'move down this item' )), array(
        'url' => '@tree_move_item_to?direction=down&model='.$model.'&field='.$field.'&id='.$current_record->getId(),
        'update' => 'tree_container')); ?>
    </span>
  <?php endif ?>

  <?php if($current_record->getNode()->hasPrevSibling()): ?>
    <span>
      <?php echo jq_link_to_remote(image_tag('/sfDoctrineNestedSetEasyManagerPlugin/images/move_up.png'), array(
        'url' => '@tree_move_item_to?direction=up&model='.$model.'&field='.$field.'&id='.$current_record->getId(),
        'update' => 'tree_container')); ?>
    </span>
  <?php endif ?>
  &nbsp;
</span>

<div id="replaced_when_editing_<?php echo $current_record->getId()?>" class="tree_edit_zone">
  <h3><?php echo $current_record->get($field) ?></h3>

  <span class="content_controls">
    <span>
      <?php echo jq_link_to_remote(image_tag('/sfDoctrineNestedSetEasyManagerPlugin/images/edit.png', array('alt' => 'edit','title' => 'edit')), array(
        'url' => '@tree_edit_item?model='.$model.'&field='.$field.'&record_id='.$current_record->getId().'&current_value='.$current_record->get($field),
        'update' => 'replaced_when_editing_'.$current_record->getId())) ?>
    </span>
    <span>
      <?php echo jq_link_to_remote(image_tag('/sfDoctrineNestedSetEasyManagerPlugin/images/add.png', array('alt' => 'add new child','title' => 'add new child')), array(
        'url' => '@tree_add_child?model='.$model.'&field='.$field.'&parent_id='.$current_record->getId(),
        'update' => 'tree_container')); ?>
    </span>
    <span>
      <?php echo jq_link_to_remote(image_tag('/sfDoctrineNestedSetEasyManagerPlugin/images/remove.png', array('alt' => 'delete item','title' => 'delete item')), array(
        'url' => '@tree_delete_item?model='.$model.'&field='.$field.'&id='.$current_record->getId(),
        'update' => 'tree_container', 'confirm' => 'Are you sure you want to delete this item? \nTHIS WILL REMOVE ALL CHILD ITEMS')) ?>
    </span>
  </span>
</div>