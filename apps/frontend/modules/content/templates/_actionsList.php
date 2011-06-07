<?php foreach ($contents as $i=>$action): ?>
  <div class="trobada <?php if(get_class($action->getRawValue()) == 'Workshop'): ?>taller<?php endif;?>  <?php if (!($i%2 != 0 && $i != 0)): ?>color<?php endif; ?>">
      <?php include_partial('content/actionDivSmall',array('action'=>$action))?>
  </div>
<?php endforeach; ?>

<?php if(isset($pager)): ?><?php include_partial('home/doctrinePager',array('pager'=>$pager,'id'=>$id,'url'=>$url)) ?><?php endif; ?>