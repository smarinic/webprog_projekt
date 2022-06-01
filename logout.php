<?php

require_once('globals.php');

session_start();

session_destroy();
session_start();
require_once(APP_ROOT . '/php/alert.message.handler.php');
createAlertMessage('success', 'Uspješno ste odjavljeni iz aplikacije.');
header('Location: index.php');
?>