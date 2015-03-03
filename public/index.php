<?php

/**
 * Index PHP file
 * --------------
 * Act as the application entry point
 * when accessed via client's web browser.
 */

require __DIR__ . "/../vendor/autoload.php";

require "bootstrap.php";

$tinderweb = new \tinderweb\Core\Application($app);
$tinderweb->mountControllers();
$tinderweb->run();
