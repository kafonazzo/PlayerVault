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

// Prepara la query SQL per verificare se le credenziali sono già presenti
$check_sql = "SELECT * FROM utenti WHERE email='$email'";

// Esegui la query per verificare se l'email è già presente
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    // Se l'email è già presente nel database, visualizza un messaggio di errore
    echo "Questo indirizzo email è già stato registrato.";
} else {
    // Prepara la query SQL per l'inserimento dei dati
    $sql = "INSERT INTO utenti (email, password) VALUES ('$email', '$password')";

    // Esegui la query per l'inserimento dei dati
    if ($conn->query($sql) === TRUE) {
        // Inserimento riuscito, salva l'email nella sessione
        $_SESSION['email'] = $email;
        header("Location: ./opzioni/intro.html");
    } else {
        // Gestisci eventuali errori durante l'inserimento
        echo "Errore durante l'inserimento nel database: " . $conn->error;
    }
}

// Chiudi la connessione al database
$conn->close();
?>