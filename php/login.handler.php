<?php

# SQL konekcija
include('php/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_POST['email'], $_POST['password'])) {
    // Podaci sa forme za prijavu nisu poslani.
    exit('Podaci nisu poslani sa login forme u POST zahtjevu.');
  }

  if ($statement = $conn->prepare('SELECT users.id, users.first_name, roles.id AS role, users.password FROM users, roles WHERE email = ? AND users.role_id = roles.id')) {
    $statement->bind_param('s', $_POST['email']);
    $statement->execute();
    $statement->store_result();
  
    if ($statement->num_rows > 0) {
      $statement->bind_result($id, $firstName, $role, $password);
      $statement->fetch();
  
      // Usporedi hash lozinke
      if (password_verify($_POST['password'], $password)) {
        // Autentikacija uspjesna
        // Spremi prijavu u sesiju
        session_regenerate_id();
        $_SESSION['is_auth'] = TRUE;
        $_SESSION['first_name'] = $firstName;
        $_SESSION['user_id'] = $id;
        $_SESSION['user_role'] = $role;
        $_SESSION['redirect_message'] = 'Uspješna prijava! Dobrodošli u aplikaciju, ' . $firstName;
        redirectPage('index.php');
      }
      else {
        $_SESSION['redirect_message'] = "Neuspješna prijava! Pokušajte ponovo.";
        redirectPage('login.php');
      }
    }
    else {
      $_SESSION['redirect_message'] = "Neuspješna prijava! Pokušajte ponovo.";
      redirectPage('login.php');
    }
  
    // Zatvori konekciju
    $statement->close();
  }

}
else {
  $failMessage = '';
  if(isset($_SESSION['redirect_message']) && $_SESSION['redirect_message'] != '') {
    $failMessage = '<div class="alert alert-danger" role="alert">' . $_SESSION['redirect_message'] . '</div>';
  }
  echo('
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <form action="login.php" method="POST" class="card-body p-5 text-center">

              <h3 class="mb-5">Prijava u aplikaciju</h3>

              <div class="form-outline mb-4">
                <input type="email" id="email_input" name="email" class="form-control form-control-lg" required />
                <label class="form-label" for="email">Email</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password_input" name="password" class="form-control form-control-lg" required />
                <label class="form-label" for="password">Lozinka</label>
              </div>
              ' . $failMessage . '
              <input type="submit" class="btn btn-primary btn-lg btn-block" value="Prijava">

            </form>
          </div>
        </div>
      </div>
      ');
}
?>