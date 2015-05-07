<?php

require 'vendor/autoload.php';
require 'core/init.php';
require 'core/functions/utility.php';

$app = new \Slim\Slim([
    'view'             => new \Slim\Views\Twig(),
    'debug'            => true,
    'cookies.encrypt'  => true,
    'cookies.lifetime' => '20 minutes',
    'cookies.path'     => '/'
]);

$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '20 minutes',
    'path' => '/',
    'domain' => null,
    'secure' => false,
    'httponly' => true,
    'name' => 'sessioncookie',
    'secret' => 'RebdeMornayReb.',
    'cipher' => MCRYPT_RIJNDAEL_256,
    'cipher_mode' => MCRYPT_MODE_CBC
)));

// Database

$app->container->singleton('db', function() {
    return new PDO('mysql:host=127.0.0.1;dbname=blog_slim', 'root', 'password');
});

// Views
$view = $app->view();

$view->setTemplatesDirectory('app/views');
$view->parserExtensions = [
    new \Slim\Views\TwigExtension(),
];

require 'routes.php';

$app->run();

