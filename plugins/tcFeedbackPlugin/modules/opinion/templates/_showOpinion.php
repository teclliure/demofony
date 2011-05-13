<?php use_helper('Date')?>
<div class="comment <?php if(isset($selected) && $selected): ?>selected<?php endif; ?>">
    <?php if(isset($extended) && $extended): ?>
    <h1><?php echo link_to ($object->getTitle(),'content/show?class='.get_class($object->getRawValue()).'&slug='.$object->getSlug())?></h1>
    <p class="info">
        <?php echo __('Proposed by')?> <?php echo link_to($object->getSfGuardUser(),'user/showProfile?username='.$object->getSfGuardUser()->getUsername()) ?> <?php echo __('on')?> <?php echo format_date($object->getCreatedAt()) ?>
    </p>
    <?php endif; ?>
    <div class="content">
      <div class="left">
          <h2><?php echo $opinion->getSfGuardUser() ?></h2>
          <p class="date"><?php echo format_date($opinion->getCreatedAt()) ?></p>
          <p class="opinion"><?echo __('Opinate') ?> <strong><?php echo __($opinion->__toString()) ?></strong></p>
      </div>
      <div class="right">
          <div class="text">
            <?php echo $opinion->getOpinion() ?>
          </div>
          <div class="footer">
            <?php if ($sf_user->isAuthenticated() && !$object->hasOpinated($sf_user->getGuardUser())): ?>
              <a href="#" class="opino button1" onClick="$('#opinions_list').load('<?php echo url_for('opinion/opinateLike?id='.$opinion->getId()) ?>'); return false;"><?php echo __('I think like') ?></a>
            <?php endif; ?>
            <div class="stats">
                <strong><?php echo $opinion->countOpinionsLike() ?> <span class="inline icon-thumb-up"></span></strong>
                <a href="#" onClick="$('#view_comments_Opinion_<?php echo $opinion->getId() ?>').fadeToggle('slow'); return false;"><span id="number_view_comments_Opinion_<?php echo $opinion->getId() ?>"><strong><?php echo $opinion->getNbComments() ?></strong></span> <span class="inline misc misc-comments"></span></a>
                <strong>
                <?php if ($sf_user->isAuthenticated() && !$opinion->hasMarkedAsSpam($sf_user->getGuardUser())): ?>
                  <a href="#" title="<?php echo __('Report as innadecuate') ?>" onClick="$('#opinions_list').load('<?php echo url_for('opinion/markAsSpam?id='.$opinion->getId()) ?>'); return false; "><span class="inline icon-banned"></span></a>
                <?php endif; ?>
                </strong>
            </div>
          </div>
      </div>
      <div class="clear"></div>
      <span class="icon-quote2 quote quote-left"></span>
      <span class="icon-quote1 quote quote-right"></span>
    </div>
</div>
<?php include_component('comment', 'showListHtml', array('object' => $opinion)) ?>