<?php

namespace Gufo\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;

/**
 * Test the SampleController.
 */
class VoteControllerTest extends TestCase
{
    // Create the di container.
    protected $di;
    protected $controller;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIMagic();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        $testDatabase = \Gufo\Sqlite\Sqlite::connect();
        $testDatabase = \Gufo\Sqlite\Sqlite::connectMemory();

        $testDatabase->exec(file_get_contents(ANAX_INSTALL_PATH . "\\sql\\tables.sql"));
        
        \Gufo\DatabaseObject\DatabaseObject::setDatabase($testDatabase);
        
        $testDatabase->query('INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Jon", "Snow", "riforon770@nonicamy.com", "$2y$10$DBdO7KiEbbfp4vw2FTH7suQMDkScw8.p/def2x3elvK3fAsok6lL.")');
        $testDatabase->query('INSERT INTO "posts" ("title", "body", "user") VALUES ("test", "test", 1)');
        $testDatabase->query('INSERT INTO "votes" ("score", "post", "user") VALUES (1, 1, 1)');

        $this->controller = new \Gufo\Vote\VoteController();
        $this->controller->setDI($this->di);
    }

    public function testUpActionPostValid()
    {
        $this->di->get("session")->set("user", 1);

        $res = $this->controller->upActionPost(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testUpActionPostInvalidPost()
    {
        $this->di->get("session")->set("user", 1);

        $res = $this->controller->upActionPost(2);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testUpActionPostInvalidUser()
    {
        $this->di->get("session")->set("user", 2);

        $res = $this->controller->upActionPost(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testDownActionPostValid()
    {
        $this->di->get("session")->set("user", 1);

        $res = $this->controller->downActionPost(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testDownActionPostInvalidPost()
    {
        $this->di->get("session")->set("user", 1);

        $res = $this->controller->downActionPost(2);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testDownActionPostInvalidUser()
    {
        $this->di->get("session")->set("user", 2);

        $res = $this->controller->downActionPost(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }
}
