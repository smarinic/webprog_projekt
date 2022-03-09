<?php

// Ucitaj session i helper funkcije
require_once('php/session.php');
require_once('php/functions.php');

// Dopusti pristup samo ako korisnik nije prijavljen
if ($_SESSION['is_auth'] == true) {
  redirectPage('index.php');
}

# HTML komponente
include('components/head.component.php');
include('components/navbar.component.php');

?>
<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <div class="container py-5 h-100">
      <!-- PAGE CONTENT  -->
      <?php
      include_once('php/login.handler.php');
      ?>
      <!-- END PAGE CONTENT  -->
      </div>
  </main>
</body>

<?php
// Ucitaj footer
include('components/footer.component.php');
?>
