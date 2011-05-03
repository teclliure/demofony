<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php slot('pageId') ?>id="form-taller"<?php end_slot() ?>
<form action="<?php echo url_for ('@contentAdd?class='.$class) ?>" class="form" method="post">
<div class="bar-left">
  <div class="box no-tabs no-margin">
    <div class="box-content show">
      <div class="box-title color1">
        <p><?php echo __('Add your') ?> <?php echo sfInflector::humanize(sfInflector::underscore($class)) ?></p>
      </div>
      <?php echo $form['title']->renderRow(array('class'=>'wide')) ?>
      <?php echo $form['body']->renderRow(array('class'=>'wide')) ?>
      <?php if (isset($form['tip'])) echo $form['tip']->renderRow(array('class'=>'wide')) ?>
    </div>
  </div>
</div>

<div class="bar-right">
  <div class="box no-tabs no-margin">
    <div class="box-content show">
      <div class="box-title color1">
        <p><?php echo __('Inlcude a photo or a video') ?></p>
      </div>
      
      <?php echo $form['image']->renderRow() ?>
      <?php echo $form['video']->renderRow() ?>
      
      <button type="submit" class="button1"><?php echo __('Send')?></button>
    </div>
  </div>
</div>


<div class="clear"></div>

<div class="note">
  <?php echo __('Esta propuesta será filtrada antes de su publicación. En caso de incluir insultos, vejaciones o contenido que consideremos inapropiado no será publicada. Para más información visita las') ?> <a href="<?php echo ('static?page=use_conditions') ?>"><?php echo __('Use conditions') ?></a>
</div>

</form>




