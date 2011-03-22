<?php echo $menu->render() ?>
<script type="text/javascript">
    // initialise plugins
    jQuery(function(){
      jQuery('ul#admin_menu').superfish().find('ul').bgIframe({opacity:false});
    });
</script>
