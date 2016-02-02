<?php
use Jenssegers\Agent\Agent;
use Linker\Config\ConfigBlock;
use Linker\Config\FileConfig;
use Linker\Redirect;
use Linker\User;

define('ROOT', dirname(__DIR__));
include ROOT . '/vendor/autoload.php';

try {
    $config = (new FileConfig(url()))->get();
} catch (Exception $e) {
    http_response_code(404);
    exit("Not found");
}

$configBlock = new ConfigBlock($config);

$agent = new Agent();
$user = new User($agent);

$redirect = new Redirect($configBlock, $user);
$redirect->redirect($redirect->getUrl());
