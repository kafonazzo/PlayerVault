<?php
session_start(); // Avvia la sessione

$email = $_POST['email'];
$password = $_POST['password'];

// Dettagli di connessione al database
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "contenitore";

// Crea una connessione al database
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Verifica la connessione al database
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Prepara la query SQL per verificare le credenziali
$sql = "SELECT * FROM utenti WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Credenziali corrette, salva l'email nella sessione
    $_SESSION['email'] = $email; // Utilizza la variabile $email
    header("Location: ./opzioni/intro.html"); // Reindirizza alla pagina home.html
} else {
    echo 'Credenziali errate. Riprova.';
    // Puoi anche utilizzare JavaScript per mostrare un alert se lo desideri
    echo '<script>alert("Credenziali errate. Riprova");</script>';
}