<?php use_helper('I18N') ?>

<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@profile') ?>" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> method="post">
    <?php echo $form ?>
    <input type="submit" value="<?php echo __('Send') ?>" />
</form>