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
    /**
     * Application object
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Check whether user is logged in via facebook or not.
     * @return boolean
     */
    public function isLoggedIn()
    {
        if ($this->app['session']->get('accessToken') === null) {
            return false;
        } else {
            return true;
        }
    }
}
