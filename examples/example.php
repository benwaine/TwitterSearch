<?php
require_once __DIR__ . '/../lib/Zend/Http/Client.php';

require_once __DIR__ . '/../TwitterSearch/Autoloader.php';

$autoloader = new TwitterSearch\Autoloader(null, __DIR__ . '/../lib');

$autoloader->register();

echo urlencode(':)');

?>
