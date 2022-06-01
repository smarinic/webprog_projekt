<?php


// Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Redirect user to URL.
 *
 * @param string $url URL to redirect to.
 * 
 */ 
function redirectPage($url) {
	header('Location: ' . $url);
	exit();
}

/**
 * Compares required access level with current user's access level.
 *
 * @param integer $roleId ID of minimum role needed for access.
 * 
 * @return bool Returns true if user is authorized to access, false if unauthorized.
 */ 
function checkAccess($roleId) {
  if($roleId < 4 && $_SESSION['is_auth'] == false) {
    return false;
  }
  // If user is not authorized for access, redirect him to index page
  if($_SESSION['user_role'] <= $roleId) {
    return true;
  }
  else {
    return false;
  }
}

/**
 * Checks if given page name is currently loaded PHP file.
 *
 * @param string $pageName Page filename without extension.
 * 
 * @return bool Returns true if given page is currently loaded file. False if page is different.
 */ 
function checkIfActivePage($pageName) {
  $activePage = basename($_SERVER['PHP_SELF'], ".php");
  if($activePage == $pageName) {
    return 'active';
  }
  else return false;
}

/**
 * Cleans user input by trimming, removing slashes and special characters.
 *
 * @param string $data String of user input to clean.
 * 
 * @return string Returns string with cleaned user input.
 */ 
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>