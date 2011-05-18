  <?php use_helper('Date')?>
  <?php $results = $pager->getResults() ?>
  <?php if ($results): ?>
    <? foreach($results as $i=>$result): ?>
      <?php if (is_subclass_of($result->getRawValue(),'Action')): ?>
      <?php $result->refresh(true) ?>
      <?php // echo $result->getState() ?>
      <div class="result <?= $i%2? '' : 'color' ?>">
        <div class="icon-pin_<?php echo $result->getColor() ?> letter"></div>
        <div class="img"></div>
        <h1><?php echo link_to ($result->getTitle(),$result->getRawValue()->getUrl())?></h1>
        <p class="author"><?php echo ('by')?> <?php echo link_to($result->getSfGuardUser(),'user/showProfile?username='.$result->getSfGuardUser()->getUsername()) ?>, <?php echo __('on')?> <?php echo format_date($result->getCreatedAt()) ?> <?php echo __('in')?> <?php include_partial ('content/categories',array('categories'=>$result->getCategories()))?></p>
        <div class="col1">
            <p><strong><?php echo __('Location')?>:</strong> <?php echo $result->getLocation() ?></p>
            <p><strong><?php echo __('Date')?>:</strong> <?php echo format_date($result->getActionDate()) ?></p>
            <p class="estat"><strong><?php echo __('Status')?>:</strong> <?php echo $result->getState() ?> <span class="misc misc-<?php if($result->isOpened()): ?>unlock<?php else: ?>lock<?php endif;?> inline"></span></p>
        </div>
        <div class="col2">
            <p><strong><?php echo __('Participants') ?>:</strong></p>
            <p><strong>Min:</strong> <?php echo $result->getMinUsersAllowed() ?></p>
            <?php if($result->getMaxUsersAllowed()): ?><p><strong>Max:</strong> <?php echo $result->getMaxUsersAllowed() ?></p><?php endif; ?>
        </div>
        <div class="col3">
          <a href="<?php echo url_for($result->getRawValue()->getUrl()) ?>" class="button1 enter"><?php echo __('Enter')?></a>
        </div>
        <div class="comments"><span class="misc misc-comments inline"></span><?php echo $result->getNbComments() ?> <br /> <span class="icon-opinions inline"></span><?php echo $result->countOpinions() ?></div>
        <div class="clear"></div>
      </div>
      <?php else: ?>
      <div class="result <?= $i%2? '' : 'color' ?>">
        <?php if (get_class($result->getRawValue()) == 'GovermentNew'): ?>
        <div class="letter icon-__news"></div>
        <?php else: ?>
        <div class="letter icon-letter-<?php echo $result->getLetter() ?>"><?php echo strtoupper($result->getSymbol()) ?></div>
        <?php endif; ?>
        <div class="img"></div>
        <h1><?php echo link_to ($result->getTitle(),$result->getRawValue()->getUrl())?></h1>
        <p class="author"><?php echo ('by')?> <?php echo link_to($result->getSfGuardUser(),'user/showProfile?username='.$result->getSfGuardUser()->getUsername()) ?>, <?php echo __('on')?> <?php echo format_date($result->getCreatedAt()) ?> <?php echo __('in')?> <?php include_partial ('content/categories',array('categories'=>$result->getCategories()))?></p>
        <div class="text">
          <?php echo $result->getStrippedBody() ?>
        </div>
        <div class="comments"><span class="misc misc-comments inline"></span><?php echo $result->getNbComments() ?> <br /> <span class="icon-opinions inline"></span><?php echo $result->countOpinions() ?></div>
        <div class="clear"></div>
      </div>
      <?php endif; ?>
    <? endforeach; ?>
    <?php if(isset($pager)): ?>
    <?php
      $url = preg_replace('/(?:&|(\?))page=[^&]*(?(1)&|)?/i', "$1", $sf_request->getUri());
      if (substr($url,-1) == '?') $url = substr($url, 0, strlen($url)-1);
    ?>
    <?php include_partial('home/doctrinePager',array('pager'=>$pager,'id'=>'list_results','url'=>$url)) ?>
    <?php endif; ?>
  <?php else: ?>
    <?php echo __('No results') ?>
  <?php endif ?>
  
  
