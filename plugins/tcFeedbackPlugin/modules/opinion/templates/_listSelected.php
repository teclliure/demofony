<?php if ($opinions && count($opinions)): ?>
<div class="box-title color2">
  <p><?php echo __('Selected opinions') ?></p>
</div>
        
<?php foreach ($opinions as $opinion): ?>
  <?php include_partial ('opinion/showOpinion',array('opinion'=>$opinion,'object'=>$object,'selected'=>true))?>
<?php endforeach; ?>
<?php endif; ?>