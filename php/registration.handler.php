<?php

include('dbconnection.php');
include('functions.php');
include('alert.message.handler.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Backend za kreiranje korisnika u bazi

    if (!isset($_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['first_name'], $_POST['last_name'])) {
        // Podaci sa forme za prijavu nisu poslani.
        createAlertMessage('fail', 'Neki podaci nisu poslani u formi za registraciju.');
        redirectPage('index.php');
    }
    else {
        if($_POST['password'] != $_POST['password_confirm']) {
            require_once('alert.message.handler.php');
            createAlertMessage('fail', 'Unosi lozinke nisu isti!');
            redirectPage('register.php');
        }
        else {
            $conn = createConnection();
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role_id) VALUES (?, ?, ?, ?, 3)");
            $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
            $firstname = clean_input($_POST["first_name"]);
            $lastname = clean_input($_POST["last_name"]);
            $email = clean_input($_POST["email"]);
            $password = password_hash(clean_input($_POST["password"]), PASSWORD_DEFAULT);
            $stmt->execute();
        
            $conn->close();
        
            createAlertMessage('success', 'Uspješna registracija! Možete se prijaviti u aplikaciju.');
            redirectPage('../login.php');
        }
    }
}
?>