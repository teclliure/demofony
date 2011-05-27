<?php use_helper('Date') ?>
<div class="box-title color2">
  <h2><?php if (isset($values['name'])) echo $values['name'] ?> <?php echo $values['email'] ?> <?php echo __('has contacted you with the following message') ?>:</h2>
</div>

<div class="title">
  <p><?php echo $values['message'] ?></p>
  <div class="clear"></div>
</div>

