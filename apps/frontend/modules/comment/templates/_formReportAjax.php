<?php use_helper('I18N') ?>
<script type="text/javascript">
<!--
$(document).ready(function()
{
  var options = {
      target:        '#report_dialog_<?php echo $id_comment ?>',   // target element(s) to be updated with server response
      // beforeSubmit:  showCommentsList,  // pre-submit callback
      // success:       showCommentsList,  // post-submit callback

      // other available options:
      //url:       url         // override for form's 'action' attribute
      //type:      type        // 'get' or 'post', override for form's 'method' attribute
      //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
      clearForm: true,        // clear all form fields after successful submit
      resetForm: true        // reset the form after successful submit

      // $.ajax options can be used here too, for example:
      //timeout:   3000
  };
  // bind to the form's submit event
  $('#submit_comment_report_<?php echo $id_comment ?>').submit(function() {
      $(this).ajaxSubmit(options);
      return false;
  });
});
//-->
</script>
<div class="form-comment">
  <form id="submit_comment_report_<?php echo $id_comment ?>"  action="<?php echo url_for ('comment/formReportAjax') ?>" method="post" id="reportCommentAjax">
    <?php echo $formReport ?><br />
    <input type="submit" value="<?php echo __('send', array(), 'vjComment') ?>" class="submit" />
    <?php // include_partial("comment/formReport", array('form' => $formReport)) ?>
  </form>
</div>