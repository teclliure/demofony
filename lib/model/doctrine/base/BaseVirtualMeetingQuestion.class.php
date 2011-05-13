<?php

/**
 * BaseVirtualMeetingQuestion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property string $question
 * @property boolean $active
 * @property integer $virtual_meeting_id
 * @property sfGuardUser $sfGuardUser
 * @property VirtualMeeting $VirtualMeeting
 * @property VirtualMeetingAnswer $VirtualMeetingAnswer
 * 
 * @method integer                getId()                   Returns the current record's "id" value
 * @method integer                getUserId()               Returns the current record's "user_id" value
 * @method string                 getQuestion()             Returns the current record's "question" value
 * @method boolean                getActive()               Returns the current record's "active" value
 * @method integer                getVirtualMeetingId()     Returns the current record's "virtual_meeting_id" value
 * @method sfGuardUser            getSfGuardUser()          Returns the current record's "sfGuardUser" value
 * @method VirtualMeeting         getVirtualMeeting()       Returns the current record's "VirtualMeeting" value
 * @method VirtualMeetingAnswer   getVirtualMeetingAnswer() Returns the current record's "VirtualMeetingAnswer" value
 * @method VirtualMeetingQuestion setId()                   Sets the current record's "id" value
 * @method VirtualMeetingQuestion setUserId()               Sets the current record's "user_id" value
 * @method VirtualMeetingQuestion setQuestion()             Sets the current record's "question" value
 * @method VirtualMeetingQuestion setActive()               Sets the current record's "active" value
 * @method VirtualMeetingQuestion setVirtualMeetingId()     Sets the current record's "virtual_meeting_id" value
 * @method VirtualMeetingQuestion setSfGuardUser()          Sets the current record's "sfGuardUser" value
 * @method VirtualMeetingQuestion setVirtualMeeting()       Sets the current record's "VirtualMeeting" value
 * @method VirtualMeetingQuestion setVirtualMeetingAnswer() Sets the current record's "VirtualMeetingAnswer" value
 * 
 * @package    demofony
 * @subpackage model
 * @author     Marc Montañés <marc@teclliure.net>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVirtualMeetingQuestion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('virtual_meeting_question');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'unique' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('question', 'string', 1000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1000,
             ));
        $this->hasColumn('active', 'boolean', null, array(
             'default' => 1,
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('virtual_meeting_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('VirtualMeeting', array(
             'local' => 'virtual_meeting_id',
             'foreign' => 'id'));

        $this->hasOne('VirtualMeetingAnswer', array(
             'local' => 'id',
             'foreign' => 'virtual_meeting_question_id',
             'onDelete' => 'cascade'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}