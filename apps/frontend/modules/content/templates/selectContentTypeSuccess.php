<?php use_helper('I18N') ?>
  <a class="dialog-close" href="#" onClick="$('#login_dialog').dialog('close'); return false;">X</a>
  <h1 class="modal-title"><?php echo __('What type of proposal do you want add ?') ?></h1>
  <a href="<?php echo url_for('@contentAdd?class=CitizenProposal') ?>" class="button1 color1"><?php echo __('Iniciative')  ?></a>
  <a href="<?php echo url_for('@contentAdd?class=CitizenAction') ?>" class="button1 color1"><?php echo __('Action') ?></a>
  <a href="<?php echo url_for('@contentAdd?class=Workshop') ?>" class="button1 color1"><?php echo __('Workshop') ?></a>

