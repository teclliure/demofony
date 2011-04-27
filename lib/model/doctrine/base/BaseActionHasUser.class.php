<?php

/**
 * BaseActionHasUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $action_id
 * @property integer $user_id
 * @property string $type
 * @property sfGuardUser $sfGuardUser
 * 
 * @method integer       getActionId()    Returns the current record's "action_id" value
 * @method integer       getUserId()      Returns the current record's "user_id" value
 * @method string        getType()        Returns the current record's "type" value
 * @method sfGuardUser   getSfGuardUser() Returns the current record's "sfGuardUser" value
 * @method ActionHasUser setActionId()    Sets the current record's "action_id" value
 * @method ActionHasUser setUserId()      Sets the current record's "user_id" value
 * @method ActionHasUser setType()        Sets the current record's "type" value
 * @method ActionHasUser setSfGuardUser() Sets the current record's "sfGuardUser" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseActionHasUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('action_has_user');
        $this->hasColumn('action_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('type', 'string', 100, array(
             'primary' => true,
             'type' => 'string',
             'length' => 100,
             ));


        $this->index('IX_ActionHasUser_1', array(
             'fields' => 
             array(
              0 => 'action_id',
              1 => 'user_id',
              2 => 'type',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}