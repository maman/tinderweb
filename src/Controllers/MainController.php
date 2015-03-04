<?php

namespace tinderweb\Controllers;

use Silex\Application;
use tinderweb\Model\FacebookModel;

/**
 * Main Controller
 * ----------------
 * Responsible for rendering the main views, which in
 * turn will be rendered client-side via React.js
 *
 * @package tinderweb\Controllers;
 */
class MainController extends BaseController
{
    protected $facebookModel;
    protected $request;

    public function __construct(Application $app, FacebookModel $facebookModel)
    {
        parent::__construct($app);
        $this->facebookModel = $facebookModel;
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return $this->app['twig']->render('Pages/Index.twig');
        } else {
            return $this->app['twig']->render('Pages/Login.twig');
        }
    }
}
