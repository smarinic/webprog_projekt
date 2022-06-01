<?php

define('APP_ROOT', __DIR__);

// set to true to use fake JSON data from local file for testing
// set to false to use web API to fetch JSON
define('USE_FAKE_JSON_DATA', false);

require_once(APP_ROOT . '/php/session.php');
require_once(APP_ROOT . '/php/functions.php');
require_once(APP_ROOT . '/php/alert.message.handler.php');

?>