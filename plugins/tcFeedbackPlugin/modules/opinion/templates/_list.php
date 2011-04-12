<?php foreach ($opinions as $opinion): ?>
  <?php include_partial ('opinion/showOpinion',array('opinion'=>$opinion,'object'=>$object))?>
<?php endforeach; ?>
