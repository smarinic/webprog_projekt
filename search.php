<?php

require_once('globals.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 4;
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
          <h2>Pretraga filmova za recenziju</h2>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Naziv filma za pretragu" aria-label="Naziv filma za pretragu" aria-describedby="searchButton">
            <button class="btn btn-outline-primary" type="button" id="searchButton" onclick="searchClick()">Pretraži</button>
          </div>
          <?php
          if (isset($_GET['search_title']) && $_GET['search_title'] != '') {
            $api_key = file_get_contents(APP_ROOT . '/api_key');
            $api_query = 'https://api.themoviedb.org/3/search/movie?api_key=';
            $api_query .= $api_key;
            $api_query .= '&language=en-US&query=' . urlencode($_GET['search_title']);
            $api_query .= '&page=1&include_adult=false';
            $json = file_get_contents($api_query);
            //$json = file_get_contents('example_search.json'); // za lokalni test JSON

            $json_data = json_decode($json, true);

            $results = $json_data['results'];
            echo ('
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Naziv filma</th>
                  <th scope="col">Sadržaj</th>
                  <th scope="col">Datum izlaska</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>');
            foreach ($results as $result) {
              echo ('
                <tr>
                  <th scope="row">' . $result['title'] . '</th>
                  <td>' . $result['overview'] . '</td>
                  <td>' . $result['release_date'] . '</td>
                  <td><a class="btn btn-primary" href="create_review.php?tmdb_id=' . $result['id'] . '&movie_title=' . urlencode($result['title']) . '">Ocijeni</a></td>
                  <td><a class="btn btn-link" target="_blank" href="https://www.themoviedb.org/movie/' . $result['id'] . '">Otvori TMDb</a></td>
                </tr>');
            }
            echo ('</tbody>
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