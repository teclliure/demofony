<?php use_helper ('Date') ?>
<div class="new_wrapper <?php echo strtolower(get_class($new)) ?> span-8 last" style="margin-bottom: 1em;">
  <div class="span-3">
    <a href="<?php echo url_for ('content/show?slug='.$new->getSlug())?>"><img src="<?php echo $new->getImageSrcWithDefault('image', 'thumb')?>" alt="new_image" /></a>
  </div>
  <div class="span-5 last">
    <h3><?php echo link_to ($new->getTitle(),'content/show?slug='.$new->getSlug())?></h3>
    <?php echo __('on')?> <?php echo format_date($new->getPublishDate()) ?>
  </div>
</div>