<table summary="">
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