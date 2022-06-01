<?php
session_start();

// Set is_auth to FALSE if not initialized
if (!isset($_SESSION['is_auth'])) {
  $_SESSION['is_auth'] = false;
}

?>
