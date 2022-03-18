<?php

require_once('globals.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 3;
checkAccess($requiredAccessLevel);

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
          <!-- ROW CENTRAL COLUMN  -->
          <?php
          require_once(APP_ROOT . '/php/reviews.controller.php');

          $data = getReview($_GET['id']);
          if(empty($data)) {
            createAlertMessage('fail', 'Recenzija sa tom oznakom ne postoji.');
            redirectPage('index.php');
          }
          else {
            echo('
          <div><h2>' . $data['title'] . '</h2></div>
          <div class="border-bottom"><p>Autor: ' . $data['author'] . '</p></div>
          <div>
            <p>' . $data['comment'] . '</p>
          </div>
          <div>
            <p>Ocjena: ' . $data['rating'] . '</p>
            <p>TMDb: <a href="https://www.themoviedb.org/movie/' . $data['tmdb_id'] . '">Informacije o filmu</a></p>
          </div>
            ');
          }
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