<div class="opinion">
<?php echo __($opinion->getSfGuardUser()) ?> <?echo __('opinate') ?> <?php echo __($opinion->__toString()) ?> <?php echo __('on') ?> <?php echo format_date($opinion->getCreatedAt()) ?><br />
<?php echo $opinion->getOpinion() ?>
</div>
