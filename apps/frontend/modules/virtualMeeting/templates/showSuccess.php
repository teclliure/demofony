<?php slot('pageId') ?>id="qa"<?php end_slot() ?>
<script type="text/javascript">
<!--
$(function() {
  $("div.box:has(ul.tabs)").tabs();
  
  $("div.box ul.tabs li").each(function(){
  var b = $(this).find("b")
    b.css("marginTop", ($(this).find("a").height() / 2) - (b.height() / 2) - 7);
  });
  
  $("ul.tabs").css({top: -40});
  
});
//-->
</script>
    <div class="bar-left">
      <div class="box has-title color1">
          <h1 class="hdr"><?php echo __('Interview') ?></h1>
          <div class="box-content show">
              <div class="info">
                  <h1 class="interviewed" style="top: 25px"><?php echo $interview->getsfGuardUser()->getName() ?></h1>
                  <div class="img profile"><img src="<?php echo $interview->getsfGuardUser()->getProfile()->getImageSrcWithDefault('image','main') ?>" alt="<?php echo $interview->getsfGuardUser() ?> image" /></div>
                  <div class="user">
                    <h1><?php echo $interview->getTitle() ?> <span class="misc misc-<?php if($interview->isOpened()): ?>unlock<?php else: ?>lock<?php endif;?> inline"></span></h1>
                    <div style="height: 50px">
                      <p><?php echo __('Participants') ?>: <strong><?php echo $interview->getNumUsers()?></strong></p>
                      <p><?php echo __('Questions') ?>: <strong><?php echo $interview->getNumQuestions()?></strong></p>
                      <p><?php echo __('Answers') ?>: <strong><?php echo $interview->getNumAnswers()?></strong></p>
                    </div>
                  </div>
                  <div class="clear"></div>
              </div>
              <div class="about">
                <?php echo $interview->getBody() ?>
              </div>
              
              <?php if ($sf_user->isAuthenticated() && $interview->isOpened()): ?>
                <div id="form_question" style="display: none; margin: 10px 0 10px 0;">
                  <form action="<?php echo url_for ('virtualMeeting/addQuestion?id='.$interview->getId()) ?>" class="form" method="post" >
                  <?php echo $form ?>
                  <button type="submit" class="button1"><?php echo __('Send')?></button>
                  </form>
                </div>
                <div class="answer-own" id="ask_question">
                  <a href="#" onClick="$('#ask_question').fadeToggle('slow'); $('#form_question').fadeToggle('slow'); return false;" class="button1"><?php echo __('Ask your question') ?></a>
                </div>
              <?php endif; ?>
              
          </div>
      </div>
    </div>

    
    <div class="bar-right">
      <div class="box has-tabs has-title questions" id="questions_div">
        <h1 class="hdr"><span class="inline icon-microphone"></span><?php echo __('Questions') ?></h1>
        <ul class="tabs">
          <li><a href="#answered"><b><?php echo __('Answered') ?></b></a></li>
          <li><a href="#not_answered"><b><?php echo __('Not answered') ?></b></a></li>
        </ul>
        
        <div class="box-content"  id="answered">
          <?php include_partial('virtualMeeting/questionList',array('questions'=>$interview->getAnsweredQuestions()))?>
        </div>
        <div class="box-content" id="not_answered">
          <?php include_partial('virtualMeeting/questionList',array('questions'=>$interview->getNotAnsweredQuestions()))?>
        </div>
        <div class="clear"></div>
      </div>
    </div>