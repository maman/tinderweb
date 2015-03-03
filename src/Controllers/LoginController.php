<?php

namespace tinderweb\Controllers;

/**
 * Login Controller
 * ----------------
 * Responsible for user login/logout views and actions.
 *
 * @package tinderweb\Controllers;
 */
class LoginController extends BaseController
{
    private $facebookModel;

    public function __construct(Application $app, FacebookModel $facebookModel)
    {
        parent::__construct($app);
        $this->facebookModel = $facebookModel;
    }

    private function setLoginToken()
    {

    }

    private function destroyLoginToken()
    {

    }

    public function getLogin()
    {
        if ($app['request']->get('code') === null) {
            $authUrl = $this->facebookModel->getAuthUrl();
        } else {
            $this->app->redirect('/', 304);
        }
    }

    public function postLogin()
    {

    }

    public function getLogout()
    {
        $this->destroyLoginToken();
    }
}
