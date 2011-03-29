<?php use_helper('jQuery'); ?>
<?php use_helper('Url'); ?>
<?php use_helper('I18N'); ?>

<div>
  <input type="text" value="<?php echo  $sf_request->getParameter('current_value') ?>"/>
  <a class="save_tree_field_value" href="#"><?php echo __('save') ?></a>
  <a href=""><?php echo __('cancel') ?></a>
</div>

<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function($) {
    $('.save_tree_field_value').click(function() {
      $.ajax({
        url: '<?php echo url_for('@tree_do_edit_item') ?>',
        type: 'POST',
        dataType: 'html',
        data: {
          root: '<?php echo $sf_request->getParameter('root') ?>',
          field: '<?php echo $sf_request->getParameter('field') ?>',
          model: '<?php echo $sf_request->getParameter('model') ?>',
          id: '<?php echo  $sf_request->getParameter('record_id') ?>',
          field_value: $(this).parent().find('input').val()
        },
        success: function(tree) {
          $('#tree_container').replaceWith(tree);
        }
      });
    });
  });
</script>