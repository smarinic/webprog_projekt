<?php

// Ucitaj helper funkcije
require_once(APP_ROOT . 'php/session.php');
require_once(APP_ROOT . 'php/functions.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 4;
checkAccess($requiredAccessLevel);

// HTML komponente - head i navbar
require_once(APP_ROOT . 'components/head.component.php');
?>

<body class="d-flex flex-column h-100">
  <?php
  include(APP_ROOT . 'components/navbar.component.php');
  ?>
  <main class="flex-shrink-0">
    <div class="container py-5 h-100">
      <!-- PAGE CONTENT  -->
      <div class="row">
        <div class="col col-md-2"></div>
        <div class="col col-md-8">
          <!-- ROW CENTRAL COLUMN  -->
        </div>
        <div class="col col-md-2"></div>
      </div>
      <!-- END PAGE CONTENT  -->
    </div>
  </main>
  <?php
  include(APP_ROOT . 'components/footer.component.php');
  ?>
</body>
</html>