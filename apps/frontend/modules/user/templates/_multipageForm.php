<?php use_helper('I18N') ?>

<?php include_stylesheets_for_form($form->getCurrentForm()) ?>
<?php include_javascripts_for_form($form->getCurrentForm()) ?>

<form action="<?php echo url_for('@register') ?>?step=<?php echo $form->getCurrentPageNumber() + 1 ?>" <?php $form->getCurrentForm()->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="form" method="post">
    <?php echo $form->getCurrentForm() ?>
    <?php if($form->getCurrentPageNumber() > 1): ?>
        <!-- navigation doesn't work with post persistance strategy -->
        <a class="button1" href="<?php echo url_for('@register') ?>?step=<?php echo $form->getCurrentPageNumber() ?>">< <?php echo __('Back') ?></a>
    <?php endif; ?>
    <button class="button1" type="submit"><?php echo __('Send') ?></button>
</form>