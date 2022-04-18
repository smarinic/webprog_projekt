<?php

require_once('globals.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 4;
checkAccess($requiredAccessLevel);

// include
require_once(APP_ROOT . '/php/users.controller.php');
require_once(APP_ROOT . '/php/alert.message.handler.php');

// Requests skripte
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['first_name'], $_POST['last_name'])) {
    createAlertMessage('fail', 'Neki podaci nisu poslani u formi za registraciju.');
    redirectPage('edit_user.php?user_id=' . $_POST['update_user_id']);
  } else {
    if ($_POST['password'] != $_POST['password_confirm']) {
      createAlertMessage('fail', 'Unosi lozinke nisu isti!');
      redirectPage('edit_user.php?user_id=' . $_POST['update_user_id']);
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      createAlertMessage('fail', 'E-mail adresa nije ispravna!');
      redirectPage('edit_user.php?user_id=' . $_POST['update_user_id']);
    }
    if (!preg_match("/^[\sa-zčćžšđA-ZČĆŽŠĐ-]*$/", $_POST['first_name'])) {
      createAlertMessage('fail', 'U imenu smiju biti samo slova i razmak!');
      redirectPage('edit_user.php?user_id=' . $_POST['update_user_id']);
    }
    if (!preg_match("/^[\sa-zčćžšđA-ZČĆŽŠĐ-]*$/", $_POST['last_name'])) {
      createAlertMessage('fail', 'U prezimenu smiju biti samo slova i razmak!');
      redirectPage('edit_user.php?user_id=' . $_POST['update_user_id']);
    }

    if (isset($_POST['is_enabled'])) {
      $userStatus = true;
    } else {
      $userStatus = false;
    }
    if (!updateUserByAdmin($_POST['update_user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $userStatus)) {
      createAlertMessage('fail', 'Podaci nisu uspješno promijenjeni!');
      redirectPage('users.php');
    } else {
      createAlertMessage('success', 'Korisnički podaci su uspješno promijenjeni!');
      redirectPage('users.php');
    }
  }
} else {
  if (!isset($_GET['user_id'])) {
    redirectPage('users.php');
  }
}

// HTML komponente - head i navbar
require_once(APP_ROOT . '/components/head.component.php');

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
          <?php
          echo (showAlertMessage());
          clearAlertMessage();
          ?>
          <!-- ROW CENTRAL COLUMN  -->
          <?php
          $user = getUser($_GET['user_id']);
          $checkbox_modifier = '';
          if ($user['is_enabled'] == '1') {
            $checkbox_modifier = 'checked';
          }
          ?>
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Promjena podataka</h2>
              <form action="edit_user.php" method="post">
                <input type="hidden" name="update_user_id" value="<?= $_GET['user_id'] ?>">
                <div class="form-outline mb-4">
                  <label class="form-label" for="firstNameInput">Ime</label>
                  <input type="text" id="firstNameInput" name="first_name" class="form-control form-control-lg" value='<?= $user['first_name'] ?>' required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="lastNameInput">Prezime</label>
                  <input type="text" id="lastNameInput" name="last_name" class="form-control form-control-lg" value='<?= $user['last_name'] ?>' required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="emailInput">Email</label>
                  <input type="email" id="emailInput" name="email" class="form-control form-control-lg" value='<?= $user['email'] ?>' required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="passwordInput">Lozinka</label>
                  <input type="password" id="passwordInput" name="password" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="passwordConfirmInput">Ponovi lozinku</label>
                  <input type="password" id="passwordConfirmInput" name="password_confirm" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_enabled" value="1" id="isEnabledCheckbox" <?= $checkbox_modifier ?>>
                    <label class="form-check-label" for="isEnabledCheckbox">
                      Račun aktiviran?
                    </label>
                  </div>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-success btn-block btn-lg">Spremi promjene</button>
                  <a class="btn btn-secondary btn-block btn-lg ms-4" role=button href="index.php">Povratak</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col col-md-3"></div>
      </div>
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