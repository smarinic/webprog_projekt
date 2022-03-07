<?php


// Ucitaj helper funkcije
require_once('php/session.php');
require_once('php/functions.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 4;
checkAccess($user, $requiredAccessLevel);

// SQL konekcija
require_once('php/dbconnection.php');

// HTML komponente - head i navbar
require_once('components/head.component.php');
require_once('components/navbar.component.php');
?>

<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">
  <div class="container py-5 h-100">
    <!-- PAGE CONTENT  -->

  <!-- dodat tablicu sa korisnicima i CRUD opcijama -->

    <!-- END PAGE CONTENT  -->
  </div>
</main>
</body>


<?php
// Ucitaj footer
include('components/footer.component.php');
?>