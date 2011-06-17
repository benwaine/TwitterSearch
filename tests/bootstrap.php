<?php
require_once __DIR__ . '/../lib/Zend/Http/Client.php';

require_once __DIR__ . '/../TwitterSearch/Autoloader.php';

require_once 'Helper/TweetProvider.php';

require_once 'Mockery/Loader.php';

set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__dir__ . '/../lib'));

$autoloader = new TwitterSearch\Autoloader('TwitterSearch', __DIR__ . '/..');

$autoloader->register();

$loader = new \Mockery\Loader;
$loader->register();



?>
