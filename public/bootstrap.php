<?php

/**
 * Bootstrap file
 * --------------
 * Bootstrapping the application
 */

define("SRC_DIR", __DIR__ . "/../src/");
define("PUBLIC_DIR", __DIR__);

$app = new \Silex\Application();

$app['conf'] = require SRC_DIR . "Config/Config.php";
$app['debug'] = ($app['conf']['app.environment'] == 'development' ? true : false);
if ($app['debug']) {
    $app->register(new \Whoops\Provider\Silex\WhoopsServiceProvider());
    $app->register(new \Dongww\Silex\Provider\DebugBarServiceProvider());
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => SRC_DIR.'Templates',
        'twig.options' => [
            'cache' => false,
            'optimizations' => 0
        ]
    ));
} else {
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => SRC_DIR.'Templates',
        'twig.options' => [
            'cache' => $app['conf']['app.layout.cache'],
            'optimizations' => -1
        ]
    ));
}

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

/**
 * Dependency Injection
 * --------------------
 * Inject dependencies, so it can be lazy-loaded according
 * to the component needs.
 */

/** Symfony session, request, and response Injection */
$app['session'] = function () use ($app) {
    return \Symfony\Component\HttpFoundation\Session;
};
$app['request'] = function () use ($app) {
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
};
$app['response'] = function () use ($app) {
    return \Symfony\Component\HttpFoundation\Response;
};

/** Model Injection */
$app['facebookModel'] = function () use ($app) {
    $clientID = $app['conf']['fb.client.id'];
    $clientSecret = $app['conf']['fb.client.secret'];
    $redirectURI = $app['conf']['fb.client.redirect'];
    $scopes = $app['conf']['fb.client.scopes'];
    return new \tinderweb\Model\FacebookModel(
        new \League\OAuth2\Client\Provider\Facebook([
            'clientId' => $clientID,
            'clientSecret' => $clientSecret,
            'redirectUri' => $redirectURI,
            'scopes' => $scopes
        ]),
        new \League\OAuth2\Client\Grant\RefreshToken(),
        $app['request']
    );
};

/** Controller Injection */
$app['index.controller'] = $app->share(function () use ($app) {
    return new \tinderweb\Controllers\MainController($app, $app['facebookModel']);
});
$app['login.controller'] = $app->share(function () use ($app) {
    return new \tinderweb\Controllers\LoginController($app, $app['facebookModel']);
});
