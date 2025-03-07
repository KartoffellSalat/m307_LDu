<?php
// Session starten für Feedback-Nachrichten
session_start();

// Prüfen ob das Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datenbankverbindung einbinden
    require_once 'db_connect.php';
    
    // Daten bereinigen und validieren
    $anrede = $conn->real_escape_string($_POST['anrede']);
    $name = $conn->real_escape_string($_POST['name']);
    $adresse = $conn->real_escape_string($_POST['adresse']);
    $firmentelefon = $conn->real_escape_string($_POST['firmentelefon'] ?? '');
    $mobiltelefon = $conn->real_escape_string($_POST['mobiltelefon']);
    $festnetztelefon = $conn->real_escape_string($_POST['festnetztelefon'] ?? '');
    $email = $conn->real_escape_string($_POST['email']);
    
    // Prüfen ob es sich um eine Aktualisierung handelt
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $conn->real_escape_string($_POST['id']);
        
        // SQL für Update
        $sql = "UPDATE kunden SET 
                anrede = '$anrede', 
                name = '$name', 
                adresse = '$adresse', 
                firmentelefon = '$firmentelefon', 
                mobiltelefon = '$mobiltelefon', 
                festnetztelefon = '$festnetztelefon', 
                email = '$email' 
                WHERE id = $id";
        
        $message = "Kundendaten erfolgreich aktualisiert.";
    } else {
        // SQL für neue Eintragung
        $sql = "INSERT INTO kunden (anrede, name, adresse, firmentelefon, mobiltelefon, festnetztelefon, email) 
                VALUES ('$anrede', '$name', '$adresse', '$firmentelefon', '$mobiltelefon', '$festnetztelefon', '$email')";
        
        $message = "Neuer Kunde erfolgreich angelegt.";
    }
    
    // SQL ausführen
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = $message;
        // POST/REDIRECT/GET Muster anwenden
        header("Location: kunden_liste.php");
        exit;
    } else {
        $_SESSION['message'] = "Fehler: " . $conn->error;
        header("Location: index.php");
        exit;
    }
    
    // Verbindung schließen
    $conn->close();
    
} else {
    // Wenn Seite direkt aufgerufen wird, zurück zur Hauptseite
    header("Location: index.php");
    exit;
}
?>