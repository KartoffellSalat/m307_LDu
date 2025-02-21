<?php

// Test data
$kunden = [
    [
        'anrede' => "test test",
        'name' => "test kunde",
        'telefon' => "test telefon",
        'email' => "test email",
        'adresse' => "test addresse",
        'rolle' => "rolle"
    ],
    [
        'anrede' => "test test",
        'name' => "test kunde",
        'telefon' => "test telefon",
        'email' => "test email",
        'adresse' => "test addresse",
        'rolle' => "rolle"
    ],
    [
        'anrede' => "test test",
        'name' => "test kunde",
        'telefon' => "test telefon",
        'email' => "test email",
        'adresse' => "test addresse",
        'rolle' => "rolle"
    ],
    [
        'anrede' => "test test",
        'name' => "test kunde",
        'telefon' => "test telefon",
        'email' => "test email",
        'adresse' => "test addresse",
        'rolle' => "rolle"
    ],
];
// require_once 'config.php';

// try {
//     $stmt = $pdo->query("SELECT * FROM kunden ORDER BY created_at DESC");
//     $kunden = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch(PDOException $e) {
//     echo "Fehler beim Abrufen der Daten: " . $e->getMessage();
//     die();
// }
// ?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kundendaten Ansicht</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Kundendaten Übersicht</h1>
        <a href="index.html" class="btn">Zurück zum Formular</a>

        <table>
            <thead>
                <tr>
                    <th>Anrede</th>
                    <th>Name</th>
                    <th>Telefon</th>
                    <th>E-Mail</th>
                    <th>Adresse</th>
                    <th>Rolle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kunden as $kunde): ?>
                    <tr>
                        <td><?php echo htmlspecialchars(string: $kunde['anrede']); ?></td>
                        <td><?php echo htmlspecialchars(string: $kunde['name']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['telefon']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['email']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['adresse']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['rolle']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</body>

</html>