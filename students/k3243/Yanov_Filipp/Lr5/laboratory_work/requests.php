<html>
<head>
	<meta charset="utf-8">
	<title>Запросы</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: LightBlue;
		background-image: url(https://st03.kakprosto.ru/images/article/2011/6/27/1_525505b025507525505b025544.jpg);
		background-repeat: round;
        text-align:center;
        font-size: 14px;
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}
	button {
		background: LightBlue;
	}
	</style>
</head>
<body>

	<h2>Запросы</h2>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
<?php
$dbuser = 'postgres';
$dbpass = 'postgres';
$host = 'localhost';
$dbname= 'airport';
$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);	

echo 'Инициалы работников при условии наличия высшего образования и возраста после 30 лет с сортировкой по алфавиту:', "<br>";
$stmt = $pdo->query('SELECT fio FROM airport."rabotnik" WHERE "rabotnik".uroven_obrazovania = \'Vysshee\' and "rabotnik".vozrast > 30 ORDER BY fio ASC');
while ($row = $stmt->fetch())
{
    		echo $row['fio'] . "<br />";
}		
echo "<p>";

echo 'Возраст самого пожилого работника в компании:', "<br>";
$stmt = $pdo->query('SELECT MAX(vozrast) AS max_vozrast FROM airport."rabotnik"');
while ($row = $stmt->fetch())
{
    		echo $row['max_vozrast']  . "<br />";
}		
echo "<p>";

echo 'Число мест и количество проданных билетов на рейс с сортировкой по числу мест:', "<br>";
$stmt = $pdo->query('SELECT DISTINCT chislo_mest, kolichestvo_prodannych_biletov FROM airport."samolet", airport."polet" WHERE "samolet".pozyvnoi = "polet".pozyvnoi ORDER BY chislo_mest');
while ($row = $stmt->fetch())
{
    		echo $row['chislo_mest'], " ", $row['kolichestvo_prodannych_biletov']  . "<br />";
}	

echo "<p>";

echo 'Объединие типа самолёта (компании производителя) с номером его модели, чтобы сразу получить название всей модели:', "<br>";
$stmt = $pdo->query('SELECT CONCAT (tip, nomer_modeli) AS model FROM airport."samolet"; ');
while ($row = $stmt->fetch())
{
    		echo $row['model']  . "<br />";
}	

echo "<p>";

echo 'Подсчёт, сколько самолётов в ремонте с причиной поломки «шасси»:', "<br>";
$stmt = $pdo->query('SELECT COUNT(*) AS podscet FROM airport."remont" WHERE polomka = \'Shassi\'');
while ($row = $stmt->fetch())
{
    		echo $row['podscet']  . "<br />";
}	
?> 
