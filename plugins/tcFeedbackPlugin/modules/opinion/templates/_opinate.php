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
  
  <div id="form_opinate_<?php echo get_class($object->getRawValue())?>_<?php echo $object->getId()?>" class="form-opinate box color1 no-tabs participate">
    <span class="icon-box-arrow"></span>
    
    <div class="box-content show">
      <?php if ($object->getResponse()): ?>
        <div class="hdr"><span class="icon-ficha_accion_header"></span><strong><?php echo __('Closed') ?></strong></div>
        <div class="clear"></div><br />
      <?php else: ?>
        <div class="hdr"><span class="icon-ficha_accion_header"></span><strong><?php echo __('Participate') ?></strong></div>
        <?php if($object->hasJoinBox()): ?>
          <?php include_partial('content/joinButton', array('object' => $object)) ?>
        <?php endif; ?>
        <?php if($sf_user->isAuthenticated()): ?>
          <?php if($object->hasOpinated($sf_user->getGuardUser())):?>
            <div id="alreadyopinated"><?php echo __('You have already opinated') ?>:<br />
            <h3><?php echo $object->getOpinion($sf_user->getGuardUser())?></h3>
            </div>
          <?php else: ?>
            
            <?php if (get_class($object->getRawValue()) == 'GovermentConsultation'): ?>
            <p><?php echo __('Express your opinion !') ?></p>
            <?php else: ?>
            <p><?php echo __('What do you think about') ?> <?php echo __('this '.sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?> ?</p>
            <?php endif; ?>
            
            <form id="submit_opinion_<?php echo get_class($object->getRawValue())?>_<?php echo $object->getId()?>_form" action="<?php echo url_for ('opinion/addOpinion?class='.get_class($object->getRawValue()).'&id='.$object->getId()) ?>" method="post">
              <?php if($form->hasErrors()):?>
                <div class="msg error"><?php echo __('Error in opinion')?></div>
              <?php endif; ?>
              <?php // echo $form?>
              <?php if (isset($form['opinion_possibility_id'])): ?>
                <?php  echo $form['opinion_possibility_id']->renderError() ?>
                <?php  echo $form['opinion_possibility_id']->render(array('onClick'=>'$(\'#opinion_textarea\').show(\'slow\');')) ?>
              <?php endif; ?>
              <?php if (isset($form['opinion'])): ?>
              <div id="opinion_textarea" <?php if (isset($form['opinion_possibility_id'])): ?>style="display: none"<?php endif; ?>>
                <?php echo $form['opinion']->renderError() ?>
                <?php echo $form['opinion']->render() ?>
                <div id="charCount">0 <?php echo __('of 250 characters used') ?></div>
                <script>
                // controls character input/counter
                $('#opinion_textarea textarea').keyup(function() {
                var charLength = $(this).val().length;
                // Displays count
                $('#charCount').html(charLength + ' <?php echo __('of 250 characters used') ?>');
                // Alerts when 250 characters is reached
                if($(this).val().length > 250) {
                  text = $(this).val();
                  $(this).val(text.substr(0,250));
                  $('#charCount').html('<strong><?php echo __('You may only have up to 250 characters.') ?></strong>');
                  }
                });
                </script>
                <button type="submit" class="button1"><?php echo __('Send') ?></button>
              </div>
              <?php else: ?>
                <button type="submit" class="button1"><?php echo __('Send') ?></button>
              <?php endif; ?>
              <?php echo $form->renderHiddenFields() ?>
            </form>
          <?php endif; ?>
        <?php else: ?>
          <?php echo link_to(__('Register'),'@register',array('class'=>"button1 login_opener")) ?>
          <!-- <div id="notlogged"><?php echo __('Please log in to opinate') ?></div> -->
        <?php endif ?>
        <?php if ($form->getGroup() && $form->getGroup()->getShowStats()): ?>
        <div class="stats">
          <?php $possibilities = $form->getPossibilities() ?>
          <?php foreach ($possibilities as $possibility): ?>
            <strong><span class="inline <?php echo $possibility->getIcon() ?>"></span> <?php echo $object->countNumPossibilitiesAdded($possibility) ?></strong>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>