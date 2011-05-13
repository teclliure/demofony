<?php use_helper('Date')?>
<?php slot('pageId') ?>id="ficha-taller"<?php end_slot() ?>
<?php slot('pageClass') ?>class="ficha"<?php end_slot() ?>
  <div class="bar-left">
    <div class="box">
      <div class="box-content show">
        <div class="box-title color2">
          <p><?php echo sfInflector::humanize(sfInflector::underscore(get_class($content->getRawValue()))) ?></p>
        </div>
        
        <div class="title">
          <h1><?php echo $content->getTitle()?></h1>
          <p class="author">
            <?php echo __('by') ?> <?php echo link_to($content->getSfGuardUser(),'user/showProfile?username='.$content->getSfGuardUser()->getUsername()) ?>, <?php echo format_date($content->getCreatedAt()) ?>
          </p>
          <p class="category">
            <?php echo __('Listed in')?> <?php include_partial ('content/categories',array('categories'=>$content->getCategories()))?>
          </p>
          <div class="clear"></div>
        </div>
        
        <div class="content">
          <div class="img"><img src="<?php echo $content->getImageSrcWithDefault('image','main') ?>" alt="<?php echo sfInflector::humanize(sfInflector::underscore(get_class($content->getRawValue()))) ?> image" /></div>
          <div class="text">
            <?php echo nl2br($content->getBody(),true)?>
          </div>
          <div class="clear"></div>
        </div>
        <?php if (is_subclass_of($content->getRawValue(),'Action')): ?>
        <div class="details">
          <div><?php echo __('Where') ?>: <strong><?php echo $content->getLocation() ?></strong></div>
          <div class="l"><?php echo __('Minimum participants') ?>: <strong><?php echo $content->getMinUsersAllowed() ?></strong></div>
          <div><?php echo __('When') ?>: <strong><?php echo format_date($content->getActionDate()) ?></strong></div>
          <div class="l"><?php echo __('Maximum participants') ?>: <strong><?php echo $content->getMaxUsersAllowed() ?></strong></div>
        </div>
        <?php endif; ?>
        
        <div class="clear"></div>
        
        <?php if (isset($map) && $map): ?>
        <div class="map-container">
          <?php $map->showMap(false)?>
        </div>
        <?php endif; ?>
        
        <div class="share">
          <!-- AddThis Button BEGIN -->
          <div class="addthis_toolbox addthis_default_style ">
          <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
          <a class="addthis_button_tweet"></a>
          </div>
          <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4da393350f4bddf1"></script>
          <!-- AddThis Button END -->
        </div>
        <br />
        <?php include_component('comment', 'commentBoxAjax', array('object' => $content)) ?>
        
        <div class="clear"></div>
        
        <?php // if(!$content->hasCountBox()): ?>
          <?php include_component('opinion', 'listSelected', array('object' => $content)) ?>
          <?php include_component('opinion', 'list', array('object' => $content)) ?>
        <?php // endif;?>
      </div>
    </div>
  </div>
    
  <div class="bar-right">
    <!-- Caja noticias -->
    <?php include_component('opinion', 'opinate', array('object' => $content)) ?>
    
    <?php if($content->hasJoinBox()): ?>
      <?php include_partial('content/join', array('object' => $content)) ?>
    <?php endif; ?>
  
    <?php if($content->hasGraphBox()): ?>
      <?php include_partial('opinion/graph', array('object' => $content)) ?>
    <?php endif; ?>
    
    <?php if($content->hasEditPerms($sf_user)): ?>
      <?php include_partial('content/editBox', array('object' => $content)) ?>
    <?php endif; ?>
    
    <?php // if($content->hasCountBox()): ?>
      <?php // include_partial('opinion/count', array('object' => $content)) ?>
    <?php // endif; ?>
  
    <?php if (isset($mapOpinions) && $mapOpinions): ?>
    <div class="box no-tabs comments-by-area">
      <div class="box-content show">
        <div class="box-title color2">
          <p><?php echo __('Opinions by area')?></p>
        </div>
        
        <?php if (!$mapOpinions->getManuallySetCenter()): ?>
          <?php $mapOpinions->showMap(true)?>
        <?php else: ?>
          <?php $mapOpinions->showMap(false)?>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
    
    <div class="box no-tabs related-inciatives">
      <div class="box-content show">
        <div class="box-title color2">
          <p><?php echo __('Related')?></p>
        </div>
        
        <?php $related = $content->getRelatedContent() ?>
        <?php foreach ($related as $subcontent): ?>
        <div class="item">
            <h1><?php echo link_to ($subcontent->getTitle(),$subcontent->getRawValue()->getUrl())?></h1>
            <p class="date"><?php echo format_date($subcontent->getCreatedAt()) ?></p>
        </div>
        <? endforeach; ?>
      </div>
    </div>
  </div>
