<?php
    include '../../common.php';
    session_start();
    $pdo = get_db();
    try {
        $stmt = $pdo->prepare("INSERT INTO commodities.\"Manufacturers\" (\"Title\") VALUES (?)");
        $stmt->execute([$_POST['title']]);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        if (strpos($msg, 'unique') !== false) {
            $_SESSION['error'] = 'This manufacturer already exists.';
        } else {
            $_SESSION['error'] = $msg;
        }
    }
    header("Location: /sections/manufacturers/view.php");
    exit();
?>