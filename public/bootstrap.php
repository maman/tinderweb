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
    $app->register(new \Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => SRC_DIR . 'Templates',
        'twig.options' => [
            'cache' => false,
            'optimizations' => 0
        ]
    ));
} else {
    $app->register(new \Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => SRC_DIR . 'Templates',
        'twig.options' => [
            'cache' => $app['conf']['app.layout.cache'],
            'optimizations' => -1
        ]
    ));
}

$app->register(new \Silex\Provider\ServiceControllerServiceProvider());
$app->register(new \Silex\Provider\SessionServiceProvider());
$app->before(function ($request) {
    $request->getSession()->start();
});
/**
 * Redis Session Provider
 * ----------------------
 * Replace built-in PHP Session backend with redis
 */
$app->register(new \Predis\Silex\ClientsServiceProvider(), array(
    'predis.clients' => array(
        'db'      => 'tcp://' . $app['conf']['app.redis.host'],
        'session' => array(
            'parameters' => 'tcp://' . $app['conf']['app.redis.host'],
            'options'    => array(
                'prefix' => $app['conf']['app.redis.prefix'] . ':'
            ),
        ),
    ),
));
$app->register(new \Silex\Provider\SessionServiceProvider(), array(
    'session.storage.handler' => $app->share(function () use ($app) {
        $client = $app['predis']['session'];
        $options = array('gc_maxlifetime' => 300);
        $handler = new \Predis\Session\Handler($client, $options);
        return $handler;
    })
));

/**
 * Dependency Injection
 * --------------------
 * Inject dependencies, so it can be lazy-loaded according
 * to the component needs.
 */

/** Model Injection */
$app['facebook.model'] = $app->share(function() use ($app) {
    return new \tinderweb\Model\FacebookModel(
        new \League\OAuth2\Client\Provider\Facebook([
            'clientId'        => $app['conf']['fb.client.id'],
            'clientSecret'    => $app['conf']['fb.client.secret'],
            'redirectUri'     => $app['conf']['fb.client.redirect'],
            'scopes'          => $app['conf']['fb.client.scopes'],
            'graphApiVersion' => 'v2.2'
        ]),
        new \League\OAuth2\Client\Grant\RefreshToken(),
        $app['request']
    );
});
$app['tinder.model'] = $app->share(function() use ($app) {
    return new \tinderweb\Model\TinderModel($app['facebook.model']);
});

/** Controller Injection */
$app['index.controller'] = $app->share(function () use ($app) {
    $facebookModel = $app['facebook.model'];
    return new \tinderweb\Controllers\MainController($app, $facebookModel);
});
$app['login.controller'] = $app->share(function () use ($app) {
    $facebookModel = $app['facebook.model'];
    return new \tinderweb\Controllers\LoginController($app, $facebookModel);
});
$app['api.controller'] = $app->share(function() use ($app) {
    $tinderModel = $app['tinder.model'];
    return new \tinderweb\Controllers\ApiController($app, $tinderModel);
});
