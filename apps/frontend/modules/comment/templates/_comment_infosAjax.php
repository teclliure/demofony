      <?php use_stylesheet("/vjCommentAdaptedPlugin/css/reportComment.min.css") ?>
      <td rowspan="2" class="infos">
        <script type="text/javascript">
        <!--
        $(function() {
          $("#report_dialog_<?php echo $obj->getId() ?>").dialog({
            autoOpen: false,
            show: "blind",
            hide: "blind",
            width: 460,
            modal: true,
            title: '<?php echo __('Report as inadecuate') ?>'
          });
          var options = {
              target:        '#report_dialog_<?php echo $obj->getId() ?>',   // target element(s) to be updated with server response
              // beforeSubmit:  showCommentsList,  // pre-submit callback
              // success:       showCommentsList,  // post-submit callback

              // other available options:
              //url:       url         // override for form's 'action' attribute
              //type:      type        // 'get' or 'post', override for form's 'method' attribute
              //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
              clearForm: true,        // clear all form fields after successful submit
              //resetForm: true        // reset the form after successful submit

              // $.ajax options can be used here too, for example:
              //timeout:   3000
          };
          // bind to the form's submit event
          $('#submit_comment_report_<?php echo $obj->getId() ?>').submit(function() {
              $(this).ajaxSubmit(options);
              return false;
          });
        });
        //-->
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
        <div id="report_dialog_<?php echo $obj->getId() ?>"><?php include_component('comment','formReportAjax',array('id_comment'=>$obj->getId(),'num'=>$i))?></div>
      </td>