<?php

// Ucitaj helper funkcije
require_once('php/session.php');
require_once('php/functions.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 1;
checkAccess($requiredAccessLevel);

// HTML komponente - head i navbar
require_once('components/head.component.php');
require_once('components/navbar.component.php');
?>

<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <div class="container py-5 h-100">
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
            require_once('php/list_users.php');
            $users = fetchUsers();
            foreach($users as $user) {
              $checkboxStatus = '';
              if($user['is_enabled']) {
                $checkboxStatus = 'checked';
              }
              echo('
              <tr>
                <th scope="row">'.$user['id'].'</th>
                <td>'.$user['first_name'].'</td>
                <td>'.$user['last_name'].'</td>
                <td>'.$user['email'].'</td>
                <td>'.$user['user_role'].'</td>
                <td>'.$user['created_at'].'</td>
                <td>'.$user['updated_at'].'</td>
                <td><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="user_enabled_checkbox" '.$checkboxStatus.' disabled/></div></td>
                <td><a class="btn btn-warning" href="#">Uredi</a></td>
                <td><a class="btn btn-danger" href="#">Obriši</a></td>
              </tr>');
            }
          ?>
          
        </tbody>
      </table>
      <!-- END PAGE CONTENT  -->
    </div>
  </main>
</body>

<?php
// Ucitaj footer
include('components/footer.component.php');
?>