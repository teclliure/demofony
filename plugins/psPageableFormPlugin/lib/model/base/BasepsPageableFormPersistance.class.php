<?php

/**
 * @property string $id
 * @property array $cleanValues
 * 
 * @method string                    getId()          Returns the current record's "id" value
 * @method array                     getCleanValues() Returns the current record's "cleanValues" value
 * @method psPageableFormPersistance setId()          Sets the current record's "id" value
 * @method psPageableFormPersistance setCleanValues() Sets the current record's "cleanValues" value
 * 
 * @subpackage model
 * @author     Piotr Śliwa <peter.pl7@gmail.com>
 * @version    SVN: $Id: BasepsPageableFormPersistance.class.php 2 2010-08-15 13:58:46Z peter.pl7@gmail.com $
 */
abstract class BasepsPageableFormPersistance extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ps_pageable_form_persistance');
        $this->hasColumn('id', 'string', 32, array(
             'type' => 'string',
             'primary' => true,
             'length' => 32,
             ));
        $this->hasColumn('cleanValues', 'array', null, array(
             'type' => 'array',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}