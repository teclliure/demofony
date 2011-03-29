<?php if (!isset($first_level)): ?><ul><?php endif ?>
  <li>
    <?php include_partial('nestedSetManager/row', array('model' => $model, 'field' => $field, 'current_record' => $current_record)) ?>

    <?php // If there are children we call this template again to begin a new root template ?>
    
    <?php @FIXME: Sustituir getChildren() ?>
    <?php if ($children = $current_record->getNode()->getChildren()): ?>
      <?php foreach ($children AS $child): ?>
        <?php include_partial('nestedSetManager/root', array('model' => $model, 'field' => $field, 'current_record' => $child)) ?>
      <?php endforeach ?>
    <?php endif ?>
  </li>
<?php if (!isset($first_level)): ?></ul><?php endif ?>