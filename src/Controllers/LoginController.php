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

    }

    public function setLoginToken()
    {
        $this->checkAuth();
        $this->app['session']->set('token', $this->facebookModel->getAccessToken(
            'authorization_code',
            ['code' => $this->app['request']->get('code')]
        ));
        $this->app['session']->set('accessToken', $this->facebookModel->getAccessToken(
            'authorization_code',
            ['code' => $this->app['request']->get('code')]
        )->accessToken);
        return $this->app->redirect('/');
    }

    public function getLogin()
    {
        $this->checkAuth();
        $authUrl = $this->facebookModel->getAuthUrl();
        $this->app['session']->set('oauth2state', $this->facebookModel->getAuthState());
        return $this->app->redirect($authUrl);
    }

    public function getLogout()
    {
        $this->destroyLoginToken();
    }
}
