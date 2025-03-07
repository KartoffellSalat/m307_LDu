<?php
// Session starten für Feedback-Nachrichten
session_start();

// Prüfen auf POST-Weiterleitung
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Standardwerte für Bearbeitungsmodus
$editing = false;
$customer = [
    'id' => '',
    'anrede' => '',
    'name' => '',
    'adresse' => '',
    'firmentelefon' => '',
    'mobiltelefon' => '',
    'festnetztelefon' => '',
    'email' => ''
];

// Prüfen ob ein Kunde bearbeitet werden soll
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    require_once 'db_connect.php';
    $id = $conn->real_escape_string($_GET['edit']);
    $result = $conn->query("SELECT * FROM kunden WHERE id = $id");
    
    if ($result && $result->num_rows > 0) {
        $editing = true;
        $customer = $result->fetch_assoc();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kundenverwaltung</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Kundenverwaltung</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Neuer Kunde</a></li>
                    <li><a href="kunden_liste.php">Kundenliste</a></li>
                </ul>
            </nav>
        </header>
        
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <main>
            <h2><?php echo $editing ? 'Kunde bearbeiten' : 'Neuen Kunden anlegen'; ?></h2>
            
            <form action="save_customer.php" method="post">
                <?php if ($editing): ?>
                    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="anrede">Anrede:</label>
                    <select id="anrede" name="anrede" required>
                        <option value="">Bitte wählen</option>
                        <option value="Herr" <?php echo ($customer['anrede'] == 'Herr') ? 'selected' : ''; ?> >Herr</option>
                        <option value="Frau" <?php echo ($customer['anrede'] == 'Frau') ? 'selected' : ''; ?> >Frau</option>
                        <option value="Divers" <?php echo ($customer['anrede'] == 'Divers') ? 'selected' : ''; ?> >Divers</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="name">Vor- und Nachname:</label>
                    <input type="text" id="name" name="name" required 
                           value="<?php echo htmlspecialchars($customer['name']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <textarea id="adresse" name="adresse" required><?php echo htmlspecialchars($customer['adresse']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="firmentelefon">Firmentelefon:</label>
                    <input type="tel" id="firmentelefon" name="firmentelefon" 
                           pattern="[0-9 ]+" title="Nur Zahlen und Leerzeichen erlaubt"
                           value="<?php echo htmlspecialchars($customer['firmentelefon']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="mobiltelefon">Mobiltelefon:</label>
                    <input type="tel" id="mobiltelefon" name="mobiltelefon" required 
                           pattern="[0-9 ]+" title="Nur Zahlen und Leerzeichen erlaubt"
                           value="<?php echo htmlspecialchars($customer['mobiltelefon']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="festnetztelefon">Festnetztelefon:</label>
                    <input type="tel" id="festnetztelefon" name="festnetztelefon" 
                           pattern="[0-9 ]+" title="Nur Zahlen und Leerzeichen erlaubt"
                           value="<?php echo htmlspecialchars($customer['festnetztelefon']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="email" id="email" name="email" required
                           value="<?php echo htmlspecialchars($customer['email']); ?>">
                </div>
                
                <div class="form-group">
                    <button type="submit"><?php echo $editing ? 'Aktualisieren' : 'Speichern'; ?></button>
                    <?php if ($editing): ?>
                        <a href="index.php" class="button">Abbrechen</a>
                    <?php endif; ?>
                </div>
            </form>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Kundenverwaltungssystem</p>
        </footer>
    </div>
</body>
</html>