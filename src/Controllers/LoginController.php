<?php

namespace tinderweb\Controllers;

use Silex\Application;
use tinderweb\Model\FacebookModel;

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
        if ($this->app['request']->get('code') === null) {
            $authUrl = $this->facebookModel->getAuthUrl();
            $this->app['session']->set('oauth2state', $this->facebookModel->getAuthState());
            $this->app->redirect($authUrl);
        } elseif ($this->app['request']->get('state') === null || $this->app['request']->get('state') !== $this->app['session']->get('oauth2state')) {
            $this->app['session']->delete('oauth2state');
        } else {
            return 'yeaaaa';
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
