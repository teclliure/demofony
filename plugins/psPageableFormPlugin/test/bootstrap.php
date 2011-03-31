<?php

$symfonyPath =  dirname(__FILE__).'/../../../lib/vendor/symfony/lib';

require_once $symfonyPath.'/vendor/lime/lime.php';
require_once $symfonyPath.'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

require_once dirname(__FILE__).'/TestFormClasses.php';