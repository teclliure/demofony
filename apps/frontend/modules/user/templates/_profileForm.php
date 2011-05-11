<?php use_helper('I18N') ?>

<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<form action="<?php echo url_for('@profile') ?>" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> method="post" class="form" id="form-profile">
  <div class="bar-left">
    <div class="box no-tabs no-margin">
      <div class="box-content show">
        <div class="box-title color1">
          <p><a href="#" class="toggler show">+</a><?php echo __('Register information') ?></p>
        </div>
        
        <div class="hide form-toggle-content">
          <?php // echo $form ?>
          <?php echo $form['first_name']->renderRow(array('class'=>'wide'))?>
          <?php echo $form['last_name']->renderRow(array('class'=>'wide'))?>
          <?php echo $form['profile']['gmap']->renderRow()?>
          <div class="clear"></div>
          <div class="line"></div>
          
          <?php echo $form['profile']['born_date']->renderRow()?>
          <?php echo $form['profile']['gender']->renderRow()?>
          <div class="clear"></div>
          
          <?php echo $form['profile']['about']->renderRow(array('class'=>'wide'))?>
          <div class="clear"></div>
          
          <?php echo $form['profile']['telephone']->renderRow(array('class'=>'wide'))?>
          <?php echo $form['profile']['web']->renderRow(array('class'=>'wide'))?>
          <div class="clear"></div>
          
          <?php echo $form['profile']['address']->renderRow(array('class'=>'wide address'))?>
          <?php echo $form['profile']['postal_code']->renderRow(array('class'=>'wide address'))?>
          <div class="clear"></div>
        
          <?php echo $form['profile']['location']->renderRow(array('class'=>'wide'))?>
          <?php echo $form['profile']['province']->renderRow(array('class'=>'wide'))?>
          <?php echo $form['profile']['country']->renderRow(array('class'=>'wide'))?>
          <div class="clear"></div>
        </div>
        
        <?php if (isset($form['password'])): ?>
        <div class="box-title color1">
          <p><a href="#" class="toggler">+</a><?php echo __('Change password')?></p>
        </div>
        
        <div class="hide form-toggle-content">
          <?php echo $form['password']->renderRow() ?>
          <?php echo $form['password_again']->renderRow() ?>
          <div class="clear"></div>
        </div>
        <?php endif; ?>
              
       <div class="box-title color1">
          <p><a href="#" class="toggler">+</a><?php echo __('Newsletter subscription')?></p>
        </div>
        
        <div class="hide form-toggle-content suscriptions">
          <p>
Selecciona las categorías y barris que te interesen y te mantendremos informado 
semanalmente a través del correo electrónico de las novedades. Si más adelante te 
interesan otras temáticas o barrios siempre puedes acceder a esta pantalla a través de 
edición de perﬁl y cambiar tus suscripciones</p>
          <?php echo $form['profile']['subscription_email']->renderRow() ?>
          <?php echo $form['profile']['categories_list']->renderRow() ?>
          <?php echo $form['profile']['regions_list']->renderRow() ?>
          <div class="clear"></div>
        </div>
        
        <div class="box-title color1">
          <p><a href="#" class="toggler">+</a><?php echo __('Darse de baja')?></p>
        </div>
        
        <div class="hide form-toggle-content">
          <button class="button1">Darse de baja</button>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="bar-right">
    <div class="box no-tabs no-margin">
      <div class="box-content show">
        <div class="box-title color1">
          <p><?php echo __('Include photo') ?></p>
        </div>
        
        <?php echo $form['profile']['image']->renderRow()?>
        <button type="submit" class="button1"><?php echo __('Done')?></button>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</form>