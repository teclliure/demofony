<?php use_helper('Date')?>
<div class="span-15 append-1">
  <div id="show_full_content" class="ui-widget-content ui-corner-all">
    <div class="span-15 last">
      <h4><?php echo sfInflector::humanize(sfInflector::underscore(get_class($content->getRawValue()))) ?></h4>
      <h3><?php echo $content->getTitle()?></h3>
    </div>
    <div id="content-info" class="top-border bottom-border span-15 last">
      <div class="span-2">
        <?php echo format_date($content->getCreatedAt()) ?>
      </div>
      <div class="span-7 prepend-3">
        <?php echo __('by') ?> <?php echo link_to($content->getSfGuardUser(),'user/showProfile?username='.$content->getSfGuardUser()->getUsername()) ?>
      </div>
      <div class="span-3 last">
        <?php echo __('in')?> <?php echo __('categories') ?>
      </div>
    </div>
    <div class="span-15 last">
      <?php echo nl2br($content->getBody(),true)?>
    </div>
    <div class="clear">&nbsp;</div>
  </div>
</div>

<div id="sidebar_right" class="span-8 last" style="margin-bottom: 1em;">
  <div class="span-8 last" style="background: #eeeeee; margin-bottom: 1em">
    Opinate
  </div>
  <div class="span-8 last" style="background: #eeeeee">
    Opinions locations
  </div>
  <div class="span-8 last" style="background: #eeeeee">
    More on this categori
  </div>
</div>

<div id="comments" class="span-15 append-1">
  <?php include_component('comment', 'commentBoxAjax', array('object' => $content)) ?>
</div>