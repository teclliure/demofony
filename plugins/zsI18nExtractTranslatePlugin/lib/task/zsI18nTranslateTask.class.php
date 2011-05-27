<?php

class zsI18nTranslateTask extends sfI18nExtractTask
{
  protected function configure()
  {
    parent::configure();

    $this->name             = 'translate';
    $this->briefDescription = 'Translates them with Google translation API';

    $this->detailedDescription = <<<EOF
All messages translated with Google's translation API
EOF;

  }

  public function execute($arguments = array(), $options = array())
  {
    $culture = $arguments['culture'];
    print $culture;

    $this->logSection('i18n', sprintf('extracting i18n strings for the "%s" application', $arguments['application']));

    // get i18n configuration from factories.yml
    $config = sfFactoryConfigHandler::getConfiguration($this->configuration->getConfigPaths('config/factories.yml'));

    $class = $config['i18n']['class'];
    $params = $config['i18n']['param'];
    unset($params['cache']);

    $extract = new zsI18nApplicationTranslateExtract(new $class($this->configuration, new sfNoCache(), $params), $culture);

    $extract->doTranslate($culture, true, 'es');
  }
}
