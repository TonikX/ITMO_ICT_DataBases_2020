<?php
    include '../../common.php';
    session_start();
    try {
        $pdo = get_db();
        $stmt = $pdo->prepare("INSERT INTO commodities.\"Batches\" (\"Manufacturer_ID\", \"Product_ID\", \"Shipment_ID\", \"Price\", \"Quantity\", \"Produced_at\", \"Expires_at\") VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['Manufacturer_ID'], $_POST['Product_ID'], $_POST['Shipment_ID'], $_POST['Price'], $_POST['Quantity'], $_POST['Produced_at'], $_POST['Expires_at']]);
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: /sections/batches/view.php");
    exit();
?>