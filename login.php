<?php

// Ucitaj session i helper funkcije
require_once('php/session.php');
require('php/functions.php');

// Dopusti pristup samo ako korisnik nije prijavljen
if ($_SESSION['is_auth'] == true) {
  redirectPage('index.php');
}

# HTML komponente
include('components/head.component.php');

?>
<body class="d-flex flex-column h-100">
  <?php
  include('components/navbar.component.php');
  ?>
  <main class="flex-shrink-0">
    <div class="container py-5 h-100">
      <!-- PAGE CONTENT  -->
      <?php
      include_once('php/login.handler.php');
      ?>
      <!-- END PAGE CONTENT  -->
      </div>
  </main>
  <?php
  include('components/footer.component.php');
  ?>
</body>
</html>
