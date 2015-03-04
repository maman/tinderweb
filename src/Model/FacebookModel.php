<?php

namespace tinderweb\Model;

use League\OAuth2\Client\Provider\Facebook as FacebookProvider;
use League\OAuth2\Client\Grant\RefreshToken as GrantRefreshToken;
use Symfony\Component\HttpFoundation\Request as Request;

/**
 * Facebook Model Class
 * --------------------
 * This file is responsible to bridging the
 * app to Facebook.
 *
 * @package tinderweb\Model
 */
class FacebookModel
{
    /**
     * Facebook Provider object
     * @var FacebookProvider
     */
    private $facebookProvider;

    /**
     * Grant Refresh Token object
     * @var GrantRefreshToken
     */
    private $grantRefreshToken;

    /**
     * Request object
     * @var Request
     */
    private $request;

    /**
     * Facebook token
     * @var string
     */
    private $token = '';

    /**
     * Construct FacebookModel Class
     * @param FacebookProvider  $facebookProvider
     * @param GrantRefreshToken $grantRefreshToken
     * @param Request           $request
     */
    public function __construct(
        FacebookProvider $facebookProvider,
        GrantRefreshToken $grantRefreshToken,
        Request $request
    ) {
        $this->facebookProvider = $facebookProvider;
        $this->grantRefreshToken = $grantRefreshToken;
        $this->request = $request;
    }

    /**
     * Get Provider
     * @return FacebookProvider
     */
    public function getProvider()
    {
        return $this->facebookProvider;
    }

    /**
     * Get GrantRefreshToken
     * @return GrantRefreshToken
     */
    public function getGrantRefreshToken()
    {
        return $this->grantRefreshToken;
    }

    /**
     * Get Facebook access token
     * @return string
     */
    public function getAccessToken()
    {
        $this->token = $this->facebookProvider->getAccessToken(
            'authorization_code',
            ['code' => $this->request->get('code')]
        );
        return $this->token;
    }

    /**
     * Refresh Facebook access token
     * @return string
     */
    public function getRefreshToken()
    {
        $this->token = $this->facebookProvider->getAccessToken(
            $this->grantRefreshToken,
            ['refreshToken' => $this->token->refreshToken]
        );
        return $this->token;
    }

    /**
     * Get Facebook authentication URL
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->facebookProvider->getAuthorizationUrl();
    }

    /**
     * Get Facebook authentication state
     * @return boolean
     */
    public function getAuthState()
    {
        return $this->facebookProvider->state;
    }

    /**
     * Get Facebook User ID
     * @return string
     */
    public function getUserId()
    {
        return $this->facebookProvider->getUserid();
    }
}
