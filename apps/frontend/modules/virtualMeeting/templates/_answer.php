<div class="form_answer" style="margin: 30px">
  <form action="<?php echo url_for ('virtualMeeting/addAnswer?id='.$question->getId()) ?>" class="form" method="post" >
  <?php echo $formAnswer ?>
  <button type="submit" class="button1"><?php echo __('Send')?></button>
  </form>
</div>