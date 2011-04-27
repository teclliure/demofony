<?php if ($pager->haveToPaginate()): ?>
<div class="pagination">
    <a href="#" onClick="$('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getFirstPage() ?>'); return false;"><<</a>
    <a href="#" onClick="$('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getPreviousPage() ?>'); return false;"><</a>
    
    <strong><?php echo $pager->getPage() ?> <?php echo __('of')?> <?php echo $pager->getLastPage() ?></strong>

    <a href="#" onClick="$('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getNextPage() ?>'); return false;">></a>
    <a href="#" onClick="$('#<?php echo $id?>').load('<?php echo $url.'?page='.$pager->getLastPage() ?>'); return false;">>></a>
</div>
<?php endif; ?>