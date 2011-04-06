<script type="text/javascript">
<!--
$(function() {
  $( "#tabs" ).tabs();
});
//-->
</script>

<div id="tabs">
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