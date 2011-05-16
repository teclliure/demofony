<?php use_helper('I18N') ?>
<script type="text/javascript">
<!--
$(function() {
  $('.qtip_launch').qtip({
    metadata: {
    type: 'html5', // Use HTML5 data-* attributes
    name: 'qtipopts' // Grab the metadata from the data-qtipOpts HTML5 attribute
  },
  content: {
   text: function(api) {
      // Retrieve content from custom attribute of the $('.selector') elements.
      return $(this).attr('qtip-content');
   }
  }
  // content: 'I\'m using HTML5 to set my style... so so trendy.'
  });
});
//-->
</script>
  <a class="dialog-close" href="#" onClick="$('#select_content').dialog('close'); return false;">X</a>
  <h1 class="modal-title"><?php echo __('What type of proposal do you want add ?') ?></h1>
  <a href="<?php echo url_for('@contentAdd?class=CitizenProposal') ?>" class="button1 color1 qtip_launch" qtip-content="<?php echo __('Use your inventiveness to create a better Eivissa. The initiatives with more support will be studied by the Government.') ?>"><?php echo __('Iniciative')  ?></a>
  <a href="<?php echo url_for('@contentAdd?class=CitizenAction') ?>" class="button1 color1  qtip_launch" qtip-content="<?php echo __('Summon other citizens to a gathering in order to actively improve Eivissa.') ?>"><?php echo __('Action') ?></a>
  <a href="<?php echo url_for('@contentAdd?class=Workshop') ?>" class="button1 color1 qtip_launch" qtip-content="<?php echo __('Offer your knowledge to other Citizens. Publish your conditions.') ?>"><?php echo __('Workshop') ?></a>

