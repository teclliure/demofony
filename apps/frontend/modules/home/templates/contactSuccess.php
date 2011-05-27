<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div class="box no-tabs no-margin">
  <div class="box-content show">

    <div class="box-title">
      <p><?php echo __('Contact') ?></p>
    </div>
    
    <div class="">
    <form action="<?php echo url_for ('home/contact');?>"  <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="form" method="post" >
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form['name']->renderRow(array('class'=>'wide')) ?>
      <?php echo $form['email']->renderRow(array('class'=>'wide')) ?>
      <?php echo $form['message']->renderRow(array('class'=>'wide')) ?>
      <?php echo $form->renderHiddenFields() ?>
      <button class="button1" type="submit"><?php echo __('Send') ?></button>
    </form>
    </div>
    
  </div>
</div>

