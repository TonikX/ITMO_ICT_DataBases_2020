<?php
    function get_db() {
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=exchange;user=demo");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
?>

