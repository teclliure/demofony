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
        <li><a href="#citizen_proposal"><span class="icon-letter-c">c</span><b style="margin-top: 9.5px;"><?php echo __('Citizen<br /> initiatives') ?></b></a></li>
        <li><a href="#goverment_proposal"><span class="icon-letter-g">g</span><b style="margin-top: 9.5px;"><?php echo __('Goverment<br /> initiatives') ?></b></a></li>
        <li><a href="#goverment_consultation"><span class="icon-letter-q">?</span><b style="margin-top: 9.5px;"><?php echo __('Opinion<br /> polls') ?></b></a></li>
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
      <li><a href="#accio-ciutadana"><span class="icon-pin_yellow inline"></span><b><?php echo __('Citizen<br /> action') ?></b></a></li>
      <li><a href="#sota-demanda"><span class="icon-pin_blue inline"></span><b><?php echo __('Workshops<br /> on demand') ?></b></a></li>
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
          <p><?php echo __('Do you want participate in create a better <strong>Eivissa</strong>?') ?></p>
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
      <h1 class="hdr"><span class="inline icon-microphone"></span>E-ntrevistas</h1>
      <div class="box-content">
          <div class="img"></div>
          <h1>Haz tus preguntas a Don Jose</h1>
          <p>Consejal de Medio ambiente</p>
          <div class="bottom">
            <a href="#" class="button1 inline">Entrar</a>
            <strong><span class="misc misc-unlock inline"></span>Entrevista abierta</strong>
            <div class="clear"></div>
          </div>
      </div>
  </div>
  <div class="clear"></div>
</div>
