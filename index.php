<?php

require_once('globals.php');

// HTML komponenta - head
require_once(APP_ROOT . '/components/head.component.php');
?>

<body class="d-flex flex-column h-100">
  <?php
  require_once(APP_ROOT . '/components/navbar.component.php');
  ?>
  <main class="flex-shrink-0">
    <div class="container">
      <!-- PAGE CONTENT -->
      <div class="row">
        <div class="col col-md-2"></div>
        <div class="col col-md-8">
          <?php
          require_once(APP_ROOT . '/php/alert.message.handler.php');
          echo(showAlertMessage());
          clearAlertMessage();
          ?>
          <img class="mx-auto d-block" src="img/movie_logo.png" style="max-width: 25%" alt="logo">
          <h1 class="text-center" style="font-family: 'Brush Script MT', cursive">Filmoteka</h1>
          <p class="text-center mb-4">Web aplikacija za evidenciju i recenziju pregledanih filmova</p>
          <table class="table table-bordered caption-top mb-4">
            <caption>Korisnički računi:</caption>
            <thead class="table-dark">
              <tr>
                <th scope="col">E-mail</th>
                <th scope="col">Lozinka</th>
                <th scope="col">Vrsta računa</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>admin@filmoteka.local</td>
                <td>admin123</td>
                <td>Administrator</td>
              </tr>
              <tr>
                <td>pero@filmoteka.local</td>
                <td>pero123</td>
                <td>Urednik</td>
              </tr>
              <tr>
                <td>ckent@dailyplanet.com</td>
                <td>clark123</td>
                <td>Korisnik</td>
              </tr>
            </tbody>
          </table>
          <p class="text-muted">Korištene tehnologije:</p>
          <div class="list-group caption-top">
            <a href="https://www.apachefriends.org/download.html" class="list-group-item list-group-item-action"><i data-feather="external-link"></i> XAMPP</a>
            <a href="https://getbootstrap.com/docs/5.0/getting-started/introduction/" class="list-group-item list-group-item-action"><i data-feather="external-link"></i> Bootstrap v5.0</a>
            <a href="https://feathericons.com/" class="list-group-item list-group-item-action"><i data-feather="external-link"></i> Feather Icons</a>
          </div>
        </div>
        <div class="col col-md-2"></div>
      </div>
      <!-- END PAGE CONTENT -->
    </div>
  </main>
  <?php
  include(APP_ROOT . '/components/footer.component.php');
  ?>
</body>
</html>
