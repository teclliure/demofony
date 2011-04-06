<?php use_helper ('Date') ?>
<div class="content_wrapper span-15 last <?php echo strtolower(get_class($content)) ?>" style="margin-bottom: 1em;">
  <div class="span-14">
    <div class="span-3">
      <a href="<?php echo url_for ('content/show?slug='.$content->getSlug())?>"><img src="<?php echo $content->getSfGuardUser()->getProfile()->getImageSrcWithDefault('image', 'thumb')?>" alt="profile_image" /></a>
    </div>
    <div class="span-11 last">
      <h4><?php echo link_to ($content->getTitle(),'content/show?slug='.$content->getSlug())?></h4>
      <?php echo __('by') ?> <?php echo link_to($content->getSfGuardUser(),'user/showProfile?username='.$content->getSfGuardUser()->getUsername()) ?> <?php echo __('on')?> <?php echo format_date($content->getCreatedAt()) ?> <?php echo __('in')?> <?php echo __('categories') ?>
    </div>
  </div>
  <div class="span-1 last">
    <div class="post_type">
      <?php echo image_tag(strtolower(get_class($content)).'.png')?>
    </div>
    <div class="comment_count">
    0
    </div>
  </div>
</div>