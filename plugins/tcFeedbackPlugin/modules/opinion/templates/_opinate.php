<?php use_helper('I18N', 'JavascriptBase') ?>
<script>
$(document).ready(function()
{
  var options = {
      target:        '#form_opinate_<?php echo get_class($object->getRawValue())?>_<?php echo $object->getId()?>',
      //beforeSubmit:  showCommentsList,  // pre-submit callback
      //success:       showCommentsList,  // post-submit callback
  };
  // bind to the form's submit event
  $('#submit_opinion_<?php echo get_class($object->getRawValue())?>_<?php echo $object->getId()?>_form').submit(function() {
      $(this).ajaxSubmit(options);
      return false;
  });
});
</script>
<div id="form_opinate_<?php echo get_class($object->getRawValue())?>_<?php echo $object->getId()?>" class="form-opinate">
<?php if($sf_user->isAuthenticated()): ?>
  <?php if($object->hasOpinated($sf_user->getGuardUser())):?>
    <div id="alreadyopinated"><?php echo __('You have already opinated:') ?><br />
    <h3><?php echo $object->getOpinion($sf_user->getGuardUser())?></h3>
    </div>
  <?php else: ?>
    <form id="submit_opinion_<?php echo get_class($object->getRawValue())?>_<?php echo $object->getId()?>_form" action="<?php echo url_for ('opinion/addOpinion?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>" method="post">
      <?php if($form->hasErrors()):?>
        <div class="error"><?php echo __('Error in opinion')?></div>
      <?php endif; ?>
      <?php echo $form ?><br />
      <input type="submit" value="<?php echo __('send') ?>" class="submit" />
    </form>
  <?php endif; ?>
<?php else: ?>
  <div id="notlogged"><?php echo __('Please log in to opinate') ?></div>
<?php endif ?>
</div>