<?php

/**
 * BaseCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $Profiles
 * @property Doctrine_Collection $ContentHasCategory
 * @property Doctrine_Collection $SubscriptionCategory
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getName()                 Returns the current record's "name" value
 * @method string              getDescription()          Returns the current record's "description" value
 * @method Doctrine_Collection getProfiles()             Returns the current record's "Profiles" collection
 * @method Doctrine_Collection getContentHasCategory()   Returns the current record's "ContentHasCategory" collection
 * @method Doctrine_Collection getSubscriptionCategory() Returns the current record's "SubscriptionCategory" collection
 * @method Category            setId()                   Sets the current record's "id" value
 * @method Category            setName()                 Sets the current record's "name" value
 * @method Category            setDescription()          Sets the current record's "description" value
 * @method Category            setProfiles()             Sets the current record's "Profiles" collection
 * @method Category            setContentHasCategory()   Sets the current record's "ContentHasCategory" collection
 * @method Category            setSubscriptionCategory() Sets the current record's "SubscriptionCategory" collection
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('category');
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
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardUserProfile as Profiles', array(
             'refClass' => 'SubscriptionCategory',
             'local' => 'category_id',
             'foreign' => 'user_id'));

        $this->hasMany('ContentHasCategory', array(
             'local' => 'id',
             'foreign' => 'category_id'));

        $this->hasMany('SubscriptionCategory', array(
             'local' => 'id',
             'foreign' => 'category_id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}