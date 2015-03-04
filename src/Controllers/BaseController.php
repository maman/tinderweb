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

    public function checkAuth()
    {
        if ($this->app['request']->get('code') === null) {
            return $this->app->redirect('/login');
        } elseif ($this->app['request']->get('state') === null || $this->app['request']->get('state') !== $this->app['session']->get('oauth2state')) {
            $this->app['session']->delete('oauth2state');
            return $this->app->redirect('/login');
        }
    }
}
