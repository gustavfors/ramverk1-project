<?php

namespace Gufo\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;

/**
 * Test the SampleController.
 */
class ApiControllerTest extends TestCase
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

        \Gufo\DatabaseObject\DatabaseObject::setDatabase($di->get("db"));

        // Setup the controller
        $this->controller = new \Gufo\Post\PostController();
        $this->controller->setDI($this->di);
    }

    public function testIpActionPostNoAddress()
    {
        $res = $this->controller->indexActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
