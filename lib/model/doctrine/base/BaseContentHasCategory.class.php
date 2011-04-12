<?php

/**
 * BaseContentHasCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $category_id
 * @property integer $content_id
 * @property Category $Category
 * @property Content $Content
 * 
 * @method integer            getCategoryId()  Returns the current record's "category_id" value
 * @method integer            getContentId()   Returns the current record's "content_id" value
 * @method Category           getCategory()    Returns the current record's "Category" value
 * @method Content            getContent()     Returns the current record's "Content" value
 * @method ContentHasCategory setCategoryId()  Sets the current record's "category_id" value
 * @method ContentHasCategory setContentId()   Sets the current record's "content_id" value
 * @method ContentHasCategory setCategory()    Sets the current record's "Category" value
 * @method ContentHasCategory setContent()     Sets the current record's "Content" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseContentHasCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('content_has_category');
        $this->hasColumn('category_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('content_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));


        $this->index('IX_ContentHasCategories_1', array(
             'fields' => 
             array(
              0 => 'category_id',
              1 => 'content_id',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Category', array(
             'local' => 'category_id',
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