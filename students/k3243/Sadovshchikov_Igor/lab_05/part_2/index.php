<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<hr>
		<a href='/lab_05/part_2/index.php'> Главная </a><br>
		<a href='/lab_05/part_2/add.php'> Добавить </a><br>
		<a href='/lab_05/part_2/edit.php'> Изменить </a><br>
		<a href='/lab_05/part_2/delete.php'> Удалить </a><br>
		<hr>
	</body>
</html>


<?php
include 'config.php';

$conn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_pass");

echo "<h3> Запрос №1 </h3>";
echo "Получаем имя, фамилию и дату рождения водителей, отсортированных по стажу вождения <br><br>";

$query = "
SELECT first_name, last_name, experience, birthday
FROM driver
INNER JOIN passport ON passport.serial_num = driver.serial_num
ORDER BY experience
";

$cursor = pg_query($conn, $query);

$all = pg_fetch_all($cursor);

foreach ($all as $value) {

	echo "--------------------------------<br>";

	foreach ($value as $key => $value) {

		echo "|  $key: $value <br/>";

	};
	echo "--------------------------------<br>";

};


echo "<h3> Запрос №2 </h3>";
echo "Получаем информацию обо всех автобусах, которые не находятся в ремонте и используют дизельное топливо <br><br>";

$query = "
SELECT *
FROM bus
WHERE status='в эксплуатации' AND fuel_type='дизель'
";

$cursor = pg_query($conn, $query);
$all = pg_fetch_all($cursor);

foreach ($all as $value) {
	echo "--------------------------------<br>";
	foreach ($value as $key => $value) {
		echo "|  $key: $value <br/>";
	}; echo "--------------------------------<br>";
};


echo "<h3> Запрос №3 </h3>";
echo "Получаем имя, фамилию, и опыт водителей, родившихся после 1980-го года, отсортировав по убыванию возраста <br><br>";

$query = "
SELECT first_name, last_name, experience, birthday FROM driver
INNER JOIN passport ON passport.serial_num = driver.serial_num
WHERE birthday > '01.01.1980'
ORDER BY birthday
";

$cursor = pg_query($conn, $query);
$all = pg_fetch_assoc($cursor);

echo "--------------------------------<br>";
foreach ($all as $key => $value) {
	echo "|  $key: $value <br/>";
}; echo "--------------------------------<br>";


echo "<h3> Запрос №4 </h3>";
echo "Выведем информацию, озаглавив все первые буквы в названии органа, выдавшего паспорт <br><br>";
$query = "
SELECT serial_num, first_name, last_name,
INITCAP(issued_by)
FROM passport
";


$cursor = pg_query($conn, $query);
$all = pg_fetch_all($cursor);

foreach ($all as $value) {

	echo "--------------------------------<br>";
	foreach ($value as $key => $value) {
		echo "|  $key: $value <br/>";
	};
	echo "--------------------------------<br>";

};


echo "<h3> Запрос №5 </h3>";
echo "Получаем информацию об автобусах, которые не попадали в происшествия <br><br>";

$query = "
SELECT bus.*
FROM departure AS dep
INNER JOIN bus ON bus.gos_nomer = dep.gos_nomer
WHERE dep.status = 'завершен'
AND NOT EXISTS (SELECT departure_num FROM incident WHERE departure_num=dep.departure_num)
";

$cursor = pg_query($conn, $query);
$all = pg_fetch_all($cursor);

foreach ($all as $value) {
	echo "--------------------------------<br>";
	foreach ($value as $key => $value) {
		echo "|  $key: $value <br/>";
	};
	echo "--------------------------------<br>";
};
?>
