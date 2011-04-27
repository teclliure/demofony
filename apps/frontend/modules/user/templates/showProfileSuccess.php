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
                        <p><?php echo __('Opiniones') ?>: <strong><?php echo $userProfile->getNumberOpinions() ?></strong></p>
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
                    <?php for($i = 0; $i < 5; $i++): ?>
                    <div class="comment">
                        <h1>Lorem ipsum this is a test</h1>
                        <p class="info">
                            Propuesto por <a href="#">Concerjería de Igualdad y Empleo</a> el 17 de enero de 2011
                        </p>
                        <div class="content">
                            <div class="left">
                                <h2>John Doe</h2>
                                <p class="date">17 de enero de 2011</p>
                                <p class="opinion">Opinió a <strong>Favor</strong></p>
                            </div>
                            <div class="right">
                                <div class="text">
                                    sa gasdfsdfi usgdifsau dfuas diufa isdgfisgd iyfg isyd gfysgadyifg adisgfi yogsdioyfag disgfiosdiyfag diyos dfsdf sdf sdaf sdfasdfasdfa
                                </div>
                                <div class="footer">
                                    <a href="#" class="opino button1">Opino el mateix</a>
                                    <div class="stats">
                                        <strong>2 <span class="inline icon-thumb-up"></span></strong>
                                        <strong>2 <span class="inline misc misc-comments"></span></strong>
                                        <strong><a href="#"><span class="inline icon-banned"></span></a></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <span class="icon-quote2 quote quote-left"></span>
                          <span class="icon-quote1 quote quote-right"></span>
                        </div>
                    </div>
                    <? if($i == 0): ?>
                    <div class="featured">
                    <form class="add-comment">
                      <a href="#" class="add"><span class="inline icon-add_comment"></span> Añadir un comentario</a>
                      <div>
                        <textarea></textarea>
                        <button type="submit" class="button1">Comentar</button>
                        <a href="#" class="cancel">Cancelar</a>
                      </div>
                    </form>
                    <?php for($i = 0; $i < 2; $i++): ?>
                    <div class="featured-comment">
                      <div class="img profile"></div>
                      <div class="content">
                        <h1>John Doe II <span>- 23 de marzo de 2011</span></h1>
                        <div class="text">
                          Lorem ipsum pisum lorem ipus ipsum pisum lorem ipus ipsum pisum lorem ipus lorem ipus ipsum pisum lorem ipus ipsum pisum lorem ipus.
                        </div>
                      </div>
                    </div>
                     <? endfor; ?>
                  </div>
                    <? endif; ?>
                    <? endfor; ?>
                </div>
                
                <? endif; ?>
                
                <? if($section == 'initiatives'): ?>
                <div class="iniciatives">
                  <?php include_partial('content/initiativesList',array('initiatives'=>$userProfile->getInitiatives()))?>
                </div>
                <? endif; ?>
                
                <? if($section == 'actions'): ?>
                  <?php include_partial('content/actionsList',array('actions'=>$userProfile->getActions()))?>
                <? endif; ?>
            </div>
        </div>
    </div>