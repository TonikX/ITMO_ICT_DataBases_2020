<!DOCTYPE html>

<?php

$connect = pg_connect("host=localhost port=5432 dbname=Lych user=postgres password=123");

echo "<h3>Клиент, заявка и платежное поручение</h3>";
$q = 'select * from "Client" inner join "Request" on "Client"."Name"="Request"."Name" inner join "Payment_order" on "Payment_order"."Req_ID"="Request"."Req_ID"';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Работники и их трудовые соглашения</h3>";
$q = 'select * from "Worker" inner join "Labor_contract" on "Worker"."Work_ID"="Labor_contract"."Work_ID"';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Услуги</h3>";
$q = 'select * from "Price_list" inner join "Service" on "Price_list"."Serv_ID"="Service"."Serv_ID"';
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Материалы</h3>";
$q = 'select * from "Material_list"';
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