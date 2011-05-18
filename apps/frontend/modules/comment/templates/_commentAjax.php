  <?php use_helper('Date') ?>
  <div class="featured-comment <?php if($obj->is_delete) echo " deleted"; ?>">
    <div class="img profile"><img src="<?php echo $obj->getUser()->getProfile()->getImageSrcWithDefault('image', 'thumb')?>" alt="profile_image" /></div>
    <div class="content">
      <?php include_partial("comment/comment_infosAjax", array('obj' => $obj, 'parentObject'=>$object, 'i' => $i, 'form_name' => $form_name)) ?>
      <h1><?php echo link_to($obj->getUser(),'user/showProfile?username='.$obj->getUser()->getUsername()) ?> <span>- <?php echo format_date($obj->getCreatedAt()) ?></span></h1>
      <div class="text">
        <?php if(!$obj->is_delete): ?>
        <div id="body_<?php echo $obj->id ?>"><?php echo $obj->getBody(ESC_RAW) ?></div>
        <?php else: ?>
          <div class="msg-deleted"><?php echo __('Comment deleted by moderator', array(), 'vjComment') ?></div>
        <?php endif ?>
      </div>
    </div>
  </div>