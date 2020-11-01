<?php
    include '../../common.php';
    session_start();
    $pdo = get_db();
    try {
        $stmt = $pdo->prepare("DELETE FROM commodities.\"Shipments\" WHERE \"ID\" = ?");
        $stmt->execute([$_POST['id']]);
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: /sections/shipments/view.php"); 
    exit();
?>