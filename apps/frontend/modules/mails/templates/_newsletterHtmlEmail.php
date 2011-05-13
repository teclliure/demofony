<?php use_helper('Date') ?>

<?php echo __('Hi') ?> <?php echo $user ?>,<br />

<?php foreach ($contents as $object): ?>
  <div class="title">
  <h1><?php echo __('Check full information in') ?> <?php echo link_to ($object->getTitle(),'content/show?class='.get_class($object->getRawValue()).'&slug='.$object->getSlug())?></h1>
  <p class="author">
    <?php echo __('by') ?> <?php echo link_to($object->getSfGuardUser(),'user/showProfile?username='.$object->getSfGuardUser()->getUsername()) ?>, <?php echo format_date($object->getCreatedAt()) ?>
  </p>
  <p class="category">
    <?php echo __('Listed in')?> <?php include_partial ('content/categories',array('categories'=>$object->getCategories()))?>
  </p>
  <div class="clear"></div>
</div>
<?php endforeach ?>