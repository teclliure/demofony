<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="<?php echo $sf_request->getRelativeUrlRoot() ?>/images/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body <?php if (has_slot('pageId')): ?><?php include_slot('pageId') ?><?php endif; ?> <?php if (has_slot('pageClass')): ?><?php include_slot('pageClass') ?><?php endif; ?>>
   <script type="text/javascript">
    <!--
    login_url = '<?php echo url_for('@loginAjax') ?>';
    login_title = '<?php echo __('Login') ?>';
    select_content_url = '<?php echo url_for('@selectContent') ?>';
    select_content_title = '<?php echo __('Select with content do you want add') ?>';
    //-->
   </script>
    <div id="container">
     <?php include_partial('sfGuardAuth/menu')?>
     <?php include_partial('global/header')?>
      <div id="main">
        <div class="main-inner">
          <?php include_partial('home/flashes')?>
          <?php echo $sf_content ?>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <?php include_partial('global/footer')?>
    <div id="login_dialog"></div>
    <div id="select_content"></div>
  </body>
</html>