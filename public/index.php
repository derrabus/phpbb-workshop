<?php

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/../.env');
}

$env = $_SERVER['APP_ENV'] ?? 'dev';
$debug = $_SERVER['APP_DEBUG'] ?? ('prod' !== $env);

if ($debug) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts(explode(',', $trustedHosts));
}

$request = Request::createFromGlobals();

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $request->getScriptName())) {
    return false;
}

$kernel = new Kernel($env, $debug);
$response = $kernel->handle($request);

if (404 === $response->getStatusCode() && $request->attributes->has('legacyScript')) {
    $_SERVER['PHP_SELF'] = $request->attributes->get('PHP_SELF');

    extract($_REQUEST);
    extract($_SERVER);

    $HTTP_GET_VARS = $_GET;
    $HTTP_POST_VARS = $_POST;
    $HTTP_COOKIE_VARS = $_COOKIE;

    chdir(dirname($request->attributes->get('legacyScript')));

    ErrorHandler::register(null, true)->throwAt(0, true);

    global $container;
    $container = $kernel->getContainer();

    require $request->attributes->get('legacyScript');
} else {
    $response->send();
}

$kernel->terminate($request, $response);
