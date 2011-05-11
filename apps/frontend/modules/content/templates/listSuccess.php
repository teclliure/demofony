<?php slot('pageId') ?>id="busqueda"<?php end_slot() ?>
<?php
  $url = preg_replace('/(?:&|(\?))page=[^&]*(?(1)&|)?/i', "$1", $sf_request->getUri());
  if (substr($url,-1) == '?') $url = substr($url, 0, strlen($url)-1);
?>
<div class="bar-left">
  <div class="box no-tabs" >
    <div class="box-content show">
      <div class="box-title">
        <p><?php echo strtoupper(__(str_replace('_',' ', $title))) ?><?php if (isset($searchStr) && $searchStr): ?>: <?php echo $searchStr?><?php endif;?></p>
        <span><strong><?php echo $pager->getNbResults() ?></strong> <?php echo __('results') ?></span>
      </div>
      <div id="list_results">
        <?php include_partial ('content/list',array('pager'=>$pager,'title'=>$title,'searchStr'=>$searchStr))?>
      </div>
    </div>
  </div>
</div>
    
<div class="bar-right">
  <div class="box no-tabs">
    <div class="box-content show">
      
      <div class="box-title">
        <p><?php echo __('FILTERS') ?></p>
      </div>
      <?php
      $url1 = preg_replace('/\/category\/+[a-zA-Z0-9._-]*/i', '', $url);
      ?>
      <ul class="filter">
        <li class="header">
          <?php echo __('Filter by category') ?>
        </li>
        <?php foreach ($categories as $category):?>
          <?php if ($sf_request->getParameter('category')==$category->getId()): ?>
          <li class="on">
            <?php echo $category ?><a href="<?php echo url_for($url1)?>" class="delete">X</a>
          </li>
          <?php else: ?>
          <li>
            <?php echo link_to ($category,$url1.'/category/'.$category->getId()) ?>
          </li>
          <?php endif ?>
          
          
        <?php endforeach; ?>
      </ul>
      
      <?php
      $classes = array('GovermentNew'=>'News',
                        'CitizenProposal'=>'Citizen initiatives',
                        'GovermentProposal'=>'Goverment initiatives',
                        'GovermentConsultation'=>'Opinion polls',
                        'CitizenAction'=>'Citizen actions',
                        'Workshop'=>'Workshops on demand');
      $url2 = preg_replace('/\/type\/+[a-zA-Z0-9._-]*/i', '', $url);
      ?>
      <ul class="filter">
        <li class="header">
          <?php echo __('Filter by type') ?>
        </li>
        
        <?php foreach ($classes as $key=>$class): ?>
          <?php if ($sf_request->getParameter('type')==$key): ?>
          <li class="on">
            <?php echo __($class) ?><a href="<?php echo url_for($url2)?>" class="delete">X</a>
          </li>
          <?php else: ?>
          <li>
            <?php echo link_to (__($class),$url2.'/type/'.$key) ?>
          </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      
      <?php
      $url3 = preg_replace('/\/region\/+[a-zA-Z0-9._-]*/i', '', $url);
      ?>
      <ul class="filter">
        <li class="header">
          <?php echo __('Filter by neighborhood') ?>
        </li>
        <?php foreach ($regions as $region):?>
          <?php if ($sf_request->getParameter('region')==$region->getId()): ?>
          <li class="on">
            <?php echo $region ?><a href="<?php echo url_for($url3)?>" class="delete">X</a>
          </li>
          <?php else: ?>
          <li>
            <?php echo link_to ($region,$url3.'/region/'.$region->getId()) ?>
          </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>