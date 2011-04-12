<?php

/**
 * BaseContentHasRegion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $region_id
 * @property integer $content_id
 * @property Region $Region
 * @property Content $Content
 * 
 * @method integer          getRegionId()   Returns the current record's "region_id" value
 * @method integer          getContentId()  Returns the current record's "content_id" value
 * @method Region           getRegion()     Returns the current record's "Region" value
 * @method Content          getContent()    Returns the current record's "Content" value
 * @method ContentHasRegion setRegionId()   Sets the current record's "region_id" value
 * @method ContentHasRegion setContentId()  Sets the current record's "content_id" value
 * @method ContentHasRegion setRegion()     Sets the current record's "Region" value
 * @method ContentHasRegion setContent()    Sets the current record's "Content" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseContentHasRegion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('content_has_region');
        $this->hasColumn('region_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('content_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));


        $this->index('IX_ContentHasRegion_1', array(
             'fields' => 
             array(
              0 => 'region_id',
              1 => 'content_id',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Region', array(
             'local' => 'region_id',
             'foreign' => 'id'));

        $this->hasOne('Content', array(
             'local' => 'content_id',
             'foreign' => 'id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}