<li class="sf_admin_action_response">
  <?php if(!$object->getHasResponse()): ?>
    <a href="<?php echo url_for('response/add?id='.$object->getId().'&class='.get_class($object->getRawValue())) ?>" class="fg-button ui-state-default fg-button-icon-left"><span class="ui-icon ui-icon-comment"></span><?php echo __('Add goverment response') ?></a>
  <?php else: ?>
    <a href="<?php echo url_for('response/edit?id='.$object->getId().'&class='.get_class($object->getRawValue())) ?>" class="fg-button ui-state-default fg-button-icon-left"><span class="ui-icon ui-icon-comment"></span><?php echo __('Edit goverment response') ?></a>
  <?php endif; ?>
</li>
