<?php
// Pokreni sesiju
session_start();

// Postavi is_auth na FALSE ako nije inicijaliziran
if (!isset($_SESSION['is_auth'])) {
  $_SESSION['is_auth'] = false;
}

?>
