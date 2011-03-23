<?php if (isset($this->params['css'])): // custom CSS ?>
  [?php use_stylesheet('<?php echo $this->params['css'] ?>') ?]
<?php else: // jRoller CSS ?>
  [?php use_stylesheet('<?php echo sfConfig::get('app_admin_theme_jroller2_plugin_web_dir', '/adminThemejRoller2Plugin').'/css/jroller2.css' ?>') ?]
<?php endif; ?>

[?php // additionnal stylesheet (filament group)
  use_stylesheet('<?php echo sfConfig::get('app_admin_theme_jroller2_plugin_web_dir', '/adminThemejRoller2Plugin').'/css/fg.menu.css' ?>');
  use_stylesheet('<?php echo sfConfig::get('app_admin_theme_jroller2_plugin_web_dir', '/adminThemejRoller2Plugin').'/css/fg.buttons.css' ?>');
  use_stylesheet('<?php echo sfConfig::get('app_admin_theme_jroller2_plugin_web_dir', '/adminThemejRoller2Plugin').'/css/ui.selectmenu.css' ?>');
?]

[?php // additionnal javascript (filament group)
  use_javascript('<?php echo sfConfig::get('app_admin_theme_jroller2_plugin_web_dir', '/adminThemejRoller2Plugin').'/js/fg.menu.js' ?>');
  use_javascript('<?php echo sfConfig::get('app_admin_theme_jroller2_plugin_web_dir', '/adminThemejRoller2Plugin').'/js/jroller2.js' ?>');
  use_javascript('<?php echo sfConfig::get('app_admin_theme_jroller2_plugin_web_dir', '/adminThemejRoller2Plugin').'/js/ui.selectmenu.js' ?>');
?]