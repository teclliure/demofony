<?php slot('pageId') ?>id="perfil"<?php end_slot() ?>
<script type="text/javascript">
<!--
$(function() {
  $("div.box:has(ul.tabs)").tabs();
  
  $("div.box ul.tabs li").each(function(){
  var b = $(this).find("b")
    b.css("marginTop", ($(this).find("a").height() / 2) - (b.height() / 2) - 7);
  });
});
//-->
</script>
    <div class="bar-left">
      <div class="box has-title color1">
          <h1 class="hdr"><?php echo __('Interview with') ?></h1>
          <div class="box-content show">
              <div class="info">
                  <h1 class="hdr" style="top: 25px"><?php echo $interview->getsfGuardUser()->getName() ?></h1>
                  <br />
                  <br />
                  <br />
                  <br />
                  <div class="img profile"><img src="<?php echo $interview->getsfGuardUser()->getProfile()->getImageSrcWithDefault('image','main') ?>" alt="<?php echo $interview->getsfGuardUser() ?> image" /></div>
                  <div class="user">
                    <h1><?php echo $interview->getTitle() ?></h1>
                    <div style="height: 50px">
                      <p><?php echo __('Participants') ?>: <strong><?php echo $interview->getNumUsers()?></strong></p>
                      <p><?php echo __('Questions') ?>: <strong><?php echo $interview->getNumQuestions()?></strong></p>
                      <p><?php echo __('Answers') ?>: <strong><?php echo $interview->getNumAnswers()?></strong></p>
                    </div>
                  </div>
                  <div class="clear"></div>
              </div>
              <div>
                <?php echo $interview->getBody() ?>
              </div>
          </div>
      </div>
    </div>

    
    <div class="bar-right">
      <div class="box has-tabs has-title questions" id="questions_div">
        <h1 class="hdr"><span class="inline icon-microphone"></span><?php echo __('Questions') ?></h1>
        
        <?php if ($sf_user->isAuthenticated() && $interview->isOpened()): ?>
          <div id="form_question" style="margin: 30px">
            <form action="<?php echo url_for ('virtualMeeting/addQuestion?id='.$interview->getId()) ?>" class="form" method="post" >
            <?php echo $form ?>
            <button type="submit" class="button1"><?php echo __('Send')?></button>
            </form>
          </div>
        <?php endif; ?>
              
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