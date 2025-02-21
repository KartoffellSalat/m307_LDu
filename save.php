<?php
//require_once 'config.php';
// Test ohne Datenbank
print_r ($_POST);
exit;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO kunden (name, telefon, email, adresse, rolle) VALUES (?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $_POST['name'],
            $_POST['telefon'],
            $_POST['email'],
            $_POST['adresse'],
            $_POST['rolle']
        ]);
        
        header('Location: index.html?success=1');
        exit();
    } catch(PDOException $e) {
        echo "Fehler beim Speichern: " . $e->getMessage();
        die();
    }
}
?>