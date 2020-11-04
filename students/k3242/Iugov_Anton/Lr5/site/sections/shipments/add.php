<?php
    include '../../common.php';
    session_start();
    $pdo = get_db();
    try {
        $stmt = $pdo->prepare("INSERT INTO commodities.\"Shipments\" (\"Broker_ID\", \"Items\", \"Subtotal\", \"Prepayment\", \"Shipped_at\") VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['Broker_ID'], $_POST['Items'], $_POST['Subtotal'], $_POST['Prepayment'], $_POST['Shipped_at']]);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        if (strpos($msg, 'Invalid text representation') !== false) {
            $_SESSION['error'] = $msg; #'Please check that your data is correct (i.e., datatypes).';
        } elseif (strpos($msg, 'Foreign key violation') !== false) {
            $_SESSION['error'] = 'Please check that you are referring to a valid ID.';
        } elseif (strpos($msg, 'Items negative') !== false) {
            $_SESSION['error'] = 'There must be at least one item in a shipment.';
        } elseif (strpos($msg, 'Subtotal negative') !== false) {
            $_SESSION['error'] = 'Subtotal cannot be a negative value.';
        } else {
            $_SESSION['error'] = $msg;
        }
    }
    header("Location: /sections/shipments/view.php");
    exit();
?>