<?php

/**
 * BaseOpinionMarkedAsSpam
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property integer $opinion_id
 * @property sfGuardUser $sfGuardUser
 * @property Opinion $Opinion
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method integer             getUserId()      Returns the current record's "user_id" value
 * @method integer             getOpinionId()   Returns the current record's "opinion_id" value
 * @method sfGuardUser         getSfGuardUser() Returns the current record's "sfGuardUser" value
 * @method Opinion             getOpinion()     Returns the current record's "Opinion" value
 * @method OpinionMarkedAsSpam setId()          Sets the current record's "id" value
 * @method OpinionMarkedAsSpam setUserId()      Sets the current record's "user_id" value
 * @method OpinionMarkedAsSpam setOpinionId()   Sets the current record's "opinion_id" value
 * @method OpinionMarkedAsSpam setSfGuardUser() Sets the current record's "sfGuardUser" value
 * @method OpinionMarkedAsSpam setOpinion()     Sets the current record's "Opinion" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOpinionMarkedAsSpam extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('opinion_marked_as_spam');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('opinion_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('Opinion', array(
             'local' => 'opinion_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}