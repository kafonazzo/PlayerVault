<?php
session_start(); // Avvia la sessione

$email = $_SESSION['email'];

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$squadra = $_POST['squadra'];
$posizione = $_POST['posizione'];
$nascita = $_POST['data'];
$iStipendio = $_POST['iStipendio'];
$fStipendio = $_POST['fStipendio'];
$totale  = $_POST['totale'];


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

    // Prepara la query SQL per l'inserimento dei dati
    $sql = "INSERT INTO giocatori (nome,cognome,squadra,posizione,data_nascita,idUtente,stip_inizio,stip_fine,totale) VALUES ('$nome','$cognome','$squadra','$posizione','$nascita','$email','$iStipendio','$fStipendio','$totale')";

    // Esegui la query per l'inserimento dei dati
    if ($conn->query($sql) === TRUE) {
        // Inserimento riuscito, salva l'email nella sessione
        $_SESSION['email'] = $email;
        header("Refresh");
    } else {
        // Gestisci eventuali errori durante l'inserimento
        echo "Errore durante l'inserimento nel database: " . $conn->error;
    }
} else {
    // Se l'email non è presente nel database, visualizza un messaggio di errore
    echo "Questo indirizzo email non è registrato.";
}

// Chiudi la connessione al database
$conn->close();
?>
