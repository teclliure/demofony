<?php

class demofonySendnewslettersTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name','frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'demofony';
    $this->name             = 'send-newsletters';
    $this->briefDescription = 'Send weekly newsletters';
    $this->detailedDescription = <<<EOF
The [demofony:send-newsletters|INFO] task does things.
Call it with:

  [php symfony demofony:send-newsletters|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    
    // load the Partial helper to be able to use get_partial()
    $contextInstance = sfContext::createInstance($this->configuration);
    $contextInstance->getConfiguration()->loadHelpers(array('Partial','I18N'));
    
    $startDate = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m',time()), date('d',time())-7, date('Y',time())));
    $endDate = date('Y-m-d 23:00:00',time());
    // $endDate = date('Y-m-d 00:00:00',time());
    $this->logSection('error', 'Start date '.$startDate);
    $this->logSection('error', 'End date '.$endDate);
    
    // add your code here
    $query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')->leftJoin('u.Profile p')->where('p.subscription_email = 1')->andWhere('u.is_active = 1');
    $this->logSection('error', 'Number users with subscription '.$query->count());
    
    $users = $query->execute();
    foreach ($users as $user) {
      $cats = $user->getProfile()->getCategories();
      $cat_ids = array();
      foreach ($cats as $cat) {
        $cat_ids[] = $cat->getId();
      }
      $regions = $user->getProfile()->getRegions();
      $reg_ids = array();
      foreach ($regions as $reg) {
        $reg_ids[] = $reg->getId();
      }
      $this->logSection('error', 'Number of cats '.count($cat_ids));
      $this->logSection('error', 'Number of regions '.count($reg_ids));
      
      $contents = Doctrine_Core::getTable('Content')->getObjectsUnion('ORDER BY created_at',null,$cat_ids,$reg_ids, "active = 1 AND (created_at >= '$startDate' AND created_at < '$endDate')", true);
      $this->logSection('error', 'Number of contents '.count($contents));
      
      if ($contents && count($contents)) {
        $message = Swift_Message::newInstance()
        ->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'from@noreply.com'))
        ->setTo($user->getEmailAddress(),$user)
        ->setSubject(__('Newsletter'))
        ->setBody(get_partial('mails/newsletterHtmlEmail',array('contents'=>$contents,'user'=>$user)), 'text/html');
            
        $contextInstance->getMailer()->send($message);
        $this->logSection('error', 'Sended email to '.$user. ' -> '.$user->getEmailAddress());
      }
      else {
        $this->logSection('error', 'No contents to send email to '.$user. ' -> '.$user->getEmailAddress());
      }
    }
  }
}
