<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
   <div class="container">
     <div id="header" class="span-24 last" style="background: #eeeeee"><h1><?php echo link_to (__('Demofony'),'@homepage') ?></h1></div>
     <div id="top_logo" class="span-16">Logo</div>
     <div id="top_menu" class="span-8 last">
     <?php include_partial('sfGuardAuth/menu')?>
     Menu
     </div>
     <div class="span-24 last">
     <?php include_partial('home/flashes')?>
     <?php echo $sf_content ?>
     </div>
     <div id="footer" class="span-24 last"><?php echo __('Project developed by') ?> <a href="http://www.teclliure.net">Teclliure</a> <?php echo __('using') ?> <a href="http://www.symfony-project.org/">Symfony</a></div>
  </div>
  <div id="login_dialog"></div>
  <div id="select_content"></div>
  </body>
</html>
