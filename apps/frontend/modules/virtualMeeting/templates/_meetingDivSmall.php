<?php use_helper ('Date') ?>
<div class="col1">
    <div class="img"><img src="<?php echo $meeting->getSfGuardUser()->getProfile()->getImageSrcWithDefault('image', 'thumb')?>" alt="profile_image" /></div>
    <h1><?php echo link_to ($meeting->getTitle(),$meeting->getRawValue()->getUrl())?></h1>
    <p class="author"><?php echo ('Interview with')?> <?php echo link_to($meeting->getSfGuardUser(),'user/showProfile?username='.$meeting->getSfGuardUser()->getUsername()) ?></p>
</div>

<div class="col2">
    <p><strong><?php echo __('Answers start date')?>:</strong> <?php echo format_date($meeting->getAnswersStartDate()) ?></p>
    <p><strong><?php echo __('Answers end date')?>:</strong> <?php echo format_date($meeting->getAnswersEndDate()) ?></p>
    <p class="estat"><strong><?php echo __('Status')?>:</strong> <?php echo $meeting->getState() ?> <span class="misc misc-<?php if($meeting->isOpened()): ?>unlock<?php else: ?>lock<?php endif;?> inline"></span></p>
</div>
<div class="col3">
    <p><strong><?php echo __('Number of Participants') ?>: <?php echo $meeting->getNumUsers()?></strong></p>
    <p><strong><?php echo __('Number of Questions') ?>: <?php echo $meeting->getNumQuestions()?></strong></p>
    <p><strong><?php echo __('Number of Answers') ?>: <?php echo $meeting->getNumAnswers()?></strong></p>
</div>
<div class="col4">
  <center><a href="<?php echo url_for($meeting->getRawValue()->getUrl()) ?>" class="button1 enter"><?php echo __('Enter')?></a></center>
</div>
<div class="clear"></div>
