
      <td class="author">
        <span class="author">
        <?php if($website != ""): ?>
          <a href="<?php echo $website ?>" target="_blank" rel="me nofollow"><?php echo $name ?></a>
        <?php else: ?>
          <?php echo $name ?>
        <?php endif; ?>
        </span>
        <span class="date"><?php echo format_date($date, "f") ?></span>
      </td>