<?php use_helper ('Date') ?>
<div class="letter icon-letter-<?php echo $content->getLetter() ?>"><?php echo strtoupper($content->getSymbol()) ?></div>
<div class="img"><img src="<?php echo $content->getSfGuardUser()->getProfile()->getImageSrcWithDefault('image', 'thumb')?>" alt="profile_image" /></div>
<h1><?php echo link_to ($content->getTitle(),$content->getRawValue()->getUrl())?></h1>
<p class="author"><?php echo ('by')?> <?php echo link_to($content->getSfGuardUser(),'user/showProfile?username='.$content->getSfGuardUser()->getUsername()) ?></p>

<p class="date"><?php echo __('on')?> <?php echo format_date($content->getCreatedAt()) ?> <?php echo __('in')?> <?php include_partial ('content/categories',array('categories'=>$content->getCategories()))?></p>
<div class="comments"><span class="misc misc-comments inline"></span><?php echo $content->getNbComments() ?> | <span class="icon-opinions inline"></span><?php echo $content->countOpinions() ?></div>
<div class="clear"></div>
