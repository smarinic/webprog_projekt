<?php

/**
 * Add alert message to display after redirect.
 *
 * @param string $type Type of message to show: 'success', 'warning' or 'fail'.
 * @param string $message Message to display to user.
 * 
 * @return void
 */
function createAlertMessage($type, $message) {
  $_SESSION['alert_type'] = $type;
  $_SESSION['alert_message'] = $message;
}

/**
 * Helper function for adding HTML element to top of web page for displaying alerts.
 * Use only in template, do not call directly.
 * 
 * @return void
 */
function showAlertMessage() {
  if(isset($_SESSION['alert_type'], $_SESSION['alert_message']))  {
    if($_SESSION['alert_type'] == 'success') {
      $message = '<div class="alert alert-success" role="alert">' . $_SESSION['alert_message'] . '</div>';
    }
    else if($_SESSION['alert_type'] = 'warning') {
      $message = '<div class="alert alert-warning" role="alert">' . $_SESSION['alert_message'] . '</div>';
    }
    else if($_SESSION['alert_type'] = 'fail') {
      $message = '<div class="alert alert-danger" role="alert">' . $_SESSION['alert_message'] . '</div>';
    }
  }
  else {
    $message = '';
  }
  return $message;
}

/**
 * Helper function for clearing alert message.
 * Use only in template, do not call directly.
 * 
 * @return void
 */
function clearAlertMessage() {
  unset($_SESSION['alert_type']);
  unset($_SESSION['alert_message']);
}
?>