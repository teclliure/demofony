<?php slot('pageId') ?>id="busqueda"<?php end_slot() ?>
<?php
  $url = preg_replace('/(?:&|(\?))page=[^&]*(?(1)&|)?/i', "$1", $sf_request->getUri());
  if (substr($url,-1) == '?') $url = substr($url, 0, strlen($url)-1);
?>
<div class="bar-left" id="list_results">
  <?php include_partial ('content/list',array('pager'=>$pager,'title'=>$title))?>
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
          <?php if ($sf_request->getParameter('category')==$category->getId()): ?><b><?php endif ?>
          <li><?php echo link_to ($category,$url1.'/category/'.$category->getId()) ?></li>
          <?php if ($sf_request->getParameter('category')==$category->getId()): ?></b><?php endif ?>
        <?php endforeach; ?>
      </ul>
      
      <?php
      $url2 = preg_replace('/\/type\/+[a-zA-Z0-9._-]*/i', '', $url);
      ?>
      <ul class="filter">
        <li class="header">
          <?php echo __('Filter by type') ?>
        </li>
        <li>
          <?php if ($sf_request->getParameter('type')=='GovermentNew'): ?><b><?php endif ?>
          <?php echo link_to ('News',$url2.'/type/GovermentNew') ?>
          <?php if ($sf_request->getParameter('type')=='GovermentNew'): ?></b><?php endif ?>
        </li>
        <li>
          <?php if ($sf_request->getParameter('type')=='CitizenProposal'): ?><b><?php endif ?>
          <?php echo link_to ('Citizen initiatives',$url2.'/type/CitizenProposal') ?>
          <?php if ($sf_request->getParameter('type')=='CitizenProposal'): ?></b><?php endif ?>
        </li>
        <li>
          <?php if ($sf_request->getParameter('type')=='GovermentProposal'): ?><b><?php endif ?>
          <?php echo link_to ('Goverment initiatives',$url2.'/type/GovermentProposal') ?>
          <?php if ($sf_request->getParameter('type')=='GovermentProposal'): ?></b><?php endif ?>
        </li>
        <li>
          <?php if ($sf_request->getParameter('type')=='GovermentConsultation'): ?><b><?php endif ?>
          <?php echo link_to ('Consultations',$url2.'/type/GovermentConsultation') ?>
          <?php if ($sf_request->getParameter('type')=='GovermentConsultation'): ?></b><?php endif ?>
        </li>
        <li>
          <?php if ($sf_request->getParameter('type')=='CitizenAction'): ?><b><?php endif ?>
          <?php echo link_to ('Citizen actions',$url2.'/type/CitizenAction') ?>
          <?php if ($sf_request->getParameter('type')=='CitizenAction'): ?></b><?php endif ?>
        </li>
        <li>
          <?php if ($sf_request->getParameter('type')=='Workshop'): ?><b><?php endif ?>
          <?php echo link_to ('Under demand workshops',$url2.'/type/Workshop') ?>
          <?php if ($sf_request->getParameter('type')=='Workshop'): ?></b><?php endif ?>
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
          <?php if ($sf_request->getParameter('region')==$region->getId()): ?><b><?php endif ?>
          <li><?php echo link_to ($region,$url3.'/region/'.$region->getId()) ?></li>
          <?php if ($sf_request->getParameter('region')==$region->getId()): ?></b><?php endif ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>