<?php

require_once('globals.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 1;
checkAccess($requiredAccessLevel);

// include
require_once(APP_ROOT . '/php/users.controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  deleteUser($_POST['delete_user_id']);
  createAlertMessage('success', 'Recenzija obrisana!');
  redirectPage('users.php');
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
      <?php
      echo (showAlertMessage());
      clearAlertMessage();
      ?>
      <!-- PAGE CONTENT  -->
      <h2>Korisnici</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Ime</th>
            <th scope="col">Prezime</th>
            <th scope="col">E-mail</th>
            <th scope="col">Vrsta korisnika</th>
            <th scope="col">Kreiran u:</th>
            <th scope="col">Ažuriran u:</th>
            <th scope="col">Aktiviran</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once(APP_ROOT . '/php/users.controller.php');
          $users = getUsers();
          foreach ($users as $user) {
            $checkboxStatus = '';
            if ($user['is_enabled']) {
              $checkboxStatus = 'checked';
            }
            echo ('
              <tr>
                <th scope="row">' . $user['id'] . '</th>
                <td>' . $user['first_name'] . '</td>
                <td>' . $user['last_name'] . '</td>
                <td>' . $user['email'] . '</td>
                <td>' . $user['user_role'] . '</td>
                <td>' . $user['created_at'] . '</td>
                <td>' . $user['updated_at'] . '</td>
                <td><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="user_enabled_checkbox" ' . $checkboxStatus . ' disabled/></div></td>
                <td><a class="btn btn-warning" href="edit_user.php?user_id=' . $user['id'] . '">Uredi</a></td>
                <td><form class="form-inline" action="users.php" method="post"><input type="hidden" name="delete_user_id" value="' . $user['id'] . '"><button class="btn btn-danger" type="submit">Obriši</button></form></td>
              </tr>');
          }
          ?>

        </tbody>
      </table>
      <!-- END PAGE CONTENT  -->
    </div>
  </main>
  <?php
  include(APP_ROOT . '/components/footer.component.php');
  ?>
</body>

</html>