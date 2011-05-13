<?php use_helper('I18N') ?>

<?php include_stylesheets_for_form($form->getCurrentForm()) ?>
<?php include_javascripts_for_form($form->getCurrentForm()) ?>

<form action="<?php echo url_for('@register') ?>?step=<?php echo $form->getCurrentPageNumber() + 1 ?>" <?php $form->getCurrentForm()->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="form" method="post" id="form-profile">
    <?php if (get_class($form->getCurrentForm()) == 'ProfileForm'): ?>
      <?php echo get_partial('user/profileForm', array('form' => $form->getCurrentForm(),'hide_unsubscribe'=>true)) ?>
      <?php if($form->getCurrentPageNumber() > 1): ?>
          <!-- navigation doesn't work with post persistance strategy -->
          <br />
          <a class="button1" href="<?php echo url_for('@register') ?>?step=<?php echo $form->getCurrentPageNumber() ?>">< <?php echo __('Back') ?></a>
      <?php endif; ?>
    <?php else: ?>
    <div class="box no-tabs no-margin">
      <div class="box-content show">
        <div class="box-title">
          <p><?php echo __('Register', null, 'sf_guard') ?></p>
        </div>
        <?php echo $form ->getCurrentForm()?>
        <div class="clear"></div>
        <button class="button1" type="submit"><?php echo __('Send') ?></button>
      </div>
    </div>
    <?php endif; ?>
</form>