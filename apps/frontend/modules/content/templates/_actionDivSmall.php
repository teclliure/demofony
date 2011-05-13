<?php use_helper ('Date') ?>
<span class="icon icon-pin_<?php echo $action->getColor() ?>"></span>
<div class="col1">
    <div class="img"></div>
    <div class="img"><img src="<?php echo $action->getSfGuardUser()->getProfile()->getImageSrcWithDefault('image', 'thumb')?>" alt="profile_image" /></div>
    <h1><?php echo link_to ($action->getTitle(),$action->getRawValue()->getUrl())?></h1>
    <p class="author"><?php echo ('by')?> <?php echo link_to($action->getSfGuardUser(),'user/showProfile?username='.$action->getSfGuardUser()->getUsername()) ?></p>
    <p class="date"><?php echo __('on')?> <?php echo format_date($action->getCreatedAt()) ?> <?php echo __('in')?> <?php include_partial ('content/categories',array('categories'=>$action->getCategories()))?></p>
</div>

<div class="col2">
    <p><strong><?php echo __('Location')?>:</strong> <?php echo $action->getLocation() ?></p>
    <p><strong><?php echo __('Date')?>:</strong> <?php echo format_date($action->getActionDate()) ?></p>
    <p class="estat"><strong><?php echo __('Status')?>:</strong> Trobada abierta <span class="misc misc-<?php if($action->isOpened()): ?>unlock<?php else: ?>lock<?php endif;?> inline"></span></p>
</div>
<div class="col3">
    <p><strong><?php echo __('Participants') ?>:</strong></p>
    <p><strong>Min:</strong> <?php echo $action->getMinUsersAllowed() ?></p>
    <?php if($action->getMaxUsersAllowed()): ?><p><strong>Max:</strong> <?php echo $action->getMaxUsersAllowed() ?></p><?php endif; ?>
</div>
<div class="col4">
  <a href="<?php echo url_for($action->getRawValue()->getUrl()) ?>" class="button1 enter"><?php echo __('Enter')?></a>
</div>
<div class="clear"></div>
