<?php

/**
 * BaseWebsiteProject
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $website_id
 * @property string $name
 * @property Website $Website
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $WebsiteProject2sfGuardUser
 * 
 * @method integer             getWebsiteId()                  Returns the current record's "website_id" value
 * @method string              getName()                       Returns the current record's "name" value
 * @method Website             getWebsite()                    Returns the current record's "Website" value
 * @method Doctrine_Collection getUsers()                      Returns the current record's "Users" collection
 * @method Doctrine_Collection getWebsiteProject2sfGuardUser() Returns the current record's "WebsiteProject2sfGuardUser" collection
 * @method WebsiteProject      setWebsiteId()                  Sets the current record's "website_id" value
 * @method WebsiteProject      setName()                       Sets the current record's "name" value
 * @method WebsiteProject      setWebsite()                    Sets the current record's "Website" value
 * @method WebsiteProject      setUsers()                      Sets the current record's "Users" collection
 * @method WebsiteProject      setWebsiteProject2sfGuardUser() Sets the current record's "WebsiteProject2sfGuardUser" collection
 * 
 * @package    cms
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWebsiteProject extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('website_project');
        $this->hasColumn('website_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Website', array(
             'local' => 'website_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'WebsiteProject2sfGuardUser',
             'local' => 'website_project_id',
             'foreign' => 'sf_guard_user_id'));

        $this->hasMany('WebsiteProject2sfGuardUser', array(
             'local' => 'id',
             'foreign' => 'website_project_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}