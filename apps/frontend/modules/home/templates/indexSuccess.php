<script type="text/javascript">
<!--
$(function() {
  $("#tabs").tabs();
});
//-->
</script>

<div class="span-15 append-1">
  <div id="tabs" style="background: #eeeeee">
    <ul>
      <li><a href="#all"><?php echo __('All') ?></a></li>
      <li><a href="#goverment_proposal"><?php echo __('Goverment proposal') ?></a></li>
      <li><a href="#citizen_proposal"><?php echo __('Citizen proposal') ?></a></li>
      <li><a href="#goverment_consultation"><?php echo __('Goverment consultation') ?></a></li>
    </ul>
    <div id="all">
      <?php foreach ($last_proposals as $proposal): ?>
        <?php include_partial('content/contentDivSmall',array('content'=>$proposal))?>
      <?php endforeach; ?>
      <div class="clear">&nbsp;</div>
    </div>
    <div id="goverment_proposal">
      <?php foreach ($last_goverment_proposals as $proposal): ?>
        <?php include_partial('content/contentDivSmall',array('content'=>$proposal))?>
      <?php endforeach; ?>
      <div class="clear">&nbsp;</div>
    </div>
    <div id="citizen_proposal">
      <?php foreach ($last_citizen_proposals as $proposal): ?>
        <?php include_partial('content/contentDivSmall',array('content'=>$proposal))?>
      <?php endforeach; ?>
      <div class="clear">&nbsp;</div>
    </div>
    <div id="goverment_consultation">
      <?php foreach ($last_goverment_consultations as $consultation): ?>
        <?php include_partial('content/contentDivSmall',array('content'=>$consultation))?>
      <?php endforeach; ?>
      <div class="clear">&nbsp;</div>
    </div>
  </div>
</div>

<div id="sidebar_right" class="span-8 last" style="margin-bottom: 1em;">
  <?php if ($sf_user->isAuthenticated()): ?>
  <div class="span-8 last" style="background: #eeeeee; margin-bottom: 1em">
    <a href="#" class="select_content"><?php echo __('Make your proposal') ?></a>
  </div>
  <?php else: ?>
  <div class="span-8 last" style="background: #eeeeee; margin-bottom: 1em">
    <?php echo link_to(__('Create user'),'@register') ?>
  </div>
  <?php endif; ?>
  
  <div class="span-8 last" style="background: #eeeeee">
    <h3><?php echo __('Last news')?></h3>
    <?php foreach($last_news as $new): ?>
      <?php include_partial('content/newDivSmall',array('new'=>$new))?>
    <?php endforeach; ?>
  </div>
</div>