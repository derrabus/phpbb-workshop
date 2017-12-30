<?php

require dirname(__DIR__).'/vendor/autoload.php';

$targetFile = $_SERVER['REDIRECT_URL'];
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

require $scriptsDir.$targetFile;
