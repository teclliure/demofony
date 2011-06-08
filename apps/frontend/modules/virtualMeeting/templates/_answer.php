<div class="form_answer" style="margin: 30px">
  <a href="#" class="button1 toggler-next">Responder</a>
  <form action="<?php echo url_for ('virtualMeeting/addAnswer?id='.$question->getId()) ?>" class="form" method="post" style="display:none; margin-top:20px;">
  	<?php echo $formAnswer ?>
  	<button type="submit" class="button1"><?php echo __('Send')?></button>
  </form>
</div>