<?php


// Ucitaj session i helper funkcije
require_once('php/session.php');
require_once('php/functions.php');

// Provjeri pristup: (Admin = 1, Editor = 2, User = 3, Neregistrirani >3)
$requiredAccessLevel = 4;
checkAccess($requiredAccessLevel);



// HTML komponente - head i navbar
require_once('components/head.component.php');
require_once('components/navbar.component.php');
?>

<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">
  <div class="container">
    <!-- PAGE CONTENT -->

    <?php
    // Ako je postavljena poruka nakon preusmjeravanja, prikazi ju
    if(isset($_SESSION['redirect_message']) && $_SESSION['redirect_message'] != '') {
      echo('<div class="alert alert-primary mt-3"  role="alert">' . $_SESSION['redirect_message'] . '</div>');
      unset($_SESSION['redirect_message']);
    }
    ?>

    <h1 class="mt-2">Stranica za evidenciju filmova</h1>
    <p class="lead">Na ovoj stranici moguće je evidentirati pregledane filmove i serije.</p>
    
    <!-- END PAGE CONTENT -->
  </div>
</main>
</body>

<?php
include('components/footer.component.php');
?>