<?php use_helper('I18N') ?>
<script type="text/javascript">
<!--
$(function() {
  $("input.date").datepicker();
  
  $("div.box:has(ul.tabs)").tabs();
  
  $("div.box ul.tabs li").each(function(){
  var b = $(this).find("b")
    b.css("marginTop", ($(this).find("a").height() / 2) - (b.height() / 2) - 7);
  });
});
//-->
</script>
<div class="box has-tabs has-title iniciatives">
  <h1 class="hdr"><span class="inline icon-microphone"></span><?php echo __('I-nterviews') ?></h1>
        
  <ul class="tabs">
    <li><a href="#archived"><b><?php echo __('Archived') ?></b></a></li>
    <li><a href="#not_archived"><b><?php echo __('Not archived') ?></b></a></li>
  </ul>
  
  <div class="box-content"  id="archived">
    <?php include_partial('virtualMeeting/meetingList',array('meetings'=>$archivedVirtualMeetingsPager->getResults(),'id'=>'archived','pager'=>$archivedVirtualMeetingsPager,'url'=>'virtualMeeting/showPage/class/archived'))?>
  </div>
  <div class="box-content" id="not_archived">
    <?php include_partial('virtualMeeting/meetingList',array('meetings'=>$notArchivedVirtualMeetingsPager->getResults(),'id'=>'not_archived','pager'=>$notArchivedVirtualMeetingsPager,'url'=>'virtualMeeting/showPage/class/not_archived'))?>
  </div>
</div>