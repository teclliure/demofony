<?php if ($pager->haveToPaginate()): ?>
<div class="pagination">
    <a href="#" onClick="$('#<?php echo $id?>').empty().addClass('loading'); $('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getFirstPage() ?>',function(){$('#<?php echo $id?>').removeClass('loading');}); return false;"><<</a>
    <a href="#" onClick="$('#<?php echo $id?>').empty().addClass('loading'); $('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getPreviousPage() ?>',function(){$('#<?php echo $id?>').removeClass('loading');}); return false;"><</a>
    
    <strong><?php echo $pager->getPage() ?> <?php echo __('of')?> <?php echo $pager->getLastPage() ?></strong>

    <a href="#" onClick="$('#<?php echo $id?>').empty().addClass('loading'); $('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getNextPage() ?>',function(){$('#<?php echo $id?>').removeClass('loading');}); return false;">></a>
    <a href="#" onClick="$('#<?php echo $id?>').empty().addClass('loading'); $('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getLastPage() ?>',function(){$('#<?php echo $id?>').removeClass('loading');}); return false;">>></a>
</div>
<?php endif; ?>