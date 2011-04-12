<?php

/**
 * BaseSubscriptionRegion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $region_id
 * @property sfGuardUserProfile $sfGuardUserProfile
 * @property Region $Region
 * 
 * @method integer            getUserId()             Returns the current record's "user_id" value
 * @method integer            getRegionId()           Returns the current record's "region_id" value
 * @method sfGuardUserProfile getSfGuardUserProfile() Returns the current record's "sfGuardUserProfile" value
 * @method Region             getRegion()             Returns the current record's "Region" value
 * @method SubscriptionRegion setUserId()             Sets the current record's "user_id" value
 * @method SubscriptionRegion setRegionId()           Sets the current record's "region_id" value
 * @method SubscriptionRegion setSfGuardUserProfile() Sets the current record's "sfGuardUserProfile" value
 * @method SubscriptionRegion setRegion()             Sets the current record's "Region" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseSubscriptionRegion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('subscription_region');
        $this->hasColumn('user_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('region_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));


        $this->index('IX_SubscriptionRegion_1', array(
             'fields' => 
             array(
              0 => 'user_id',
              1 => 'region_id',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUserProfile', array(
             'local' => 'user_id',
             'foreign' => 'user_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Region', array(
             'local' => 'region_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}