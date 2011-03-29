<?php use_stylesheet('/sfDoctrineNestedSetEasyManagerPlugin/css/styles') ?>

<?php use_helper('Jquery'); ?>

<?php if( isset($tree) && is_object($tree) && $tree->count() > 0 ): ?>
<div id="tree_container">

  <ul id="tree">
    <?php echo jq_link_to_remote(image_tag('/sfDoctrineNestedSetEasyManagerPlugin/images/add.png', array('alt' => 'add new root','title' => 'add new root')), array(
          'url' => 'nestedSetManager/add_root?model='.$model.'&field='.$field,
          'update' => 'tree_container')); ?>
    <?php foreach($tree->fetchRoots() AS $current_record): ?>
      <?php include_partial('nestedSetManager/root', array('first_level' => true, 'model' => $model, 'field' => $field, 'current_record' => $current_record)) ?>
    <?php endforeach ?>
  </ul>

  <div class="clear"></div>
</div>
<?php endif ?>