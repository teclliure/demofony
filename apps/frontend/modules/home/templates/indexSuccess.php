<?php slot('pageId') ?>id="home"<?php end_slot() ?>
<script type="text/javascript">
<!--
$(function() {
  $("input.date").datepicker();
  
  $("div.box:has(ul.tabs)").tabs();
  
  $("div.box ul.tabs li").each(function(){
  var b = $(this).find("b")
    b.css("marginTop", ($(this).find("a").height() / 2) - (b.height() / 2) - 7);
  });
  
  $("#perfil form.add-comment").find("a.add").click(function(){
    $(this).next().show().find("textarea").focus();
    return false;
  }).end().find("a.cancel").click(function(){
    $(this).parent().hide();
    return false;
  });
});
//-->
</script>
<div class="bar-left">
   <div class="box has-tabs has-title iniciatives">
      <h1 class="hdr"><span class="inline icon-altavoz_announcements"></span><?php echo __('Initiatives') ?></h1>
      <ul class="tabs">
        <li><a href="#all"><span></span><b><?php echo __('View all') ?></b></a></li>
        <li><a href="#citizen_proposal" class="qtip_launch" qtip-content="<?php echo __('Use your inventiveness to create a better Eivissa. The initiatives with more support will be studied by the Government.') ?>"><span class="icon-letter-c">c</span><b style="margin-top: 9.5px;"><?php echo __('Citizen<br /> initiatives') ?></b></a></li>
        <li><a href="#goverment_proposal" class="qtip_launch" qtip-content="<?php echo __('Give us your opinion about initiatives proposed by the Government.') ?>"><span class="icon-letter-g">g</span><b style="margin-top: 9.5px;"><?php echo __('Goverment<br /> initiatives') ?></b></a></li>
        <li><a href="#goverment_consultation"  class="qtip_launch" qtip-content="<?php echo __('Give us your opinion about issues of public interest.') ?>"><span class="icon-letter-q">?</span><b style="margin-top: 9.5px;"><?php echo __('Opinion<br /> polls') ?></b></a></li>
      </ul>
      <div class="box-content"  id="all">
        <?php include_partial('content/initiativesList',array('contents'=>$pager_last_proposals->getResults(),'id'=>'all','url'=>url_for('content/showPage?class=Proposal&id=all&partial=initiativesList&limit=5'),'pager'=>$pager_last_proposals))?>
      </div>
      <div class="box-content" id="citizen_proposal">
        <?php include_partial('content/initiativesList',array('contents'=>$pager_last_citizen_proposals->getResults(),'id'=>'citizen_proposal','url'=>url_for('content/showPage?class=CitizenProposal&id=citizen_proposal&partial=initiativesList&limit=5'),'pager'=>$pager_last_citizen_proposals))?>
      </div>
      <div class="box-content" id="goverment_proposal">
        <?php include_partial('content/initiativesList',array('contents'=>$pager_last_goverment_proposals->getResults(),'id'=>'goverment_proposal','url'=>url_for('content/showPage?class=GovermentProposal&id=goverment_proposal&partial=initiativesList&limit=5'),'pager'=>$pager_last_goverment_proposals))?>
      </div>
      <div class="box-content" id="goverment_consultation">
        <?php include_partial('content/initiativesList',array('contents'=>$pager_last_goverment_consultations->getResults(),'id'=>'goverment_consultation','url'=>url_for('content/showPage?class=GovermentConsultation&id=goverment_consultation&partial=initiativesList&limit=5'),'pager'=>$pager_last_goverment_consultations))?>
      </div>
  </div>

  <div class="box has-tabs has-title mapa">
    <h1 class="hdr"><span class="inline icon-meeting_point"></span><?php echo __('Meetings') ?></h1>
    <ul class="tabs">
      <li><a href="#mapa"><span class="icon-map inline"></span><b><?php echo __('Map') ?></b></a></li>
      <li><a href="#accio-ciutadana" class="qtip_launch" qtip-content="<?php echo __('Summon other citizens to a gathering in order to actively improve Eivissa.') ?>"><span class="icon-pin_yellow inline"></span><b><?php echo __('Citizen<br /> action') ?></b></a></li>
      <li><a href="#sota-demanda" class="qtip_launch" qtip-content="<?php echo __('Offer your knowledge to other Citizens. Publish your conditions.') ?>"><span class="icon-pin_blue inline"></span><b><?php echo __('Workshops<br /> on demand') ?></b></a></li>
    </ul>
    <div class="box-content" id="mapa">
      <?php if ($map->countMarkers()): ?>
      <?php $map->showMap(true); ?>
      <?php else: ?>
      <?php $map->showMap(false); ?>
      <?php endif; ?>
    </div>
    <div class="box-content accio-ciutadana" id="accio-ciutadana">
      <?php include_partial('content/actionsList',array('contents'=>$pager_last_citizen_actions->getResults(),'id'=>'accio-ciutadana','url'=>url_for('content/showPage?class=CitizenAction&id=accio-ciutadana&partial=actionsList&limit=5'),'pager'=>$pager_last_citizen_actions))?>
    </div>
    <div class="box-content" id="sota-demanda">
      <?php include_partial('content/actionsList',array('contents'=>$pager_last_workshops->getResults(),'id'=>'sota-demanda','url'=>url_for('content/showPage?class=Workshop&id=sota-demanda&partial=actionsList&limit=5'),'pager'=>$pager_last_workshops))?>
    </div>
  </div>
</div>
<div class="bar-right">
  <div class="box crear">
      <div class="box-content">
          <div class="misc misc-people"></div>
          <p><?php echo __('Do you want to participate in creating a better <strong>Eivissa</strong>?') ?></p>
          <?php if ($sf_user->isAuthenticated()): ?>
            <a href="#" class="select_content button1"><?php echo __('Make your proposal') ?></a>
          <?php else: ?>
            <?php echo link_to(__('Create account'),'@register',array('class'=>'button1')) ?>
          <?php endif; ?>
      </div>
  </div>
  
  <div class="box has-title noticias">
    <h1 class="hdr"><span class="inline icon-news"></span><?php echo __('News') ?></h1>
    <div id="news_box" class="box-content">
    <?php include_partial ('content/news',array('contents'=>$pager_last_news->getResults(), 'pager'=>$pager_last_news)); ?>
    </div>
  </div>
  
  
  <div class="box has-title entrevistas">
      <h1 class="hdr"><span class="inline icon-microphone"></span><?php echo __('I-nterview') ?></h1>
      <?php if ($virtualMeetings && count($virtualMeetings)): ?>
        <?php foreach ($virtualMeetings as $virtualMeeting): ?>
        <div class="box-content">
            <div class="img"></div>
            <h1><?php echo __('Ask a question') ?> <?php echo $virtualMeeting->getsfGuardUser()?></h1>
            <p><?php echo $virtualMeeting->getTitle()?></p>
            <div class="bottom">
              <a href="<?php echo url_for('virtualMeeting/view?id='.$virtualMeeting->getId()) ?>" class="button1 inline"><?php echo __('Enter') ?></a>
              <strong><span class="misc misc-<?php if($virtualMeeting->isOpened()): ?>unlock<?php else: ?>lock<?php endif; ?> inline"></span><?php echo $virtualMeeting->getState() ?></strong>
              <div class="clear"></div>
            </div>
        </div>
      <?php endforeach ?>
      <div class="nav">
      	<a href="#" class="prev"><<</a><span></span><a href="#" class="next">>></a>
      </div>
      <?php else: ?>
      <div class="box-content">
        <h1><?php echo __('No virtual meeting avaliable') ?></h1>
      </div>
      <?php endif; ?>
      <div class="clear"></div>
      <center><a href="<?php echo url_for('virtualMeeting/index') ?>" class="button1 inline view-all"><?php echo __('View all interviews') ?></a></center>
      <div class="clear"></div><br />
  </div>
  
  <div class="clear"></div>
</div>
