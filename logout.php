<?php
session_start();
session_destroy();
// Nakon odjave preusmjeri na pocetnu
session_start();
$_SESSION['redirect_message'] = 'Uspješno ste odjavljeni iz aplikacije.';
header('Location: index.php');
?>