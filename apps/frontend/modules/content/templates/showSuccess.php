<?php use_helper('Date')?>
<?php slot('pageId') ?>id="ficha-taller"<?php end_slot() ?>
<?php slot('pageClass') ?>class="ficha"<?php end_slot() ?>
  <div class="bar-left">
    <div class="box">
      <div class="box-content show">
        <div class="box-title color2">
          <p><?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($content->getRawValue())))) ?></p>
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
        
        <?php if ($content->getResponse()): ?>
          <script type="text/javascript">
          $(function() {
            $("#response_tabs").tabs();
          });
          </script>
          <div id="response_tabs" class="box has_tabs">
          <ul>
            <li><a href="#response_tab"><?php echo __('Goverment response') ?></a></li>
            <li><a href="#opinions_tab"><?php echo __('Opinions') ?></a></li>
          </ul>
          <div id="response_tab" class="gobern-response">
            <div class="box-title"><span class="inline icon-ayunt"></span><p><?php echo __('Goverment response') ?></p></div>
            <?php echo $content->getResponse()->getBody() ?>
          </div>
          <div id="opinions_tab">
        <?php endif; ?>
        
          <?php // if(!$content->hasCountBox()): ?>
            <?php include_component('opinion', 'listSelected', array('object' => $content)) ?>
            <?php include_component('opinion', 'list', array('object' => $content)) ?>
          <?php // endif;?>
        
        <?php if ($content->getResponse()): ?>
          </div>
        </div>
        <?php endif; ?>
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
    
    <?php if ($content->getVideo() && $content->getVideoId()): ?>
    <div class="box no-tabs comments-by-area">
      <div class="box-content show">
        <div class="box-title color2">
          <p><?php echo __('Video')?></p>
        </div>
        
        <?php use_javascript('/jquery/jyoutube/jyoutube.min.js')?>
        <?php use_javascript('/jquery/jyoutube/jquery.youtubepopup.min.js')?>
        <script type="text/javascript">
        $(document).ready(function(){
          imgUrl = $.jYoutube('<?php echo $content->getVideoId() ?>', 'small');
          //alert(imgUrl);
          // Now append this image to <div id="thumbs">
          $('#video_thumbs').html('<a class="youtube" href="#" rel="<?php echo $content->getVideoId() ?>" title="<?php echo __('YouTube Video') ?>"><img class="youtube" src="'+imgUrl+'" alt="<?php echo __('YouTube Video') ?>" /></a>');
          $("a.youtube").YouTubePopup();
        });
        </script>
        <div id="video_thumbs" style="text-align: center"></div>
      </div>
    </div>
    <?php endif; ?>
  
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
