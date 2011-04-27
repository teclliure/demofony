<?php foreach ($contents as $i=>$initiative): ?>
  <div class="iniciative <?php if (!($i%2 != 0 && $i != 0)): ?>color<?php endif; ?>">
    <?php include_partial('content/contentDivSmall',array('content'=>$initiative))?>
  </div>
<?php endforeach; ?>

<?php if(isset($pager)): ?><?php include_partial('home/doctrinePager',array('pager'=>$pager,'id'=>$id,'url'=>$url)) ?><?php endif; ?>