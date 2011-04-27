<div id="opinions_list">
  <div class="box-title">
    <p><?php echo __('Opinions')?> (<?php echo $numOpinions ?>)</p>
  </div>
  <?php foreach ($opinions as $opinion): ?>
    <?php include_partial ('opinion/showOpinion',array('opinion'=>$opinion,'object'=>$object))?>
  <?php endforeach; ?>
</div>