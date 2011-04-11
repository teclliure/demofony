<?php use_helper('I18N') ?>
<div class="form-comment">
  <?php if($formReport->hasErrors()):?>
    <div class="error"><?php echo __('Error in form report as inadecuate')?></div>
  <?php endif; ?>
  <form id="submit_comment_report_<?php echo $id_comment ?>" action="<?php echo url_for ('comment/formReportAjax?id_comment='.$id_comment) ?>" method="post">
    <?php echo $formReport ?><br />
    <input type="submit" value="<?php echo __('send', array(), 'vjComment') ?>" class="submit" />
  </form>
</div>