<?php
// db_connect.php - Verbindung zur Datenbank
$host = "localhost";
$username = "root";
$password = "";
$database = "kundenverwaltung";

// Verbindung herstellen
$conn = new mysqli($host, $username, $password, $database);

// Verbindung prüfen
if ($conn->connect_error) {
    die("Verbindungsfehler: " . $conn->connect_error);
}

// UTF-8 Zeichensatz setzen
$conn->set_charset("utf8");
?>