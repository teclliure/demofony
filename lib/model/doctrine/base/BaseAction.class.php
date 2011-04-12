<?php

/**
 * BaseAction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $ActionHasUser
 * 
 * @method Doctrine_Collection getUsers()         Returns the current record's "Users" collection
 * @method Doctrine_Collection getActionHasUser() Returns the current record's "ActionHasUser" collection
 * @method Action              setUsers()         Sets the current record's "Users" collection
 * @method Action              setActionHasUser() Sets the current record's "ActionHasUser" collection
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseAction extends Content
{
    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'ActionHasUser',
             'local' => 'action_id',
             'foreign' => 'user_id'));

        $this->hasMany('ActionHasUser', array(
             'local' => 'id',
             'foreign' => 'action_id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}