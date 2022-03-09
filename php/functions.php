<?php

# Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Preusmjeri korisnika na zadanu adresu
function redirectPage($url) {
	header('Location: ' . $url);
	exit;
}

// Provjera razine pristupa
function checkAccess($roleId) {
  if($roleId < 4 && $_SESSION['is_auth'] == false) {
    return false;
  }
  // Ako je korisnik preniske razine pristupa, preusmjeri ga na pocetnu
  if($_SESSION['user_role'] <= $roleId) {
    return true;
  }
  else {
    return false;
  }
}

function checkIfActivePage($pageName) {
  $activePage = basename($_SERVER['PHP_SELF'], ".php");
  if($activePage == $pageName) {
    return 'active';
  }
  else return false;
}

?>