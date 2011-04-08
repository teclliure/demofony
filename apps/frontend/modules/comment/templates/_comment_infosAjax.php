      <?php use_stylesheet("/vjCommentAdaptedPlugin/css/reportComment.min.css") ?>
      <td rowspan="2" class="infos">
        <script type="text/javascript">
        $(function() {
          $("#report_dialog_<?php echo $obj->getId() ?>").dialog({
            autoOpen: false,
            show: "blind",
            hide: "blind",
            width: 460,
            modal: true,
            title: '<?php echo __('Report as inadecuate') ?>'
          });
        });
        </script>
        
        <a name="<?php echo $i ?>" class="ancre">#<?php echo $i ?></a>
        <?php if(!$obj->is_delete): ?>
          <?php echo link_to_function(
                  image_tag('/vjCommentAdaptedPlugin/images/comments.png', array( 'alt' => 'reply' )) ,
                  "reply('".$obj->getId()."','".$obj->getAuthor()."', '".$form_name."','form_comment_".$obj->getRecordModel()."_".$obj->getRecordId()."')",
                  array('title' => __('Reply to this comment', array(), 'vjComment'))) ?>
          <?php echo link_to_function(
                image_tag('/vjCommentAdaptedPlugin/images/error.png', array( 'alt' => 'report' )) ,
                "$('#report_dialog_".$obj->getId()."').dialog('open')",
                array('title' => __('Report as inadecuate') )) ?><br />
        <?php endif; ?>
        <?php if(commentTools::isGravatarAvailable() && !$obj->is_delete): ?>
          <?php echo gravatar_image_tag($obj->getEmail()) ?>
        <?php endif ?>
        <div id="report_dialog_<?php echo $obj->getId() ?>"><?php include_component('comment','formReportAjax',array('id_comment'=>$obj->getId()))?></div>
      </td>