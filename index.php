<?php


// Ucitaj session i helper funkcije
require_once('php/session.php');
require_once('php/functions.php');

// HTML komponenta - head
require_once('components/head.component.php');
?>

<body class="d-flex flex-column h-100">
  <?php
  require_once('components/navbar.component.php');
  ?>
  <main class="flex-shrink-0">
    <div class="container">
      <!-- PAGE CONTENT -->
      <div class="row">
        <div class="col col-md-2"></div>
        <div class="col col-md-8">
          <?php
          require_once('php/alert.message.handler.php');
          echo(showAlertMessage());
          clearAlertMessage();
          ?>
          <h1>Stranica za evidenciju filmova</h1>
          <p>Na ovoj stranici moguće je evidentirati pregledane filmove i serije.</p>
          <p>Korištene tehnologije:</p>
          <div class="list-group">
            <a href="https://www.apachefriends.org/download.html" class="list-group-item list-group-item-action">XAMPP</a>
            <a href="https://getbootstrap.com/docs/5.0/getting-started/introduction/" class="list-group-item list-group-item-action">Bootstrap v5.0</a>
            <a href="https://feathericons.com/" class="list-group-item list-group-item-action">Feather Icons</a>
          </div>
        </div>
        <div class="col col-md-2"></div>
      </div>
      <!-- END PAGE CONTENT -->
    </div>
  </main>
  <?php
  include('components/footer.component.php');
  ?>
</body>
</html>
