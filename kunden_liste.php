<?php
// Session starten für Feedback-Nachrichten
session_start();

// Nachricht prüfen
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Datenbankverbindung einbinden
require_once 'db_connect.php';

// Alle Kunden abrufen
$sql = "SELECT * FROM kunden ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kundenliste - Kundenverwaltung</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Kundenverwaltung</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Neuer Kunde</a></li>
                    <li><a href="kunden_liste.php" class="active">Kundenliste</a></li>
                </ul>
            </nav>
        </header>
        
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <main>
            <h2>Kundenliste</h2>
            
            <?php if ($result && $result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Anrede</th>
                                <th>Name</th>
                                <th>Adresse</th>
                                <th>Mobiltelefon</th>
                                <th>Firmentelefon</th>
                                <th>Festnetztelefon</th>
                                <th>E-Mail</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['anrede']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['adresse']); ?></td>
                                    <td><?php echo htmlspecialchars($row['mobiltelefon']); ?></td>
                                    <td><?php echo htmlspecialchars($row['firmentelefon']); ?></td>
                                    <td><?php echo htmlspecialchars($row['festnetztelefon']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="button edit">Bearbeiten</a>
                                        <a href="delete_customer.php?id=<?php echo $row['id']; ?>" 
                                           class="button delete" 
                                           onclick="return confirm('Möchten Sie diesen Kunden wirklich löschen?')">Löschen</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Keine Kunden gefunden.</p>
            <?php endif; ?>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Kundenverwaltungssystem</p>
        </footer>
    </div>
</body>
</html>
<?php
// Verbindung schließen
$conn->close();
?>