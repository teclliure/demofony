<ul class="sf_admin_actions_form">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Back to list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save',  'label' => 'Save',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_add',  'label' => 'Save and add',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo $helper->linkToList(array(  'label' => 'Back to list',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'ui-icon' => '',)) ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'label' => 'Delete',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'ui-icon' => '',)) ?>
	  <li class="sf_admin_action_restore">
<?php if (method_exists($helper, 'linkToRestore')): ?>
  <?php echo $helper->linkToRestore($form->getObject(), array(  'label' => 'Restore',  'action' => 'restore',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'restore',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo link_to(__('Restore', array(), 'messages'), 'commentAdmin/restore?id='.$comment->getId(), 'class= fg-button ui-state-default fg-button-icon-left ') ?>
<?php endif; ?>
  </li>
	  <li class="sf_admin_action_save_and_delete">
<?php if (method_exists($helper, 'linkToSaveAndDelete')): ?>
  <?php echo $helper->linkToSaveAndDelete($form->getObject(), array(  'label' => 'Save and Delete',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_delete',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo link_to(__('Save and Delete', array(), 'messages'), 'commentAdmin/ListSaveAndDelete?id='.$comment->getId(), 'class= fg-button ui-state-default fg-button-icon-left ') ?>
<?php endif; ?>
  </li>
	  <li class="sf_admin_action_save_and_restore">
<?php if (method_exists($helper, 'linkToSaveAndRestore')): ?>
  <?php echo $helper->linkToSaveAndRestore($form->getObject(), array(  'label' => 'Save and Restore',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save_and_restore',  'ui-icon' => '',)) ?>
<?php else: ?>
  <?php echo link_to(__('Save and Restore', array(), 'messages'), 'commentAdmin/ListSaveAndRestore?id='.$comment->getId(), 'class= fg-button ui-state-default fg-button-icon-left ') ?>
<?php endif; ?>
  </li>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Save',  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'save',  'ui-icon' => '',)) ?>
<?php endif; ?>
</ul>