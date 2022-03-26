<?php

require_once('globals.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 3;
checkAccess($requiredAccessLevel);

// includes
require_once(APP_ROOT . '/php/movies.controller.php');
require_once(APP_ROOT . '/php/reviews.controller.php');
require_once(APP_ROOT . '/php/json.controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $movie_id = getMovieId($_SESSION['movie_tmdb_id']);
  if (is_null($movie_id)) {
    // film ne postoji, dodaj ga u bazu
    insertMovie(
      $_SESSION['movie_tmdb_id'],
      $_SESSION['movie_title'],
      $_SESSION['movie_overview'],
      $_SESSION['movie_release_date'],
      $_SESSION['movie_rating_average'],
      $_SESSION['movie_poster_path']
    );
  }
  // film postoji ili je upravo dodan u bazu
  $movie_id = getMovieId($_SESSION['movie_tmdb_id']);
  insertReview(
    $_POST['review_comment'],
    $_POST['review_rating'],
    $_SESSION['user_id'],
    $movie_id
  );
  createAlertMessage('success', 'Recenzija je dodana u bazu.');
  redirectPage('index.php');
}

if (!isset($_GET['tmdb_id'], $_GET['movie_title'])) {
  redirectPage('search.php');
}

$movie = getJsonMovieDetails($_GET['tmdb_id']);
$_SESSION['movie_tmdb_id'] = $_GET['tmdb_id'];
$_SESSION['movie_title'] = $movie['title'];
$_SESSION['movie_overview'] = $movie['overview'];
$_SESSION['movie_release_date'] = $movie['release_date'];
$_SESSION['movie_rating_average'] = $movie['vote_average'];
$_SESSION['movie_poster_path'] = $movie['poster_path'];

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
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-center mb-5">Nova recenzija</h2>
              <form action="create_review.php" method="post">
                <div class="form-outline mb-4">


                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="idInput">TMDb ID:</label>
                    <div class="col-sm-6">
                      <input type="text" id="idInput" name="movie_tmdb_id" class="form-control" value="<?= $_GET['tmdb_id'] ?>" readonly required>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="movieInput">Film:</label>
                    <div class="col-sm-6">
                      <input type="text" id="movieInput" name="movie_title" class="form-control" value="<?= $_GET['movie_title'] ?>" readonly required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="commentInput">Recenzija:</label>
                    <div class="col-sm-6">
                      <textarea id="commentInput" name="review_comment" class="form-control" rows="4" cols="50" required></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ratingInput">Ocjena: </label>
                    <div class="col-sm-6 mt-1">
                      <span id="ratingDisplay">5</span>
                      <input type="range" class="form-control-range ms-3" min="0" value="5" max="10" id="ratingInput" name="review_rating" oninput="document.getElementById('ratingDisplay').innerHTML = this.value">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-success btn-block">Spremi</button>
                      <a class="btn btn-danger" href="index.php">Odustani</a>
                    </div>
                  </div>
              </form>
            </div>
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