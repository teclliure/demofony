<?php use_helper ('Date') ?>
<div class="item">
  <div class="img"><img src="<?php echo $new->getImageSrcWithDefault('image', 'thumb')?>" alt="new_image" /></div>
  <h1><?php echo link_to ($new->getTitle(),$new->getRawValue()->getUrl())?></h1>
  <p class="date"><?php __('on') ?> <?php echo format_date($new->getCreatedAt()) ?></p>
  <div class="clear"></div>
</div>
