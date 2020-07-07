<?php
$dbuser = 'postgres';$dbpassword = '756831';$host = 'localhost';$dbname = 'db_lab';

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Main Page</title>
</head>
<body>

<form action="medcard.php" target="_blank">
    <button>Мед.Карта</button></br></form>

<form action="reception_cost.php" target="_blank">
    <button>Стоимость Приема</button></br></form>

<form action="reception.php" target="_blank">
    <button>Приемы</button></br></form>

<form action="diag_patient.php" target="_blank">
    <button>Диагнозы Пациента</button></br></form>

<form action="diagnosis.php" target="_blank">
    <button>Диагнозы</button></br></form>

</body>
</html>