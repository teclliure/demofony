<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($comment, array(  'label' => $configuration['_edit']['label'],  'params' =>   array(  ),  'class_suffix' => 'edit',)) ?>
    <?php echo $helper->linkToReply($comment, array(  'params' =>   array(  ),  'class_suffix' => 'answer',  'label' => $configuration['reply']['label'],)) ?>
    <?php if(!$comment->is_delete): ?>
      <?php echo $helper->linkToIsDelete($comment, array(  'params' =>   array(  ),  'class_suffix' => 'delete',  'label' => $configuration['_delete']['label'],)) ?>
    <?php else: ?>
      <?php echo $helper->linkToRestore($comment, array(  'params' =>   array(  ),  'class_suffix' => 'restore',  'label' => $configuration['restore']['label'],)) ?>
    <?php endif ?>
  </ul>
</td>
