<?php

require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/TestFormClasses.php';

$t = new lime_test(7);

//returns form values directly from session storage
function getValuesFromStorage($strategy, $storage)
{
  $key = $strategy->getAttributeKey();
  $attributes = $storage->read('symfony/user/sfUser/attributes');
  return $attributes['symfony/user/sfUser/attributes'][$strategy->getAttributeKey()];
}

$dispatcher = new sfEventDispatcher();
$storage = new sfSessionTestStorage(array(
  'session_path' => dirname(__FILE__).'/session',
));
$user = new sfUser($dispatcher, $storage, array());

$values = array('key1' => 'value1', 'key2' => 'value2');
$stubForm = new StubPageableForm($values);

$strategy = new psPageableFormSessionPersistanceStrategy($user);

$strategy->persist($stubForm);

$t->is($strategy->getValues(), $values, 'strategy has been filled');
$user->shutdown();

$strategy->clear();
$t->is($strategy->getValues(), array(), 'strategy values are empty');

$t->is(getValuesFromStorage($strategy, $storage), $values, 'storage values aren\'t empty');

$user->shutdown();
$t->is(getValuesFromStorage($strategy, $storage), array(), 'storage values are empty');


$strategy->setForceClear(true);

$strategy->persist($stubForm);
$t->is($strategy->getValues(), $values, 'strategy has been filled');
$user->shutdown();

$strategy->clear();
$t->is($strategy->getValues(), array(), 'strategy values are empty');
$t->is(getValuesFromStorage($strategy, $storage), array(), 'storage also are empty, becouse forceClear parameter has been set');

$storage->clear();