<?php

class zsI18nExtractTranslateTask extends sfI18nExtractTask
{
  protected function configure()
  {
    parent::configure();

    $this->name             = 'extract-translate';
    $this->briefDescription = 'Extracts i18n strings from php files and translates them with Google translation API';

    $this->detailedDescription = <<<EOF
Same functionality as standard i18n:extract but instead of a blank
target field, the message is translated with Google's translation API
EOF;

    $this->addOptions(array(
      new sfCommandOption('force-all', null, sfCommandOption::PARAMETER_NONE, 'Forces translation of all messages (**CAUTION** - will overwrite existing translations)')));

  }

  public function execute($arguments = array(), $options = array())
  {
    $culture = $arguments['culture'];

    $this->logSection('i18n', sprintf('extracting i18n strings for the "%s" application', $arguments['application']));

    // get i18n configuration from factories.yml
    $config = sfFactoryConfigHandler::getConfiguration($this->configuration->getConfigPaths('config/factories.yml'));

    $class = $config['i18n']['class'];
    $params = $config['i18n']['param'];
    unset($params['cache']);

    $extract = new zsI18nApplicationTranslateExtract(new $class($this->configuration, new sfNoCache(), $params), $culture);
    $extract->extract();

    $this->logSection('i18n', sprintf('found "%d" new i18n strings', count($extract->getNewMessages())));
    $this->logSection('i18n', sprintf('found "%d" old i18n strings', count($extract->getOldMessages())));

    if ($options['display-new'])
    {
      $this->logSection('i18n', sprintf('display new i18n strings', count($extract->getOldMessages())));
      foreach ($extract->getNewMessages() as $message)
      {
        $this->log('               '.$message."\n");
      }
    }

    if ($options['auto-save'] || $options['force-all'])
    {
      $this->logSection('i18n', 'saving new i18n strings');

      $extract->saveNewMessages();
    }

    if ($options['display-old'])
    {
      $this->logSection('i18n', sprintf('display old i18n strings', count($extract->getOldMessages())));
      foreach ($extract->getOldMessages() as $message)
      {
        $this->log('               '.$message."\n");
      }
    }

    if ($options['auto-delete'])
    {
      $this->logSection('i18n', 'deleting old i18n strings');

      $extract->deleteOldMessages();
    }

    $force = false;

    if ($options['force-all'])
    {
      $force = true;
    }

    $extract->doTranslate($culture, $force);    
  }
}
