<?php use_helper('I18N', 'Date') ?>
<?php include_partial('opinion_possibility/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Edit Opinion possibility', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('opinion_possibility/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('opinion_possibility/form_header', array('opinion_possibility' => $opinion_possibility, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('opinion_possibility/form', array('opinion_possibility' => $opinion_possibility, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('opinion_possibility/form_footer', array('opinion_possibility' => $opinion_possibility, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
