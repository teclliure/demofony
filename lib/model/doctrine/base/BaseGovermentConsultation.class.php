<?php

/**
 * BaseGovermentConsultation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $start_date
 * @property date $end_date
 * 
 * @method integer               getId()         Returns the current record's "id" value
 * @method date                  getStartDate()  Returns the current record's "start_date" value
 * @method date                  getEndDate()    Returns the current record's "end_date" value
 * @method GovermentConsultation setId()         Sets the current record's "id" value
 * @method GovermentConsultation setStartDate()  Sets the current record's "start_date" value
 * @method GovermentConsultation setEndDate()    Sets the current record's "end_date" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseGovermentConsultation extends Proposal
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('goverment_consultation');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('start_date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('end_date', 'date', null, array(
             'type' => 'date',
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