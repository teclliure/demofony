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
          <div class="img"></div>
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
        
        <div class="map-container">
          <div class="map"></div>
        </div>
        
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
        
        
        <?php include_component('opinion', 'listSelected', array('object' => $content)) ?>
        
        <?php include_component('opinion', 'list', array('object' => $content)) ?>
      </div>
    </div>
  </div>
    
  <div class="bar-right">
    <!-- Caja noticias -->
    <?php include_component('opinion', 'opinate', array('object' => $content)) ?>
  
    <div class="box no-tabs">
      <div class="box-content show">
      
        (jquery plugin)
      
      </div>
    </div>
  
    <div class="box no-tabs comments-by-area">
      <div class="box-content show">
        <div class="box-title color2">
          <p><?php echo __('Opinions by area')?></p>
        </div>
        <div class="map"></div>
      </div>
    </div>
    
    <div class="box no-tabs related-inciatives">
      <div class="box-content show">
        <div class="box-title color2">
          <p><?php echo __('Related')?></p>
        </div>
        
        <?php $related = $content->getRelatedContent() ?>
        <?php foreach ($related as $subcontent): ?>
        <div class="item">
            <h1><?php echo link_to ($subcontent->getTitle(),'content/show?class='.get_class($subcontent->getRawValue()).'&slug='.$subcontent->getSlug())?></h1>
            <p class="date"><?php echo format_date($subcontent->getCreatedAt()) ?></p>
        </div>
        <? endforeach; ?>
      </div>
    </div>
  </div>