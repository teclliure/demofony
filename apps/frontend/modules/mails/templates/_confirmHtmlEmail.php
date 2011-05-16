<?php use_helper('Date') ?>
<div class="box-title color2">
  <p><?php echo __('Remember to participe on') ?> <?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($object->getRawValue())))) ?></p>
  <h2><?php echo __('Date') ?>: <?php echo format_date($object->getActionDate()) ?></h2>
  <h2><?php echo __('Location') ?>: <?php echo $object->getLocation() ?></h2>
</div>

<div class="title">
  <h1><?php echo __('Check full information in') ?> <?php echo link_to ($object->getTitle(),$object->getRawValue()->getUrl())?></h1>
  <p class="author">
    <?php echo __('by') ?> <?php echo link_to($object->getSfGuardUser(),'user/showProfile?username='.$object->getSfGuardUser()->getUsername()) ?>, <?php echo format_date($object->getCreatedAt()) ?>
  </p>
  <p class="category">
    <?php echo __('Listed in')?> <?php include_partial ('content/categories',array('categories'=>$object->getCategories()))?>
  </p>
  <div class="clear"></div>
</div>

