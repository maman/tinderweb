<?php

namespace tinderweb\Controllers;

use Silex\Application;

/**
 * Base Controller
 * ---------------
 * Setup an abstract class that will be referenced in
 * every controllers. This class injects Silex into
 * every controller avalaible.
 *
 * @package tinderweb\Controllers
 */
abstract class BaseController
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
