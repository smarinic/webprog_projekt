<?php

if(!isset($is_auth))
{
  $is_auth = FALSE;
}

?>
<header>
<nav class="navbar navbar-expand-md navbar-dark bg-primary bg-gradient">
    <div class="container-fluid">
      <span class="navbar-text">Filmoteka</span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link <?php echo(checkIfActivePage("index")) ?>" aria-current="page" href="index.php">Početna</a>
          </li>
          <?php
          // Ako je korisnik prijavljen, prikazi link na recenzije
          if(checkAccess(3)) {
            echo('
            <li class="nav-item">
              <a class="nav-link ' . checkIfActivePage('reviews') . '" href="reviews.php">Recenzije</a>
            </li>');
          }
          // Ako je korisnik administrator, prikazi link na korisnike
          if(checkAccess(1)) {
            echo('
            <li class="nav-item">
              <a class="nav-link '. checkIfActivePage('users') .'" href="users.php">Korisnici</a>
            </li>');
          }
          ?>
        </ul>
        <?php
          if($_SESSION['is_auth'] == false) {
            echo('
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" href="register.php"><i data-feather="user-plus"></i> Registracija</a></li>
              <li class="nav-item"><a class="nav-link" href="login.php"><i data-feather="log-in"></i> Prijava</a></li>
            </ul>');
          }
          else {
            echo('
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" href="profile.php"><i data-feather="user"></i> Profil</a></li>
              <li class="nav-item"><a class="nav-link" href="logout.php"><i data-feather="log-out"></i> Odjava</a></li>
            </ul>');
          }
        ?>
      </div>
    </div>
  </nav>
</header>