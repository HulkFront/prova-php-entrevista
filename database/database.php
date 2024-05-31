<?php
    function getDatabaseConnection() {
        $pdo = new PDO('sqlite:database/db.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
?>
