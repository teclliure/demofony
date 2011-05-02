<?php slot('pageId') ?>id="perfil"<?php end_slot() ?>
    <div class="bar-left">
      <div class="box has-title color1">
          <h1 class="hdr"><span class="inline icon-man_user"></span><?php echo __('Profile') ?></h1>
          <div class="box-content show">
              <div class="info">
                  <div class="img profile"></div>
                  <div class="user">
                    <h1><?php echo $userProfile->getName() ?></h1>
                    <div>
                        <p><?php echo __('Opinions') ?>: <strong><?php echo $userProfile->getNumberOpinions() ?></strong></p>
                        <p><?php echo __('Comments') ?>: <strong><?php echo $userProfile->getNumberComments() ?></strong></p>
                        <p><?php echo __('Initiatives') ?>: <strong><?php echo $userProfile->getNumberInitiatives() ?></strong></p>
                        <p><?php echo __('Meetings') ?>: <strong><?php echo $userProfile->getNumberActions() ?></strong></p>
                    </div>
                  </div>
                  <div class="clear"></div>
                  
                  <div class="edit">
                  <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getId() == $userProfile->getId()): ?>
                      <?php echo link_to('<span class="inline icon-edit"></span>'.__('Edit profile'),'user/profile')?>
                  <?php endif; ?>
                  </div>
              </div>
              <div class="map">
                  <p><?php echo __('Location') ?>: <strong><?php echo $userProfile->getProfile()->getLocation() ?></strong></p>
                  <div id="profile-map"></div>
              </div>
          </div>
      </div>
    </div>

    <div class="bar-right">
        <div class="box">
            <div class="box-content show">
                <div class="header">
                    <h1><?php __('Participation of')?> <strong><?php echo $userProfile->getName() ?></strong></h1>
                    <ul>
                        <li class="<?= $section == 'opinions' ? 'on' : '' ?>"><a href="<?php echo url_for('user/showProfile?username='.$userProfile->getUsername().'&section=opinions') ?>"><?php echo __('Opinions') ?></a></li>
                        <li class="<?= $section == 'initiatives' ? 'on' : '' ?>"><a href="<?php echo url_for('user/showProfile?username='.$userProfile->getUsername().'&section=initiatives') ?>"><?php echo __('Initiatives') ?></a></li>
                        <li class="<?= $section == 'actions' ? 'on' : '' ?>"><a href="<?php echo url_for('user/showProfile?username='.$userProfile->getUsername().'&section=actions') ?>"><?php echo __('Meetings') ?></a></li>
                    </ul>
                </div>
                
                <? if($section == 'opinions'): ?>
                <div class="opinions">
                   <?php include_partial('user/opinionsList',array('opinions'=>$userProfile->getOpinions()))?>
                </div>
                
                <? endif; ?>
                
                <? if($section == 'initiatives'): ?>
                <div class="iniciatives">
                  <?php include_partial('content/initiativesList',array('contents'=>$userProfile->getInitiatives()))?>
                </div>
                <? endif; ?>
                
                <? if($section == 'actions'): ?>
                  <?php include_partial('content/actionsList',array('contents'=>$userProfile->getActions()))?>
                <? endif; ?>
            </div>
        </div>
    </div>