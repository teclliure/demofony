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
     <div class="span-24 last"><h1>Cabecera</h1></div>
     <div class="span-24 last"><?php include_component('home', 'menu'); ?></div>
     <div class="span-24 last"><?php include_component('sfDoctrineBreadcrumbs', 'breadcrumbs'); ?></div>
     <div class="span-5">
        menu
     </div>
     <div class="span-19 last">
     Contenido
     <?php echo $sf_content ?>
     </div>
     <div class="span-24 last"><h3>Pie de pàgina</h3></div>
  </div>
  </body>
</html>
