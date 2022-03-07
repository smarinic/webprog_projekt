<?php

# Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Start session
session_start();

include('components/head.component.php');
include('components/navbar.component.php');
?>

<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-2">Stranica za evidenciju filmova</h1>
    <p class="lead">Na ovoj stranici moguće je evidentirati pregledane filmove i serije.</p>
  </div>
</main>
</body>

<?php
include('components/footer.component.php');
?>