<?php use_helper('I18N', 'JavascriptBase') ?>
<div id="opinion_form">
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
  <div id="form_opinate_<?php echo get_class($object->getRawValue())?>_<?php echo $object->getId()?>" class="form-opinate box color1 no-tabs sign">
    <span class="icon-box-arrow"></span>
    <div class="box-content show">
    <div class="hdr"><span class="icon-ficha_accion_header"></span><strong><?php echo __('Participate') ?></strong></div>
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
          <button type="submit" class="button1"><?php echo __('Send') ?></button>
        </form>
      <?php endif; ?>
    <?php else: ?>
      <?php echo link_to(__('Register'),'@register',array('class'=>"button1")) ?>
      <div id="notlogged"><?php echo __('Please log in to opinate') ?></div>
    <?php endif ?>
    </div>
  </div>
</div>