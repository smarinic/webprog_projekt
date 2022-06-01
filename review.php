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
          $data = null;
          if(checkAccess(2)) {
            $data = getReviewFromAnyUser($_GET['id']);
          }
          else {
            $data = getReview($_GET['id'], $_SESSION['user_id']);
          }
          if (empty($data)) {
            createAlertMessage('fail', 'Recenzija sa tom oznakom ne postoji.');
            redirectPage('index.php');
          } else {
            echo ('
            <div class="card mb-3">
              <div class="row">
                <div class="col-md-4">
                  <img src="https://image.tmdb.org/t/p/w300' . $data['poster_path'] .'" class="img-fluid rounded-start" alt="movie poster">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">'. $data['title'] .'</h5>
                    <p class="card-text mb-0"><small class="text-muted">Datum izdanja: '. date("d.m.Y", strtotime($data['release_date'])) .'</small></p>
                    <p class="card-text"><small class="text-muted">Ocjena gledatelja: '. $data['rating_average'] .'</small></p>
                    <hr>
                    <p class="card-text">'. $data['overview'] .'</p>
                  </div>
                </div>
              </div>
              <div class="row ms-2 mb-1">
                <div class="col-md-12">
                  <h2 class="text-center">Recenzija</h2>
                  <p>'. $data['comment'] .'</p>
                  <h3 class="text-center"><strong>Ocjena: '. $data['rating'] .'</strong></h3>
                  <a class="btn btn-warning" href="edit_review.php">Uredi recenziju</a>
                </div>
              </div>
            </div>
            ');
            $_SESSION['review_data'] = $data;
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