<?php

/**
 * BaseOpinionPossibility
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $gmap_bubble_color
 * @property string $icon
 * @property integer $opinion_possibility_group_id
 * @property OpinionPossibilityGroup $OpinionPossibilityGroup
 * @property Doctrine_Collection $Opinion
 * 
 * @method integer                 getId()                           Returns the current record's "id" value
 * @method string                  getName()                         Returns the current record's "name" value
 * @method string                  getGmapBubbleColor()              Returns the current record's "gmap_bubble_color" value
 * @method string                  getIcon()                         Returns the current record's "icon" value
 * @method integer                 getOpinionPossibilityGroupId()    Returns the current record's "opinion_possibility_group_id" value
 * @method OpinionPossibilityGroup getOpinionPossibilityGroup()      Returns the current record's "OpinionPossibilityGroup" value
 * @method Doctrine_Collection     getOpinion()                      Returns the current record's "Opinion" collection
 * @method OpinionPossibility      setId()                           Sets the current record's "id" value
 * @method OpinionPossibility      setName()                         Sets the current record's "name" value
 * @method OpinionPossibility      setGmapBubbleColor()              Sets the current record's "gmap_bubble_color" value
 * @method OpinionPossibility      setIcon()                         Sets the current record's "icon" value
 * @method OpinionPossibility      setOpinionPossibilityGroupId()    Sets the current record's "opinion_possibility_group_id" value
 * @method OpinionPossibility      setOpinionPossibilityGroup()      Sets the current record's "OpinionPossibilityGroup" value
 * @method OpinionPossibility      setOpinion()                      Sets the current record's "Opinion" collection
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOpinionPossibility extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('opinion_possibility');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('gmap_bubble_color', 'string', 7, array(
             'type' => 'string',
             'length' => 7,
             ));
        $this->hasColumn('icon', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('opinion_possibility_group_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('OpinionPossibilityGroup', array(
             'local' => 'opinion_possibility_group_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Opinion', array(
             'local' => 'id',
             'foreign' => 'opinion_possibility_id'));
    }
}