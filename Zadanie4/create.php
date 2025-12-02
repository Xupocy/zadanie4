<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        INSERT INTO characters (nickname, class, strength, intelligence, agility, level)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $_POST['nickname'],
        $_POST['class'],
        $_POST['strength'],
        $_POST['intelligence'],
        $_POST['agility'],
        $_POST['level']
    ]);

    header("Location: index.php");
    exit;
}
?>

<h1>Dodaj nową postać</h1>

<form method="POST">
    Nick: <input type="text" name="nickname" required><br>
    Klasa: <input type="text" name="class" required><br>
    Siła: <input type="number" name="strength" required><br>
    Inteligencja: <input type="number" name="intelligence" required><br>
    Zwinność: <input type="number" name="agility" required><br>
    Poziom: <input type="number" name="level" required><br>
    <button type="submit">Dodaj</button>
</form>