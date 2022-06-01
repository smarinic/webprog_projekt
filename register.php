<?php

require_once('globals.php');
require_once(APP_ROOT . '/php/alert.message.handler.php');
require_once(APP_ROOT . '/php/users.controller.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
if ($_SESSION['is_auth'] == true) {
  redirectPage(APP_ROOT . '/index.php');
}

// HTML komponente - head i navbar
require_once(APP_ROOT . '/components/head.component.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    if (!preg_match("/^[a-zćčđšžA-ZĆČĐŠŽ\s]*$/", $_POST['first_name'])) {
      createAlertMessage('fail', 'U imenu smiju biti samo slova i razmak!');
      redirectPage('register.php');
    }
    if (!preg_match("/^[a-zćčđšžA-ZĆČĐŠŽ\s]*$/", $_POST['last_name'])) {
      createAlertMessage('fail', 'U prezimenu smiju biti samo slova i razmak!');
      redirectPage('register.php');
    }


    $firstName = clean_input($_POST["first_name"]);
    $lastName = clean_input($_POST["last_name"]);
    $email = clean_input($_POST["email"]);
    $isSuccess = createUser($firstName, $lastName, $email, $_POST['password']);

    if ($isSuccess) {
      createAlertMessage('success', 'Uspješna registracija! Možete se prijaviti u aplikaciju.');
      redirectPage('login.php');
    } else {
      createAlertMessage('fail', 'Registracija nije uspjela!');
      redirectPage('register.php');
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
        <div class="col col-md-3"></div>
        <div class="col col-md-6">
          <!-- ROW CENTRAL COLUMN  -->
          <?php
          echo (showAlertMessage());
          clearAlertMessage();
          require(APP_ROOT . '/components/registration.form.component.php');
          ?>
          <!-- END PAGE CONTENT  -->
        </div>
  </main>
  <?php
  include(APP_ROOT . '/components/footer.component.php');
  ?>
</body>

</html>