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
    /**
     * Facebook Model object
     * @var FacebookModel
     */
    private $facebookModel;

    public function __construct(Application $app, FacebookModel $facebookModel)
    {
        parent::__construct($app);
        $this->facebookModel = $facebookModel;
    }

    private function destroyLoginToken()
    {
        $this->app['session']->remove('oauth2state');
        $this->app['session']->remove('token');
        $this->app['session']->remove('accessToken');
    }

    public function setLoginToken()
    {
        $token = $this->facebookModel->getAccessToken();
        $userDetails = $this->facebookModel->getUserDetails($token);
        $this->app['session']->set('token', $token);
        $this->app['session']->set('accessToken', $token->accessToken);
        $this->app['session']->set('uid', $userDetails->uid);
        return $this->app->redirect('/');
    }

    public function getLogin()
    {
        if ($this->isLoggedIn()) {
            $this->app->redirect('/');
        } else {
            $authUrl = $this->facebookModel->getAuthUrl();
            $this->app['session']->set('oauth2state', $this->facebookModel->getAuthState());
            return $this->app->redirect($authUrl);
        }
    }

    public function getLogout()
    {
        $this->destroyLoginToken();
        return $this->app->redirect('/');
    }
}
