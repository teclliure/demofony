<?php $form->getWidgetSchema()->getFormFormatter()->setRowFormat("%error%%field%%help%%hidden_fields%"); ?>
<form action="<?=url_for('language/changeLanguage')?>" id="language_form" name="language_form">
	<?php echo $form->render(); ?>
</form>
<script type="text/javascript">
    $("#language").change(function() {
		document.forms["language_form"].submit();
        return true;
    });
</script>