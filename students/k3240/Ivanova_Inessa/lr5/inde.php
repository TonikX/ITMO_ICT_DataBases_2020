<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<nav>
		<a href='add.php'>Добавить</a>
		<a href='edit.php'>Изменить</a>
		<a href='delete.php'>Удалить</a>
		</nav>
	</body>
</html>

<?php

$connect = pg_connect("host=localhost port=5432 dbname=ClinicDB user=postgres password=1708") or die('failed');

echo "<h3>Оплаченные консультации врача с id 102</h3>";
$q = 'select "patient_id(FK)", "cons_date", "office_number(FK)", "service_id(FK)" from "ClinicDB"."Consultations" where "payment_status" = 1 and "doc_id(FK)" = 102';
$cur = pg_query($connect, $q);
$all = pg_fetch_all($cur);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Количество оплаченных консультаций</h3>";
$q = 'select count(*) from "ClinicDB"."Consultations" where ("payment_status" = 1)';
$cur = pg_query($connect, $q);
$all = pg_fetch_all($cur);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	}; 
	echo "<br>";
};

echo "<h3>Пациенты, которые еще не были на приеме</h3>";
$q = 'select "patient_id" from "ClinicDB"."MedicalFiles" except select "patient_id(FK)" from "ClinicDB"."Consultations" ';
$cur = pg_query($connect, $q);
$all = pg_fetch_all($cur);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Кабинеты в доступном расписании</h3>";
$q = 'select "office_number(FK)" from "ClinicDB"."Timetable" intersect select "office_number" from "ClinicDB"."Offices" ';
$cur = pg_query($connect, $q);
$all = pg_fetch_all($cur);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};

echo "<h3>Пациент случая заболевания с id 328</h3>";
$q = 'select patient_name from "ClinicDB"."MedicalFiles" where patient_id = (select "patient_id(FK)" from "ClinicDB"."IllnesCases" where case_id = 328)';
$cur = pg_query($connect, $q);
$all = pg_fetch_all($cur);
foreach ($all as $value) {	
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	};
	echo "<br>";
};


?>