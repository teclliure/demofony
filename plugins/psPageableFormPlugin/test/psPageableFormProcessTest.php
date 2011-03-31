<?php

require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/TestFormClasses.php';

$dispatcher = new sfEventDispatcher();
$request = new sfWebRequest($dispatcher);
$request->setMethod('post');

$t = new lime_test(24);

$form = new psPageableForm();
$form->setUseGlobalNamespace(false);
$form->setNameFormat('values[%s]');
$testForm1 = new Test1Form();
$form->addForm($testForm1);

try
{
  $process = new psPageableFormProcess($form, $request, array());
  $t->fail('exception should be thrown, becouse not all required options has been pass');
}
catch(InvalidArgumentException $e)
{
  $t->pass('required options hasn\'t been pass');
}

$request->setParameter('values', array('test1' => array(
  'name' => 'name',
  'email' => 'email@ohey.pl',
)));

$process = new psPageableFormProcess($form, $request, array('formParameterName' => 'values'));

$request->getAttributeHolder()->clear();
$t->is($process->process(), false, 'form isn\'t fully valid');
$t->is($form->isValid(), true, 'form is valid');
$t->is($form->getValues(), array(), 'values are empty');

$request->setParameter('step', 2);
$process = new psPageableFormProcess($form, $request, array('formParameterName' => 'values'));

$request->getAttributeHolder()->clear();
$t->ok($process->process(), 'form is fully valid');
$t->is($form->isValid(), true, 'form is valid');
$t->isnt($form->getValues(), array(), 'values aren\'t empty');
$t->is($request->getParameter('step'), 2, 'second step');

$process = new psPageableFormProcess($form, $request, array('formParameterName' => 'values'));

$testForm2 = new Test2Form();
$form->addForm($testForm2);
$values = array(
  'test1' => array(
    'name' => '',
    'email' => 'email@ohey.pl',
  ),
  'test2' => array(
    'name' => 'valid',
    'email' => 'email@ohey.pl',
  ),
);
$request->setParameter('values', $values);

$request->getAttributeHolder()->clear();
$t->is($process->process(), false, 'form isn\'t fully valid');
$t->is($form->isValid(), false, 'form is invalid');
$t->ok($form->getFirstInvalidForm() == $testForm1, 'get first invalid form');
$t->is($request->getParameter('step'), 1, 'first step');

$values['test1']['name'] = 'valid';
$values['test2']['name'] = 'i';
$request->setParameter('values', $values);
$request->setParameter('step', 3);

$process->reset();

$t->is($process->process(), false, 'form isn\'t fully valid');

$t->is($form->isValid(), false, 'form is invalid');
$t->ok($form->getFirstInvalidForm() == $testForm2, 'get first invalid form');
$t->is($request->getParameter('step'), 2, 'second step');

$values['test1']['name'] = 'i';
$request->setParameter('values', $values);

$process->reset();
$process->process();

$t->is($form->isValid(), false, 'form is invalid');
$t->ok($form->getFirstInvalidForm() == $testForm1, 'get first invalid form');
$t->is($request->getParameter('step'), 1, 'first step');

$process = new psPageableFormProcess($form, $request, array('formParameterName' => 'values'));
$request->setParameter('step', 3);
$values['test1']['name'] = $values['test2']['name'] = 'valid';

$request->setParameter('values', $values);

$t->ok($process->process(), 'form is fully valid');

$t->is($form->isValid(), true, 'form is valid');
try
{
  $form->getCurrentForm();
  $t->fail('exception should be thrown');
}
catch(Exception $e)
{
  $t->pass('there no form for third page');
}
$t->is($form->getValues(), $values, 'get values');
$t->is($request->getParameter('step'), 3, 'third page');