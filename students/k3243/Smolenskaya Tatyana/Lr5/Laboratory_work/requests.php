<html>
<head>
	<meta charset="utf-8">
	<title>Запросы</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: White;
		background-image: url(https://bigpicture.ru/wp-content/uploads/2013/05/HitlersHospital01.jpg);
		-webkit-background-size: 100%;
		background-repeat: round;
        text-align:center;
        font-size: 14px;
		color: White;
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}
	h2 {
		text-align:center;
		color: White;
	}
	button {
		color: White; 
		background: lightblue; 
		padding: 5px; 
		border-radius: 5px;
		border: 2px solid red;
	} 
	button:hover { 
		background: violet; 
	}
	</style>
</head>
<body>

	<h2>Запросы</h2>
	
	<div id="back">
		<form action="index.php">
			<button>Главная</button> 
		</form>
	</div>
<p>
	
	
<?php
$dbuser = 'postgres';
$dbpass = '';
$host = 'localhost';
$dbname= 'hospital';
$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);	

echo 'ФИО пациентов и даты приёма пациентов с сортировкой по дате приёма:', "<br>";
$stmt = $pdo->query('SELECT fio_patient, date_meet FROM hospital."patient", hospital."meet" WHERE "patient".id_patient = "meet".id_patient ORDER BY date_meet');
while ($row = $stmt->fetch())
{
    		echo $row['fio_patient'], " ", $row['date_meet'] . "<br />";
}		
echo "<p>";

echo 'Показать ФИО докторов, их специальность, начало и конец работы с сортировкой по специальности врача в порядке возрастания:', "<br>";
$stmt = $pdo->query('SELECT fio_doctor, specialty, time_start, time_end FROM hospital."doctor", hospital."schedule" WHERE "doctor".id_doctor="schedule".id_doctor ORDER BY specialty ASC');
while ($row = $stmt->fetch())
{
    		echo $row['fio_doctor'], " ", $row['specialty'], " ", $row['time_start'], " ", $row['time_end']  . "<br />";
}		
echo "<p>";

echo 'Максимальная стоимость из прейскуранта:', "<br>";
$stmt = $pdo->query('SELECT MAX(price_service) AS max_price FROM hospital."pricelist"');
while ($row = $stmt->fetch())
{
    		echo $row['max_price']  . "<br />";
}		
echo "<p>";


echo 'Показать ФИО пациентов и дату их рождения, если дата рождения меньше 1970-01-01:', "<br>";
$stmt = $pdo->query('SELECT fio_patient, birthday_date_patient FROM hospital."patient" WHERE "patient".birthday_date_patient < \'1970-01-01\'');
while ($row = $stmt->fetch())
{
    		echo $row['fio_patient'], " ", $row['birthday_date_patient']  . "<br />";
}	

echo "<p>";

echo 'ФИО врачей мужского пола со специальностью «Главный врач»:', "<br>";
$stmt = $pdo->query('SELECT fio_doctor, gender, specialty FROM hospital.doctor WHERE gender=\'Мужской\' AND specialty=\'Главный врач\'');
while ($row = $stmt->fetch())
{
    		echo $row['fio_doctor'], "-", $row['gender'], "-", $row['specialty']  . "<br />";
}	
?> 
</body>
