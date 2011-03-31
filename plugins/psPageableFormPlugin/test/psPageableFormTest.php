<?php

require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/TestFormClasses.php';

$t = new lime_test(32);

$form = new psPageableForm();
try
{
  $page = $form->getCurrentPageNumber();
  $t->fail('exception should be thrown');
}
catch(Exception $e)
{
  $t->pass('page number is empty');
}

$form->setCurrentPageNumber(1);
$page = $form->getCurrentPageNumber();
$t->is($page, 1, 'page number has been set');

$invalidPages = array(0, 2);
foreach($invalidPages as $page)
{
  try
  {
    $form->setCurrentPageNumber(0);
    $form->bind(array());
    $t->fail('exception should be thrown, becouse page number is invalid');
  }
  catch(Exception $e)
  {
    $t->pass('set of invalid page number fails');
  }
}

$option = $form->getOption('name');
$t->is($option, null, 'get empty option');

$option = $form->getOption('name', 'name');
$t->is($option, 'name', 'get empty option, use default value');

$form->setOption('name', 'value');
$option = $form->getOption('name');
$t->is($option, 'value', 'get setted option');

$form->setOptions(array('name' => 'value2'));
$option = $form->getOption('name');
$t->is($option, 'value2', 'get setted option');

$pages = $form->getNumberOfForms();
$t->is($pages, 0, 'liczba formularzy');

$invalidForm = $form->getFirstInvalidForm();
$t->is($invalidForm, null, 'first invalid form is null');

try
{
  $currentForm = $form->getCurrentForm();
  $t->fail('exception should be thrown, becouse any form isn\'t set');
}
catch(Exception $e)
{
  $t->pass('current form dos\'t exist');
}

$persistanceStrategy = $form->getPersistanceStrategy();
$t->is($persistanceStrategy instanceof psPageableFormPersistanceStrategy, true, 'get persistance strategy object');

$form->setPersistanceStrategy(new psPageableFormPostPersistanceStrategy());
$persistData = $form->persist();
$t->is($persistData, '', 'empty persist data');

try
{
  $form->bind(array());
  $t->fail('exception should be thrown');
}
catch(Exception $e)
{
  $t->pass('empty form can\'t be bound');
}

$testForm1 = new Test1Form();
$form->addForm($testForm1);
$t->is($form->getNumberOfForms(), 1, 'get number of forms');

$testForm3 = new Test3Form();
$form->addForm($testForm3);

$form->setCurrentPageNumber(2);
$values = array();
$form->bind($values);
$t->is($form->isValid(), false, 'form is invalid');
$t->is($form->getFirstInvalidForm(), $testForm1, 'get first invalid form');

$form->setCurrentPageNumber(2);
$values = array('name' => 'name', 'email' => 'email@ohey.pl');
$form->bind($values);
$t->is($form->isValid(), true, 'form is valid');

$t->is($form->getValues(), $values, 'get form values');

$values = array_merge($values, array('phone' => 'valid phone number ;)'));
$form->setCurrentPageNumber(3);
$form->bind($values);
$t->is($form->isValid(), true, 'form is valid');

$values = array('name' => 'nazwa', 'phone' => 'valid phone number ;)', 'email' => 'invalid email address');
$form->bind($values);
$t->is($form->isValid(), false, 'form is invalid');
$t->is($form->getFirstInvalidForm(), $testForm1, 'get first invalid form');
$t->is($form->getValues(), array(), 'empty form values');

$values = array('name' => 'nazwa', 'email' => 'email@ohey.pl', 'phone' => '');
$form->bind($values);
$t->is($form->isValid(), false, 'form is invalid');
$t->is($form->getFirstInvalidForm(), $testForm3, 'get first invalid form');

$form->reset();
$t->info('test of form global namespace');
$form->setUseGlobalNamespace(false);
$form->setNameFormat('test[%s]');
$form->addForm(new Test1Form());
$form->addForm(new Test3Form());

$form->setCurrentPageNumber(2);
$values = array('name' => 'nazwa', 'email' => 'email@ohey.pl');
$form->bind(array('test1' => $values));
$t->is($form->isValid(), true, 'form is valid');
$cleanValues = $form->getValues();
$t->is($cleanValues, array('test1' => $values), 'get form values');

$form->reset();
$t->info('test of lazy creation of form objects');
$form->setUseGlobalNamespace(true);
$form->setNameFormat('test[%s]');
$form->addForm('Test1Form');
$form->addForm(array(
    'class' => 'Test4Form',
    'arguments' => array('first constructor\'s parameter', 'second constructor\'s parameter'),
));

try
{
  $t->ok($form->getForm(1) instanceof Test1Form, 'form has been successfully created');
  $t->ok($form->getForm(2) instanceof Test4Form, 'form has been successfully created');
}
catch(Exception $e)
{
  $t->fail('unexcepted exception: '.$e->getMessage());
}

$form->addForm(array(
    'class' => 'Test4Form',
    'arguments' => array('second constructor\'s parameter'),
));

try
{
  $form->getForm(3);
  $t->fail('exception should be thrown, becouse required constructor parameters for this form hasn\'t been passed');
}
catch(Exception $e)
{
  $t->pass('catch');
}

$form->reset();
$form->setUseGlobalNamespace(false);
$form->setNameFormat('test[%s]');
$form->addForm(new Test1Form());
$form->addForm(array(
    'class' => 'Test4Form',
    'arguments' => array('first constructor\'s parameter', 'second constructor\'s parameter'),
));

$form->setCurrentPageNumber(3);
$values = array(
    'test1' => array('name' => 'nazwa', 'email' => 'email@ohey.pl'),
    'test3' => array('phone' => ''),
);

$form->bind($values);
$t->is($form->isValid(), false, 'form isn\'t valid');

$values['test3']['phone'] = 1334;
$form->bind($values);

$t->ok($form->isValid(), 'form is valid');

$form->reset();
$form->setUseGlobalNamespace(false);
$form->setNameFormat('test[%s]');

$form->addForm(new Test1Form());
$form->addForm(new Test3Form());

$clonedForm = clone $form;

$form->mergeForm($clonedForm);

$t->is($form->getNumberOfForms(), 4, 'form has four subforms');

$values = array(
    'test1' => array('name' => 'nazwa', 'email' => 'email@ohey.pl'),
    'test3' => array('phone' => 1334),
);

$form->setCurrentPageNumber(5);
$form->bind($values);

$t->is($form->isValid(), false, 'form isn\'t valid');

$t->ok($form->getFirstInvalidForm() instanceof Test1Form, 'first invalid form is first form of merged pageable form');
$values['test'] = $values;

$fullValues = $values;

unset($values['test']['test3']);

$form->bind($values);
$t->is($form->isValid(), false, 'form isn\'t valid');

$t->ok($form->getFirstInvalidForm() instanceof Test3Form, 'first invalid form is second form of merged pageable form');

$form->bind($fullValues);
$t->is($form->isValid(), true, 'form is valid');