<?php

require_once('globals.php');

// Check user access (Admin = 1, Editor = 2, User = 3, Unregistered >3)
$requiredAccessLevel = 4;
checkAccess($requiredAccessLevel);

// Navbar component
require_once(APP_ROOT . '/components/head.component.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once(APP_ROOT . '/php/users.controller.php');
  require_once(APP_ROOT . '/php/alert.message.handler.php');

  if (!isset($_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['first_name'], $_POST['last_name'])) {
    createAlertMessage('fail', 'Neki podaci nisu poslani u formi za registraciju.');
    redirectPage('index.php');
  } else {
    if ($_POST['password'] != $_POST['password_confirm']) {
      createAlertMessage('fail', 'Unosi lozinke nisu isti!');
      redirectPage('register.php');
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      createAlertMessage('fail', 'E-mail adresa nije ispravna!');
      redirectPage('register.php');
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['first_name'])) {
      createAlertMessage('fail', 'U imenu smiju biti samo slova i razmak!');
      redirectPage('register.php');
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['last_name'])) {
      createAlertMessage('fail', 'U prezimenu smiju biti samo slova i razmak!');
      redirectPage('register.php');
    }

    if (!updateUser($_SESSION['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])) {
      createAlertMessage('fail', 'Podaci nisu uspješno promijenjeni!');
      redirectPage('index.php');
    } else {
      createAlertMessage('success', 'Podaci su uspješno promijenjeni! Prijavite se ponovo sa novim podacima.');
      redirectPage('logout.php');
    }
  }
}
?>

<body class="d-flex flex-column h-100">
  <?php
  include(APP_ROOT . '/components/navbar.component.php');
  ?>
  <main class="flex-shrink-0">
    <div class="container py-5 h-100">
      <!-- PAGE CONTENT  -->
      <div class="row">
        <div class="col col-md-2"></div>
        <div class="col col-md-8">
          <!-- ROW CENTRAL COLUMN  -->
          <?php
          require_once(APP_ROOT . '/components/edit.user.form.component.php');

          ?>


        </div>
        <div class="col col-md-2"></div>
      </div>
      <!-- END PAGE CONTENT  -->
    </div>
  </main>
  <?php
  include(APP_ROOT . '/components/footer.component.php');
  ?>
</body>

</html>