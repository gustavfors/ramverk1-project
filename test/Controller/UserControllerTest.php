<?php

namespace Gufo\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;

/**
 * Test the SampleController.
 */
class UserControllerTest extends TestCase
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

        $testDatabase->exec(file_get_contents(ANAX_INSTALL_PATH . "/sql/tables.sql"));
        
        \Gufo\DatabaseObject\DatabaseObject::setDatabase($testDatabase);
        
        $testDatabase->query('INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Jon", "Snow", "riforon770@nonicamy.com", "$2y$10$DBdO7KiEbbfp4vw2FTH7suQMDkScw8.p/def2x3elvK3fAsok6lL.")');
        $testDatabase->query('INSERT INTO "posts" ("title", "body", "user") VALUES ("test", "test", 1)');
        $testDatabase->query('INSERT INTO "votes" ("score", "post", "user") VALUES (1, 1, 1)');

        $this->controller = new \Gufo\User\UserController();
        $this->controller->setDI($this->di);
    }

    public function testShowActionGet()
    {
        $res = $this->controller->showActionGet(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testCreateActionGet()
    {
        $res = $this->controller->createActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testCreateActionPost()
    {
        $user = [
            "firstname" => "test",
            "lastname" => "test",
            "email" => "test@test.com",
        ];

        $password = "test123";

        $this->di->get("request")->setPost("user", $user);
        $this->di->get("request")->setPost("password", $password);

        $res = $this->controller->createActionPost();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testUpdateActionGet()
    {
        $this->di->get("session")->set("user", 1);

        $res = $this->controller->updateActionGet(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testUpdateActionPostOwner()
    {
        $this->di->get("session")->set("user", 1);

        $user = [
            "firstname" => "test",
            "lastname" => "test",
            "email" => "test@test.com",
        ];

        $password = "test123";

        $this->di->get("request")->setPost("user", $user);
        $this->di->get("request")->setPost("password", $password);

        $res = $this->controller->updateActionPost(1);

        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->di->get("session")->delete("user");
    }

    public function testUpdateActionNotOwner()
    {
        $this->di->get("session")->set("user", 2);

        $res = $this->controller->updateActionPost(1);

        $this->assertEquals('Unauthorized.', $res);

        $this->di->get("session")->delete("user");
    }

    public function testLoginActionGet()
    {
        $res = $this->controller->loginActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testLoginActionPost()
    {

        $email = "riforon770@nonicamy.com";
        $password = "password123";

      
        $this->di->get("request")->setPost("email", $email);
        $this->di->get("request")->setPost("password", $password);

        $res = $this->controller->loginActionPost();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testLogoutAction()
    {
        $res = $this->controller->logoutAction();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
