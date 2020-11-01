<?php
    include '../../common.php';
    session_start();
    $pdo = get_db();
    try {
        $stmt = $pdo->prepare("INSERT INTO commodities.\"Products\" (\"Title\", \"Unit\") VALUES (?, ?)");
        $stmt->execute([$_POST['title'], $_POST['units']]);
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: /sections/products/view.php");
    exit();
?>