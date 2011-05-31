<?php use_helper('I18N'); ?>
<?php foreach($breadcrumbs as $key => $breadcrumb): ?>
  <?php if($breadcrumb['url'] != null): ?>
    <?php echo link_to(__($breadcrumb['name']), $breadcrumb['url']) ?>
  <?php else: ?>
    <?php echo __($breadcrumb['name']) ?>
  <?php endif ?>
  <?php if($key < count($breadcrumbs)-1): ?> <?php echo $sf_data->getRaw('separator') ?> <?php endif ?>
<?php endforeach ?>