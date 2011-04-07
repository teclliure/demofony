<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<h3><?php echo __('Adding') ?> <?php sfInflector::humanize(sfInflector::underscore($class)) ?></h3>
<form action="<?php echo url_for ('@contentAdd?class='.$class) ?>" method="post">
<?php echo $form ?>
<div class="form_row">
  <center><input type="submit" value="<?php echo __('Add content')?>"></center>
</div>
</form>
