<?php

use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/vendor/autoload.php';

$request = Request::createFromGlobals();

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $request->getScriptName())) {
    return false;
}

$targetFile = $request->getPathInfo();

if ($targetFile === '/') {
    $targetFile = '/index.php';
}
$scriptsDir = dirname(__DIR__).'/scripts';
if (!file_exists($scriptsDir.$targetFile)) {
    header('HTTP/1.1 404 Not Found');
    echo 'Not Found';
    exit;
}

$PHP_SELF = $targetFile;

extract($_REQUEST);
extract($_SERVER);

$HTTP_GET_VARS = $_GET;
$HTTP_POST_VARS = $_POST;
$HTTP_COOKIE_VARS = $_COOKIE;

chdir(dirname($scriptsDir.$targetFile));

ini_set('display_errors', false);

require $scriptsDir.$targetFile;
