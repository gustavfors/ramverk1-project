<?php

namespace Gufo\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;

/**
 * Test the SampleController.
 */
class ReplyControllerTest extends TestCase
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

        $testDatabase = \Gufo\Sqlite\Sqlite::connectMemory();

        $testDatabase->exec(file_get_contents(ANAX_INSTALL_PATH . "\\sql\\tables.sql"));
        
        \Gufo\DatabaseObject\DatabaseObject::setDatabase($testDatabase);
        
        $testDatabase->query('INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Jon", "Snow", "riforon770@nonicamy.com", "pass123")');
        $testDatabase->query('INSERT INTO "posts" ("title", "body", "user") VALUES ("test", "test", 1)');
        $testDatabase->query('INSERT INTO "votes" ("score", "post", "user") VALUES (1, 1, 1)');

        $this->controller = new \Gufo\Reply\ReplyController();
        $this->controller->setDI($this->di);
    }

    public function testShowActionGet()
    {
        $res = $this->controller->showActionGet(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testUpdateActionGetOwner()
    {
        $this->di->get("session")->set("user", 1);

        $res = $this->controller->updateActionGet(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testCreateActionPostNotLoggedIn()
    {
        $res = $this->controller->createActionPost(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testCreateActionPostLoggedIn()
    {
        $this->di->get("session")->set("user", 1);

        $this->di->get("request")->setPost("body", "test");

        $res = $this->controller->createActionPost(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testUpdateActionGetNotOwner()
    {
        $res = $this->controller->updateActionGet(1);

        $this->assertEquals('Unauthorized.', $res);
    }

    public function testUpdateActionPostNotOwner()
    {
        $res = $this->controller->updateActionGet(1);

        $this->assertEquals('Unauthorized.', $res);
    }

    public function testUpdateActionPostOwner()
    {
        $this->di->get("session")->set("user", 1);

        $this->di->get("request")->setPost("body", "test");

        $res = $this->controller->updateActionGet(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }
}
