
    <tbody class="comment<?php if($obj->is_delete) echo " deleted"; ?>">
      <tr<?php if($first_line) echo ' class="first_line"' ?>>
        <?php include_partial("comment/comment_author", array('website' => $obj->getWebsite(), 'name' => $obj->getAuthor(), 'date' => $obj->getCreatedAt())) ?>
        <?php include_partial("comment/comment_infos", array('obj' => $obj, 'i' => $i, 'form_name' => $form_name)) ?>
      </tr>
      <?php include_partial("comment/comment_body", array('obj' => $obj)) ?>
    </tbody>