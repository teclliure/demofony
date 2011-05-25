<?php use_helper('Date') ?>
<?php foreach ($questions as $question): ?>
<div class="question">
  <div class="content">
      <div class="left">
          <h2><?php echo link_to($question->getSfGuardUser(),'user/showProfile?username='.$question->getSfGuardUser()->getUsername()) ?></h2>
          <p class="date"><?php echo format_date($question->getCreatedAt()) ?></p>
      </div>
      <div class="right">
          <div class="text q">
            <?php echo $question->getQuestion() ?>
          </div>
          <?php if ($question->getVirtualMeetingAnswer()) :?>
          <div class="text answer">
            <h1><?php echo __('Answer') ?>:</h1>
            <p><?php echo $question->getVirtualMeetingAnswer()->getAnswer() ?></p>
          </div>
          <?php elseif ($sf_user->isAuthenticated() && ($sf_user->getGuardUser()->getId() == $question->getVirtualMeeting()->getUserId() || $sf_user->hasCredential('admin'))): ?>
            <?php include_component ('virtualMeeting','answer',array('question'=>$question)) ?>
          <?php endif; ?>
      </div>
      <div class="clear"></div>
      <span class="icon-quote2 quote quote-left"></span>
      <span class="icon-quote1 quote quote-right"></span>
  </div>
</div>
<?php endforeach; ?>