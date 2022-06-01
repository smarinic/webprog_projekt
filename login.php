<?php

require_once('globals.php');
require_once(APP_ROOT . '/php/session.php');
require_once(APP_ROOT . '/php/functions.php');

// Show page only if user is not logged in
if ($_SESSION['is_auth'] == true) {
  redirectPage('index.php');
}

// Navbar component
include(APP_ROOT . '/components/head.component.php');

?>
<body class="d-flex flex-column h-100">
  <?php
  include(APP_ROOT . '/components/navbar.component.php');
  ?>
  <main class="flex-shrink-0">
    <div class="container py-5 h-100">
      <!-- PAGE CONTENT  -->
      <?php
      include_once(APP_ROOT . '/php/login.handler.php');
      ?>
      <!-- END PAGE CONTENT  -->
      </div>
  </main>
  <?php
  include(APP_ROOT . '/components/footer.component.php');
  ?>
</body>
</html>
