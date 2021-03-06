<?php

/**
 * BaseCitizenProposal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property clob $tip
 * 
 * @method integer         getId()  Returns the current record's "id" value
 * @method clob            getTip() Returns the current record's "tip" value
 * @method CitizenProposal setId()  Sets the current record's "id" value
 * @method CitizenProposal setTip() Sets the current record's "tip" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCitizenProposal extends Proposal
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('citizen_proposal');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('tip', 'clob', null, array(
             'type' => 'clob',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}