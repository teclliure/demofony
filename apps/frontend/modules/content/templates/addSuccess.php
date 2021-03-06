<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php slot('pageId') ?>id="form-taller"<?php end_slot() ?>
<form action="<?php if ($form->getObject()->isNew()) echo url_for ('@contentAdd?class='.$class); else echo url_for ('content/edit?class='.get_class($form->getObject()).'&slug='.$form->getObject()->getSlug());?>"  <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="form" method="post" >
<div class="bar-left">
  <div class="box no-tabs no-margin">
    <div class="box-content show">
      <div class="box-title color1">
        <?php if (isset($class)): ?>
        <p><?php echo __('Add your') ?> <?php echo __(sfInflector::humanize(sfInflector::underscore($class))) ?></p>
        <?php else: ?>
        <p><?php echo __('Edit your') ?> <?php echo __(sfInflector::humanize(sfInflector::underscore(get_class($form->getObject())))) ?></p>
        <?php endif; ?>
      </div>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form->renderHiddenFields() ?>
      <?php echo $form['title']->renderRow(array('class'=>'wide')) ?>
      <?php echo $form['body']->renderRow(array('class'=>'wide')) ?>
      <?php if (isset($form['tip'])) echo $form['tip']->renderRow(array('class'=>'wide')) ?>
      
      
      <?php if (is_subclass_of($form, 'ActionForm')): ?>
      <div class="features">
        <p class="hdr"><?php echo __('Features') ?></p>
        <?php echo $form['author']->renderRow() ?>
        <?php echo $form['location']->renderRow() ?>
        <div class="clear"></div>
      </div>
      
      <div class="features">
        <?php echo $form['action_date']->renderRow() ?>
        <?php if(isset($form['price'])): ?>
        <?php echo $form['price']->renderRow(array('size'=>3)) ?>
        <?php endif; ?>
        <div class="clear"></div>
      </div>
      
      <div class="features">
        <?php echo $form['register_start_date']->renderRow() ?>
        <div class="clear"></div><br />
        <?php echo $form['register_end_date']->renderRow() ?>
        <div class="clear"></div>
      </div>
      
      <div class="features no-border">
        <?php echo $form['min_users_allowed']->renderRow(array('size'=>2)) ?>
        <?php echo $form['max_users_allowed']->renderRow(array('size'=>2)) ?>
        <div class="clear"></div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="bar-right">
  <div class="box no-tabs no-margin">
    <div class="box-content show">
      <div class="box-title color1">
        <p><?php echo __('Include a photo or a video') ?></p>
      </div>
      
      <?php echo $form['image']->renderRow() ?>
      <?php echo $form['video']->renderRow() ?>
      
      <div class="box-title color1">
        <p><?php echo __('Map') ?></p>
      </div>
      <?php echo $form['gmap']->renderRow()?>
        
      <div class="clear"></div>
      
      <button type="submit" class="button1"><?php echo __('Send')?></button>
    </div>
  </div>
</div>


<div class="clear"></div>

<?php if($form->getObject()->isNew()): ?>
<div class="note">
  <?php echo __('This proposal will be filtered before publication. If it includes insults, harassment or content that we consider as inapropiate it will not be published. For more information visit') ?> <a href="<?php echo ('static?page=use_conditions') ?>"><?php echo __('Use conditions') ?></a>
</div>
<?php elseif(is_subclass_of($form, 'ActionForm')): ?>
<br />
<div class="box no-tabs no-margin">
    <div class="box-content show">
      <div class="box-title color1">
        <p><?php echo __('Users joined') ?> (<?php echo $form->getObject()->getNumberUsersRegistered() ?>)</p>
      </div>
      <?php $usersJoined = $form->getObject()->getUsersRegistered() ?>
      <?php foreach ($usersJoined as $i=>$user): ?><?php if ($i): ?>, <?php endif;?><?php echo link_to($user,'user/showProfile?username='.$user->getUsername()) ?><?php endforeach ?>
    </div>
</div>
<?php endif; ?>

</form>




