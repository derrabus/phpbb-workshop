<?php

$targetFile = $_SERVER['REDIRECT_URL'];
if ($targetFile === '/') {
    $targetFile = '/index.php';
}
if (!file_exists(__DIR__.$targetFile)) {
    header('HTTP/1.1 404 Not Found');
    echo 'Not Found';
    exit;
}

$PHP_SELF = $targetFile;

extract($_REQUEST);

$HTTP_GET_VARS = $_GET;
$HTTP_POST_VARS = $_POST;
$HTTP_COOKIE_VARS = $_COOKIE;

require __DIR__.$targetFile;
