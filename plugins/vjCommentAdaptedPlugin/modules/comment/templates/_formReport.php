<?php use_helper('I18N') ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/form.min.css") ?>
<?php use_stylesheet("/vjCommentAdaptedPlugin/css/reportComment.min.css") ?>
<div class="form-comment">
  <form action="" method="post" id="reportComment">
  <fieldset>
    <legend><?php echo __('Report a comment', array(), 'vjComment') ?></legend>
    <?php include_partial("comment/form", array('form' => $form)) ?>
  </fieldset>
  </form>
</div>