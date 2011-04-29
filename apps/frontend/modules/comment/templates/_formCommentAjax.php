<?php use_helper('I18N', 'JavascriptBase') ?>
<script>
$(document).ready(function()
{
  var options = {
      target:        '#view_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>',   // target element(s) to be updated with server response
      // beforeSubmit:  showCommentsList,  // pre-submit callback
      success:       showCommentsList,  // post-submit callback

      // other available options:
      //url:       url         // override for form's 'action' attribute
      //type:      type        // 'get' or 'post', override for form's 'method' attribute
      //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
      clearForm: true        // clear all form fields after successful submit
      //resetForm: true        // reset the form after successful submit

      // $.ajax options can be used here too, for example:
      //timeout:   3000
  };
  // bind to the form's submit event
  $('#submit_comment_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>_form').submit(function() {
      $(this).ajaxSubmit(options);
      return false;
  });

  function showCommentsList(responseText, statusText, xhr, $form) {
    $('#form_comment_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>').fadeOut('slow');
    $('#view_comments_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>').show();
  }
  $('tr.tr_reply_author,tr.tr_reply_author_delete').hide();
});
</script>
<div class="form-comment">
<?php if(vjComment::checkAccessToForm($sf_user) ): ?>
  <form id="submit_comment_<?php echo get_class($object->getRawValue()) ?>_<?php echo $object->getId() ?>_form" action="<?php echo url_for('comment/formCommentAjax?record_model='.get_class($object->getRawValue()).'&record_id='.$object->getId()) ?>" method="post" name="<?php echo $form->getName() ?>">
    <table>
    <?php foreach($form as $id => $f): ?>
      <?php if($id == "reply_author" && $f->getValue()!= ""): ?>
        <?php use_stylesheet("/vjCommentAdaptedPlugin/css/replyTo.min.css", "last") ?>
      <?php endif ?>
      <?php if(!$f->isHidden()): ?>
        <?php if(!$f->hasError()): ?>
          <?php $attributes = array() ?>
        <?php else: ?>
          <?php $attributes = array('class' => 'error') ?>
          <tr>
            <td></td>
            <td><?php echo $f->renderError() ?></td>
          </tr>
        <?php endif ?>
        <tr id="tr_<?php echo $id."_".$form->getName() ?>" class="tr_<?php echo $id ?>">
          <th>
            <?php echo $f->renderLabel(null, $attributes) ?>
          </th>
          <td>
            <?php echo $f->render($attributes) ?>
            <span class="help"><?php echo $f->renderHelp() ?></span>
          </td>
        </tr>
        <?php if($id == "reply_author"): ?>
        <tr id="tr_reply_author_delete_<?php echo $form->getName() ?>" class="tr_reply_author_delete">
          <td colspan="2"><?php echo link_to_function(__("Delete the reply", array(), 'vjComment'), "deleteReply('".$form->getName()."')", array('class' => 'delete_reply'))."\n" ?></td>
        </tr>
        <?php endif ?>
      <?php endif ?>
    <?php endforeach ?>
        <tr>
          <td colspan="2" class="submit">
          <?php echo $form->renderHiddenFields() ?>
          <input type="submit" value="<?php echo __('send', array(), 'vjComment') ?>" class="submit" />
          </td>
        </tr>
      </table>
  </form>
<?php else: ?>
  <div id="notlogged"><?php echo __('Please log in to comment', array(), 'vjComment') ?></div>
<?php endif ?>
</div>