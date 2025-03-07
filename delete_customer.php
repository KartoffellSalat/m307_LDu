<?php
// Session starten für Feedback-Nachrichten
session_start();

// Prüfen ob eine ID übergeben wurde
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Datenbankverbindung einbinden
    require_once 'db_connect.php';
    
    // ID bereinigen
    $id = $conn->real_escape_string($_GET['id']);
    
    // SQL für Löschung
    $sql = "DELETE FROM kunden WHERE id = $id";
    
    // SQL ausführen
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Kunde erfolgreich gelöscht.";
    } else {
        $_SESSION['message'] = "Fehler beim Löschen: " . $conn->error;
    }
    
    // Verbindung schließen
    $conn->close();
    
} else {
    $_SESSION['message'] = "Ungültige Anfrage.";
}

// Zurück zur Kundenliste
header("Location: kunden_liste.php");
exit;
?>