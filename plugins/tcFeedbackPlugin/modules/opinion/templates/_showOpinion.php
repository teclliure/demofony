<?php use_helper('Date')?>
<div class="opinion">
<?php echo $opinion->getSfGuardUser() ?> <?echo __('opinate') ?> <?php echo __($opinion->__toString()) ?> <?php echo __('on') ?> <?php echo format_date($opinion->getCreatedAt()) ?><br />
<?php echo $opinion->getOpinion() ?>

  <div class="opinion_like">
    <?php if ($sf_user->isAuthenticated() && !$object->hasOpinated($sf_user->getGuardUser())): ?>
      <a href="#" onClick="$('#opinions_list').load('<?php echo url_for('opinion/opinateLike?id='.$opinion->getId()) ?>')"><?php echo __('I opinate like') ?> <?php echo $opinion->getSfGuardUser() ?></a>
    <?php endif; ?>
  </div>
  
  <div class="opinion_spam">
    <?php if ($sf_user->isAuthenticated() && !$opinion->hasMarkedAsSpam($sf_user->getGuardUser())): ?>
      <a href="#" onClick="$('#opinions_list').load('<?php echo url_for('opinion/markAsSpam?id='.$opinion->getId()) ?>')"><?php echo __('Report as innadecuate') ?></a>
    <?php endif; ?>
  </div>
</div>
