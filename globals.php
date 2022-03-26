<?php

define('APP_ROOT', __DIR__);

// true za koristenje fiksnih JSON-a u /test_data
// za koristenje API-ja prebaci na false
define('USE_FAKE_JSON_DATA', true);

require_once(APP_ROOT . '/php/session.php');
require_once(APP_ROOT . '/php/functions.php');
require_once(APP_ROOT . '/php/alert.message.handler.php');

?>