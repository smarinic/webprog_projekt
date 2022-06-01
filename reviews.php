<?php

require_once('globals.php');

// Check user access (Admin = 1, Editor = 2, User = 3, Unregistered >3)
$requiredAccessLevel = 3;
checkAccess($requiredAccessLevel);

// include
require_once(APP_ROOT . '/php/reviews.controller.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  deleteReview($_POST['review_id']);
  createAlertMessage('success', 'Recenzija obrisana!');
  redirectPage('reviews.php');
}

// Navbar component
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
          require_once(APP_ROOT . '/php/alert.message.handler.php');
          echo(showAlertMessage());
          clearAlertMessage();
          $data = [];
          if ($_SESSION['user_role'] <= 2) {
            // prikazi sve
            $data = getAllReviews();
          } else {
            // prikazi samo vlastite
            $data = getReviews($_SESSION['user_id']);
          }
          if (empty($data)) {
            echo ('<h2>Recenzije</h2>
                  <p>Nemate kreiranih recenzija.</p>');
          } else {
            echo ('<h2>Recenzije</h2>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Naziv filma</th>
                          <th scope="col">Autor</th>
                          <th scope="col">Ocjena</th>
                          <th scope="col">TMDb Link</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>');
            foreach ($data as $review) {
              echo ('
                        <tr>
                          <td>' . $review['title'] . '</td>
                          <td>' . $review['author'] . '</td>
                          <td>' . $review['rating'] . '</td>
                          <td><a href="https://www.themoviedb.org/movie/' . $review['tmdb_id'] . '">TMDb</a></td>
                          <td><a class="btn btn-primary" href="review.php?id=' . $review['id'] . '">Prikaži</a></td>
                          <td><form class="form-inline" action="reviews.php" method="post" onsubmit="return confirm(\'Jeste li sigurni da želite obrisati ovog korisnika?\');"><input type="hidden" name="review_id" value="' . $review['id'] . '"><button class="btn btn-danger" type="submit">Obriši</button></form></td>
                        </tr>
                      ');
            }
            echo('</tbody>
            </table>');
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