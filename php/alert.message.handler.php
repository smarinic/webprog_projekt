<?php
function showAlertMessage() {
  $message = '';
  if(isset($_SESSION['redirect_message']) && $_SESSION['redirect_message'] != '') {
    if($_SESSION['redirect_type'] == 'success') {
      $message = '<div class="alert alert-success" role="alert">' . $_SESSION['redirect_message'] . '</div>';
    }
    elseif($_SESSION['redirect_type'] = 'warning') {
      $message = '<div class="alert alert-warning" role="alert">' . $_SESSION['redirect_message'] . '</div>';
    }
    elseif($_SESSION['redirect_type'] = 'fail') {
      $message = '<div class="alert alert-danger" role="alert">' . $_SESSION['redirect_message'] . '</div>';
    }
  }
  return $message;
}
?>