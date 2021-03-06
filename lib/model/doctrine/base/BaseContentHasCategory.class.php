<?php

/**
 * BaseContentHasCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $content_id
 * @property integer $category_id
 * @property string $type
 * @property Category $Category
 * 
 * @method integer            getContentId()   Returns the current record's "content_id" value
 * @method integer            getCategoryId()  Returns the current record's "category_id" value
 * @method string             getType()        Returns the current record's "type" value
 * @method Category           getCategory()    Returns the current record's "Category" value
 * @method ContentHasCategory setContentId()   Sets the current record's "content_id" value
 * @method ContentHasCategory setCategoryId()  Sets the current record's "category_id" value
 * @method ContentHasCategory setType()        Sets the current record's "type" value
 * @method ContentHasCategory setCategory()    Sets the current record's "Category" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContentHasCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('content_has_category');
        $this->hasColumn('content_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('category_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('type', 'string', 100, array(
             'primary' => true,
             'type' => 'string',
             'length' => 100,
             ));


        $this->index('IX_ContentHasCategory_1', array(
             'fields' => 
             array(
              0 => 'content_id',
              1 => 'category_id',
              2 => 'type',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Category', array(
             'local' => 'category_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}