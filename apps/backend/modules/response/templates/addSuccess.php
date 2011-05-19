<?php use_helper('I18N')?>
<?php use_stylesheet('/adminThemejRoller2Plugin/css/jroller2.css') ?>

<?php // additionnal stylesheet (filament group)
  use_stylesheet('/adminThemejRoller2Plugin/css/fg.menu.css');
  use_stylesheet('/adminThemejRoller2Plugin/css/fg.buttons.css');
  use_stylesheet('/adminThemejRoller2Plugin/css/ui.selectmenu.css');
?>

<?php // additionnal javascript (filament group)
  use_javascript('/adminThemejRoller2Plugin/js/fg.menu.js');
  use_javascript('/adminThemejRoller2Plugin/js/jroller2.js');
  use_javascript('/adminThemejRoller2Plugin/js/ui.selectmenu.js');
?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php if ($content->getResponse()) echo __('Edit response'); else echo __('Add response'); ?> <?php echo __('to')?> "<?php echo $content ?>"</h1>
  </div>
  <form action="<?php if (!$content->getResponse()) echo url_for ('response/add?id='.$content->getId().'&class='.get_class($content->getRawValue())); else echo url_for ('response/edit?id='.$content->getId().'&class='.get_class($content->getRawValue())) ?>" class="form" method="post" >
  <br />
  <ul class="sf_admin_actions_form">
    <?php if ($content->getResponse()): ?>
    <li class="sf_admin_action_delete">
      <a href="<?php echo url_for('response/delete?id='.$content->getId().'&class='.get_class($content->getRawValue())) ?>" onclick="if (confirm('<?php echo __('Are you sure?') ?>')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'sf_method'); m.setAttribute('value', 'delete'); f.appendChild(m);var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_csrf_token'); m.setAttribute('value', '998c9c0942f5c3a32262a805479c1f2e'); f.appendChild(m);f.submit(); };return false;" class="fg-button ui-state-default fg-button-icon-left ui-priority-secondary"><span class="ui-icon ui-icon-trash"></span><?php echo __('Delete') ?></a>
    </li>
    <?php endif; ?>
    <li class="sf_admin_action_save">
      <button class="fg-button ui-state-default fg-button-icon-left" type="submit"><span class="ui-icon ui-icon-circle-check"></span><?php echo __('Save')?></button>
    </li>
  </ul>
  <div class="response" style="margin: 30px">
    <?php echo $form->renderGlobalErrors() ?>
    <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_body">
      <div class="label ui-helper-clearfix">
      <?php echo $form['body']->renderLabel() ?>
      </div>
      <?php echo $form['body']->renderError() ?>
      <?php echo $form['body'] ?>
    </div>
    <?php echo $form->renderHiddenFields() ?>
  </div>
  <ul class="sf_admin_actions_form">
    <?php if ($content->getResponse()): ?>
    <li class="sf_admin_action_delete">
      <a href="<?php echo url_for('response/delete?id='.$content->getId().'&class='.get_class($content->getRawValue())) ?>" onclick="if (confirm('<?php echo __('Are you sure?') ?>')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'sf_method'); m.setAttribute('value', 'delete'); f.appendChild(m);var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_csrf_token'); m.setAttribute('value', '998c9c0942f5c3a32262a805479c1f2e'); f.appendChild(m);f.submit(); };return false;" class="fg-button ui-state-default fg-button-icon-left ui-priority-secondary"><span class="ui-icon ui-icon-trash"></span><?php echo __('Delete') ?></a>
    </li>
    <?php endif; ?>
    <li class="sf_admin_action_save">
      <button class="fg-button ui-state-default fg-button-icon-left" type="submit"><span class="ui-icon ui-icon-circle-check"></span><?php echo __('Save')?></button>
    </li>
  </ul>
  <br />
  <div class="clear"></div>
  <br />
  </form>
</div>