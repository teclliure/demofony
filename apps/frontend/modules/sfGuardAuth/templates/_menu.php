<?php use_helper('jQuery')?>
      <div id="top" class="misc misc-top-bar">
        <ul class="tools">
          <li class="social">
            <a class="misc misc-fb" href="#"></a>
            <a class="misc misc-tw" href="#"></a>
          </li>
          <li class="user">
          <?php if ($sf_user->isAuthenticated()): ?>
            <?php echo __('Hi') ?>, <?php echo link_to($sf_user,'user/showProfile?username='.$sf_user->getUsername()) ?> | <?php echo link_to(__('Edit profile'),'@profile') ?> | <?php echo link_to(__('Logout'),'@sf_guard_signout') ?><br />
          <?php else: ?>
            <?php echo link_to(__('Create account'),'@register') ?> | <a href="#" class="login line login_opener"><span class="misc misc-lock inline"></span><?php echo __('Login') ?></a>
          <?php endif; ?>
          </li>
          <li class="language">
          <?php include_component('language', 'language') ?>
          </li>
         </ul>
      </div>