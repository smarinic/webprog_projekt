<?php

require_once(APP_ROOT . '/php/dbconnection.php');
require_once(APP_ROOT . '/php/alert.message.handler.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_POST['email'], $_POST['password'])) {
    // Login form data was not sent correctly.
    exit('Podaci nisu poslani sa login forme u POST zahtjevu.');
  }

  $conn = createConnection();

  if ($statement = $conn->prepare('SELECT users.id, users.first_name, users.last_name, users.email, roles.id AS role, users.password, users.is_enabled FROM users, roles WHERE email = ? AND users.role_id = roles.id')) {
    $statement->bind_param('s', $_POST['email']);
    $statement->execute();
    $statement->store_result();
  
    if ($statement->num_rows > 0) {
      $statement->bind_result($id, $firstName, $lastName, $email, $role, $password, $is_enabled);
      $statement->fetch();
  
      if (password_verify($_POST['password'], $password)) {
        if(!$is_enabled) {
          createAlertMessage('fail', 'Vaš račun je onemogućen. Javite se administratoru.');
          redirectPage('login.php');
        }
        session_regenerate_id();
        $_SESSION['is_auth'] = TRUE;
        $_SESSION['first_name'] = $firstName;
        $_SESSION['last_name'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $id;
        $_SESSION['user_role'] = $role;
        createAlertMessage('success', 'Uspješna prijava! Dobrodošli u aplikaciju, ' . $firstName . '.');
        redirectPage('index.php');
      }
      else {
        createAlertMessage('fail', 'Neuspješna prijava! Pokušajte ponovo.');
        redirectPage('login.php');
      }
    }
    else {
      createAlertMessage('fail', 'Neuspješna prijava! Pokušajte ponovo.');
      redirectPage('login.php');
    }
  
    $conn->close();
  }

}
else {
  echo('
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
          ' . showAlertMessage() . '
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
              <input type="submit" class="btn btn-primary btn-lg btn-block" value="Prijava">

            </form>
          </div>
        </div>
      </div>
      ');
      clearAlertMessage();
}
?>