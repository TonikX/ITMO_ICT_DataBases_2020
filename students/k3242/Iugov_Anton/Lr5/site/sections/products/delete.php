<?php
    include '../../common.php';
    session_start();
    $pdo = get_db();
    try {
        $stmt = $pdo->prepare("DELETE FROM commodities.\"Products\" WHERE \"ID\" = ?");
        $stmt->execute([$_POST['product_id']]);
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: /sections/products/view.php"); 
    exit();
?>