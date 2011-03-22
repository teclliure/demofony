<?php if (isset($this->params['css'])): // custom CSS ?>
  [?php use_stylesheet('<?php echo $this->params['css'] ?>') ?]
<?php else: // jRoller CSS ?>
  [?php use_stylesheet('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/css/jroller.css' ?>') ?]
<?php endif; ?>

[?php // additionnal stylesheet (filament group)
  use_stylesheet('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/css/fg.menu.css' ?>');
  use_stylesheet('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/css/fg.buttons.css' ?>');
  use_stylesheet('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/css/ui.selectmenu.css' ?>');
?]

[?php // additionnal javascript (filament group)
  use_javascript('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/js/fg.menu.js' ?>');
  use_javascript('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/js/jroller.js' ?>');
  use_javascript('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/js/ui.selectmenu.js' ?>');
?]

<?php if (sfConfig::get('app_sf_admin_theme_jroller_plugin_theme_switcher')): // use theme switcher ?>
  [?php use_javascript('<?php echo sfConfig::get('app_sf_admin_theme_jroller_plugin_web_dir', '/sfAdminThemejRollerPlugin').'/js/themeswitcher.js' ?>') ?]
<?php endif; ?>
