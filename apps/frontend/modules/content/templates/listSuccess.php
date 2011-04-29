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
          <li <?php if ($sf_request->getParameter('category')==$category->getId()): ?>class="on"<?php endif ?>>
            <?php echo link_to ($category,$url1.'/category/'.$category->getId()) ?>
          </li>
        <?php endforeach; ?>
      </ul>
      
      <?php
      $url2 = preg_replace('/\/type\/+[a-zA-Z0-9._-]*/i', '', $url);
      ?>
      <ul class="filter">
        <li class="header">
          <?php echo __('Filter by type') ?>
        </li>
        <li <?php if ($sf_request->getParameter('type')=='GovermentNew'): ?>class="on"<?php endif ?>>
          <?php echo link_to ('News',$url2.'/type/GovermentNew') ?>
        </li>
        <li <?php if ($sf_request->getParameter('type')=='CitizenProposal'): ?>class="on"<?php endif ?>>
          <?php echo link_to ('Citizen initiatives',$url2.'/type/CitizenProposal') ?>
        </li>
        <li <?php if ($sf_request->getParameter('type')=='GovermentProposal'): ?>class="on"<?php endif ?>>
          <?php echo link_to ('Goverment initiatives',$url2.'/type/GovermentProposal') ?>
        </li>
        <li <?php if ($sf_request->getParameter('type')=='GovermentConsultation'): ?>class="on"<?php endif ?>>
          <?php echo link_to ('Consultations',$url2.'/type/GovermentConsultation') ?>
        </li>
        <li <?php if ($sf_request->getParameter('type')=='CitizenAction'): ?>class="on"<?php endif ?>>
          <?php echo link_to ('Citizen actions',$url2.'/type/CitizenAction') ?>
        </li>
        <li <?php if ($sf_request->getParameter('type')=='Workshop'): ?>class="on"<?php endif ?>>
          <?php echo link_to ('Under demand workshops',$url2.'/type/Workshop') ?>
        </li>
      </ul>
      
      <?php
      $url3 = preg_replace('/\/region\/+[a-zA-Z0-9._-]*/i', '', $url);
      ?>
      <ul class="filter">
        <li class="header">
          <?php echo __('Filter by neighborhood') ?>
        </li>
        <?php foreach ($regions as $region):?>
          
          <li <?php if ($sf_request->getParameter('region')==$region->getId()): ?>class="on"<?php endif ?>>
            <?php echo link_to ($region,$url3.'/region/'.$region->getId()) ?>
          </li>
          
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>