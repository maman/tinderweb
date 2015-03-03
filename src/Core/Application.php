<?php

namespace tinderweb\Core;

use Silex\Application as SilexApp;

/**
 * Application Class
 * -----------------
 * This file is reponsible to construct and run
 * the tinderweb web application
 *
 * @package tinderweb\Core
 */
class Application
{
    protected $app;

    public function __construct(SilexApp $app)
    {
        $this->app = $app;
    }

    public function run()
    {
        $this->app->run();
    }

    public function mountControllers()
    {
        $app = $this->app;
        $routes = require __DIR__ . '/Routes.php';
        foreach ($routes as $route) {
            $this->app->match(
                $route['route'],
                $route['service'] . ':' . $route['method']
            )->method($route['httpMethod']);
        }
    }
}
