<?php foreach ($meetings as $i=>$meeting): ?>
  <div class="trobada <?php if (!($i%2 != 0 && $i != 0)): ?>color<?php endif; ?>">
      <?php include_partial('virtualMeeting/meetingDivSmall',array('meeting'=>$meeting))?>
  </div>
<?php endforeach; ?>

<?php if(isset($pager)): ?><?php include_partial('home/doctrinePager',array('pager'=>$pager,'id'=>$id,'url'=>$url)) ?><?php endif; ?>