<?php
    include 'database.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $pdo = new PDO('sqlite:database/db.sqlite');
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);

        header('Location: index.php');
    }
?>
