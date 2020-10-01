<html>
<head>
	<meta charset="utf-8">
	<title>Главная страница</title>
	<style type="text/css">
	body {
		background-color:White
	}
	h3 {
		text-align:center
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}

	</style>
</head>
<body>

	<h3>Главная страница<p>Запросы</p></h3>

	<div id="back">
		<form action="Enrollee.php">
			<button>Список абитуриентов</button> 
		</form>
		<form action="Faculty.php">
			<button>Факультеты</button> 
		</form>
		<form action="Specialty.php">
			<button>Специальности</button> 
		</form>
		<form action="11_class.php">
			<button>11 класс</button> 
		</form>
		<form action="Secretary.php">
			<button>Секретари</button> 
		</form>
		<form action="BaSiS.php">
			<button>Практика</button> 
		</form>
	</div>

<?php
//https://www.youtube.com/watch?v=0X9zP5thT38//

$dbuser = 'postgres';
$dbpass = 'Kriper13';
$host = 'localhost';
$dbname='postgres';
$dbconnect = pg_connect("host=$host port=5433 dbname=$dbname user=$dbuser password=$dbpass")
or die("Error: " . pg_last_error());
echo 'Вывод таблиц базы данных:</br>';
$query = 'SELECT * FROM information_schema.tables where table_schema = \'students\';';
$result = pg_query($query)
or die('Query failed: ' . pg_last_error());
$result = pg_fetch_all($result);
foreach ($result as $tab)
	echo $tab['table_name'].' ';
//echo '<pre>'; print_r($result); echo '<pre>';

echo '</br></br>Вывод содержимого таблицы enrollee</br>';
$query = 'SELECT * FROM "students"."enrollee"';
$result = pg_query($query)
or die('Query failed: ' . pg_last_error());
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($result);

echo '</br></br>1. Количество абитуриентов, подавших заявления на каждую специальность по каждой форме обучения на контракт:</br>';
$query = 'SELECT "Specialty"."Name", "Request"."Form", COUNT("Request"."ID_Enrollee")
FROM "students"."Request"
INNER JOIN "students"."Specialty"
ON "Request"."ID_Specialty" = "Specialty"."ID_Specialty"
INNER JOIN "students"."Form"
ON "Request"."Form" = "Form"."Type"
WHERE "Specialty"."Basis" = \'Contract\'
GROUP BY "Specialty"."Name", "Request"."Form"';
$result = pg_query($query)
or die('Query failed: ' . pg_last_error());
//$result = pg_fetch_all($result);
//echo '<pre>'; print_r($result); echo '<pre>';
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($result);

echo '</br></br>2. Кол-во поданных заявлений по датам:</br>';
$query = 'SELECT "Request"."Date" AS date, COUNT("Request"."Date")
FROM "students"."Request"
GROUP BY date
ORDER BY date';
$result = pg_query($query)
or die('Query failed: ' . pg_last_error());
//$result = pg_fetch_all($result);
//echo '<pre>'; print_r($result); echo '<pre>';
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($result);

echo '</br></br>3. Конкурс на каждую специальность по каждой форме обучения на бюджет:</br>';
$query = 'SELECT "Specialty"."Name" AS specialty, ROUND(CAST(COUNT("Request"."ID_Enrollee") AS NUMERIC) / CAST("Specialty"."Number_of_places" AS NUMERIC), 2) AS competition
FROM "students"."Request"
INNER JOIN "students"."Specialty"
ON "Request"."ID_Specialty" = "Specialty"."ID_Specialty"
WHERE "Specialty"."Basis" = \'Budget\'
GROUP BY "Specialty"."Name", "Specialty"."Number_of_places"';
$result = pg_query($query)
or die('Query failed: ' . pg_last_error());
//$result = pg_fetch_all($result);
//echo '<pre>'; print_r($result); echo '<pre>';
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($result);

echo '</br></br>4. Вывод таблицы среднего балла по каждой специальности на базе 11 классов:</br>';
$query = 'SELECT "Specialty"."Name", ROUND(AVG("Request"."Rating"), 2)
FROM "students"."Request"
INNER JOIN "students"."Specialty"
ON "Request"."ID_Specialty" = "Specialty"."ID_Specialty"
INNER JOIN "students"."enrollee"
ON "Request"."ID_Enrollee" = "enrollee"."ID_Enrollee"
GROUP BY "Specialty"."Name", "enrollee"."Base"
HAVING "enrollee"."Base" = \'11\'';
$result = pg_query($query)
or die('Query failed: ' . pg_last_error());
//$result = pg_fetch_all($result);
//echo '<pre>'; print_r($result); echo '<pre>';
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($result);

echo '</br></br>5. Вывод имен и рейтинга абитуриентов на базе 11-х классов, где рейтинг абитуриентов выше, чем у абитуриента (\'Danil\'):</br>';
$query = 'SELECT "enrollee"."Name", "Request"."Rating"
FROM "students"."enrollee"
INNER JOIN "students"."Request"
ON "enrollee"."ID_Enrollee" = "Request"."ID_Enrollee"
WHERE "enrollee"."Base" = \'11\' AND "Request"."Rating" >
(SELECT "Request"."Rating"
FROM "students"."enrollee"
INNER JOIN "students"."Request"
ON "enrollee"."ID_Enrollee" = "Request"."ID_Enrollee"
WHERE "enrollee"."Name" = \'Danil\')';
$result = pg_query($query)
or die('Query failed: ' . pg_last_error());
//$result = pg_fetch_all($result);
//echo '<pre>'; print_r($result); echo '<pre>';
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";
pg_free_result($result);
?>

