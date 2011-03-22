<?php

/**
 * BaseSubscriptionRegion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_profile_id
 * @property integer $region_id
 * @property SfGuardUserProfile $SfGuardUserProfile
 * @property Region $Region
 * 
 * @method integer            getUserProfileId()      Returns the current record's "user_profile_id" value
 * @method integer            getRegionId()           Returns the current record's "region_id" value
 * @method SfGuardUserProfile getSfGuardUserProfile() Returns the current record's "SfGuardUserProfile" value
 * @method Region             getRegion()             Returns the current record's "Region" value
 * @method SubscriptionRegion setUserProfileId()      Sets the current record's "user_profile_id" value
 * @method SubscriptionRegion setRegionId()           Sets the current record's "region_id" value
 * @method SubscriptionRegion setSfGuardUserProfile() Sets the current record's "SfGuardUserProfile" value
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
        $this->hasColumn('user_profile_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('region_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('SfGuardUserProfile', array(
             'local' => 'user_profile_id',
             'foreign' => 'id'));

        $this->hasOne('Region', array(
             'local' => 'region_id',
             'foreign' => 'id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}