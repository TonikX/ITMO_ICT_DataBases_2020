<?php
    include '../../common.php';
    session_start();
    $pdo = get_db();
    try {
        $stmt = $pdo->prepare("DELETE FROM commodities.\"Manufacturers\" WHERE \"ID\" = ?");
        $stmt->execute([$_POST['manufacturer_id']]);
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: /sections/manufacturers/view.php"); 
    exit();
?>