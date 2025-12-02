<?php
require 'config.php';

if (!isset($_GET['id'])) {
    die("Brak ID!");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM characters WHERE id = ?");
$stmt->execute([$id]);
$character = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$character) {
    die("Postać nie istnieje!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        UPDATE characters SET 
        nickname = ?, 
        class = ?, 
        strength = ?, 
        intelligence = ?, 
        agility = ?, 
        level = ? 
        WHERE id = ?
    ");

    $stmt->execute([
        $_POST['nickname'],
        $_POST['class'],
        $_POST['strength'],
        $_POST['intelligence'],
        $_POST['agility'],
        $_POST['level'],
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<h1>Edytuj postać</h1>

<form method="POST">
    Nick: <input type="text" name="nickname" value="<?= $character['nickname'] ?>" required><br>
    Klasa: <input type="text" name="class" value="<?= $character['class'] ?>" required><br>
    Siła: <input type="number" name="strength" value="<?= $character['strength'] ?>" required><br>
    Inteligencja: <input type="number" name="intelligence" value="<?= $character['intelligence'] ?>" required><br>
    Zwinność: <input type="number" name="agility" value="<?= $character['agility'] ?>" required><br>
    Poziom: <input type="number" name="level" value="<?= $character['level'] ?>" required><br>

    <button type="submit">Zapisz zmiany</button>
</form>
