<?php use_helper('jQuery')?>
      <div id="top" class="misc misc-top-bar">
        <ul class="tools">
          <li class="social">
            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
            <fb:like href="<?php echo url_for ('@homepage',true) ?>" send="false" layout="button_count" width="40" show_faces="false" font=""></fb:like>
            <a href="http://twitter.com/share" class="twitter-share-button misc misc-tw" data-url="<?php echo url_for ('@homepage',true) ?>" data-count="none" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
          </li>
          <li class="user">
          <?php if ($sf_user->isAuthenticated()): ?>
            <?php echo __('Hi') ?>, <?php echo $sf_user ?> | <?php echo link_to(__('Edit profile'),'@profile') ?> | <?php echo link_to(__('Logout'),'@sf_guard_signout') ?><br />
          <?php else: ?>
            <?php echo link_to(__('Create account'),'@register') ?> | <a href="#" class="login line login_opener"><span class="misc misc-lock inline"></span><?php echo __('Login') ?></a>
          <?php endif; ?>
          </li>
          <li class="language">
          <select class="line">
            <option><?php echo __('Català') ?></option>
            <option><?php echo __('Castellano') ?></option>
          </select>
          </li>
         </ul>
      </div>