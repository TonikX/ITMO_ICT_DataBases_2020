<?php
    include '../../common.php';
    session_start();
    try {
        $pdo = get_db();
        $stmt = $pdo->prepare("DELETE FROM commodities.\"Batches\" WHERE \"ID\" = ?");
        $stmt->execute([$_POST['id']]);
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: /sections/batches/view.php"); 
    exit();
?>