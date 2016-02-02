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
    exit("File does not exists");
}

$configBlock = new ConfigBlock($config);

$agent = new Agent();
$user = new User($agent);

$redirect = new Redirect($configBlock, $user);
?>

locale: <?= $user->getLocale() ?><br>
platform: <?= $user->getPlatform() ?><br>
os: <?= $user->getOS() ?><br>

locales: <pre><?= print_r($agent->languages()) ?></pre>

url to redirect: <?= $redirect->getUrl() ?><br>

<pre>
    <?php print_r($_SERVER) ?>
</pre>
