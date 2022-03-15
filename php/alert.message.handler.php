<?php

function createAlertMessage($type, $message) {
  $_SESSION['alert_type'] = $type;
  $_SESSION['alert_message'] = $message;
}

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

function clearAlertMessage() {
  unset($_SESSION['alert_type']);
  unset($_SESSION['alert_message']);
}
?>