
  <?php foreach ($opinions as $opinion): ?>
    <?php include_partial ('opinion/showOpinion',array('opinion'=>$opinion,'object'=>$opinion->getObject(),'extended'=>true,'selected'=>$opinion->getSelected()))?>
  <?php endforeach; ?>
