<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Giocatori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Giocatori Presenti</h1>
    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Squadra</th>
            <th>Posizione</th>
            <th>Data di nascita</th>
            <th>Stipendio</th>
        </tr>
        </thead>
        <tbody>
        <?php
        session_start(); // Avvia la sessione
        $email = $_SESSION['email'];
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

        // Costruisci la query SQL base per selezionare i giocatori
        $sql = "SELECT * FROM giocatori WHERE idUtente = ?";

        // Array per i parametri della query
        $params = array($email);

        // Aggiungi i filtri se sono stati forniti
        if (!empty($_GET['squadra'])) {
            $squadra = $_GET['squadra'];
            $sql .= " AND squadra LIKE ?";
            $params[] = "%$squadra%";
        }
        if (!empty($_GET['posizione'])) {
            $posizione = $_GET['posizione'];
            $sql .= " AND posizione LIKE ?";
            $params[] = "%$posizione%";
        }
        if (!empty($_GET['stipendio'])) {
            $stipendio = $_GET['stipendio'];
            $sql .= " AND stipendio >= ?";
            $params[] = $stipendio;
        }
        if (!empty($_GET['ordine']) && ($_GET['ordine'] === 'ASC' || $_GET['ordine'] === 'DESC')) {
            $ordine = $_GET['ordine'];
            $sql .= " ORDER BY totale $ordine";
        }

        // Prepara la query
        $stmt = $conn->prepare($sql);

        // Esegui la query con i parametri
        if ($stmt) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
            $stmt->execute();

            $result = $stmt->get_result();

            // Stampa i risultati dei giocatori in una tabella HTML
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["cognome"] . "</td>";
                    echo "<td>" . $row["squadra"] . "</td>";
                    echo "<td>" . $row["posizione"] . "</td>";
                    echo "<td>" . $row["data_nascita"] . "</td>";
                    echo "<td>" . $row["totale"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nessun giocatore presente</td></tr>";
            }

            // Chiudi la statement
            $stmt->close();
        } else {
            echo "Errore nella preparazione della query: " . $conn->error;
        }

        // Chiudi la connessione al database
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
