<?php

// Ucitaj helper funkcije
require_once(APP_ROOT . 'php/session.php');
require_once(APP_ROOT . 'php/functions.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
if ($_SESSION['is_auth'] == true) {
  redirectPage(APP_ROOT . 'index.php');
}

// HTML komponente - head i navbar
require_once(APP_ROOT . 'components/head.component.php');
?>

<body class="d-flex flex-column h-100">
  <?php
  include(APP_ROOT . 'components/navbar.component.php');
  ?>
  <main class="flex-shrink-0">
    <div class="container py-5 h-100">
      <!-- PAGE CONTENT  -->
      <div class="row">
        <div class="col col-md-3"></div>
        <div class="col col-md-6">
          <!-- ROW CENTRAL COLUMN  -->
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Registracija korisnika</h2>
              <form action="php/registration.handler.php" method="post">
                <div class="form-outline mb-4">
                  <label class="form-label" for="firstNameInput">Ime</label>
                  <input type="text" id="firstNameInput" name="first_name" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="lastNameInput">Prezime</label>
                  <input type="text" id="lastNameInput" name="last_name" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Email</label>
                  <input type="email" id="emailInput" name="email" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Lozinka</label>
                  <input type="password" id="passwordInput" name="password" class="form-control form-control-lg" required>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Ponovi lozinku</label>
                  <input type="password" id="passwordConfirmInput" name="password_confirm" class="form-control form-control-lg" required>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-success btn-block btn-lg">Registriraj se</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col col-md-3"></div>
      </div>
      <!-- END PAGE CONTENT  -->
    </div>
  </main>
  <?php
  include(APP_ROOT . 'components/footer.component.php');
  ?>
</body>
</html>