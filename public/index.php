<?php

use Kev\App;

if (PHP_MAJOR_VERSION < 8) die("php version 8 or higher required");

require_once dirname(__DIR__).'/app/init.php';
require_once HELPERS.'functions.php';
require_once CONFIG.'routes.php';
new App();

//debug(\Kev\Router::getRoutes());

//var_dump($_SERVER);
//echo "Welcome";

//throw new Exception('Error creating');

//var_dump(App::$app->getProperties());