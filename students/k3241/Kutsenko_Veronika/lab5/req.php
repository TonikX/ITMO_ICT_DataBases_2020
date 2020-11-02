<!DOCTYPE html>

<?php

$connect = pg_connect("host=localhost port=5432 dbname=Lych user=postgres password=123");

echo "<h3>Сопоставить работников с их трудовыми соглашениями, отсортировать по ФИО</h3>";
$q = 'select * from "Worker" inner join "Labor_contract" on "Worker"."Work_ID"="Labor_contract"."Work_ID" order by "Worker"."FIO"';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Найти оплаченное платежное поручение с датой 12.01</h3>";
$q = 'select * from "Payment_order" where "Status" = \'Y\' and "Date" = \'12/01\'';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Найти материалы с айди 1 или 2</h3>";
$q = 'select * from "Material" where "Mat_ID" = \'1\' or "Mat_ID" = \'2\'';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Посчитать кол-во неоплаченных платежных поручений</h3>";
$q = 'select count(*) from "Payment_order" where "Status" = \'N\'';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Объединить таблицы Клиент и Заявка по имени клиента</h3>";
$q = 'select * from "Client" inner join "Request" on "Client"."Name"="Request"."Name"';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};
?>

<form action="index.php">
<button>На главную</button></br></form>