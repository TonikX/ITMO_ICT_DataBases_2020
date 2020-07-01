<?php
$dbuser = 'postgres';$dbpassword = 'XHUSF2rS';$host = 'localhost';$dbname = 'clinics';$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpassword);

$a1= 'Id докторов с именем Кирилл Петров и образование BD по алфавиту по возрастанию:';
$sql1= 'SELECT id_doctor FROM public."Doctors" 
WHERE "Doctors".full_name = \'Kirill Petrov\' and "Doctors".education = \'BD\'
ORDER BY full_name ASC';

$a2= 'Информация о приеме, где состояние пациента normal или рекомендуется оставаться дома, по алфавиту по возрастанию состояния пациента:';
$sql2= 'SELECT * FROM public."Priem" where patient_state=\'N\' UNION
SELECT * FROM public."Priem" where recommendations=\'stay home\' 
ORDER BY patient_state ASC';

$a3='Информация о пациентах, которые были на приеме:';
$sql3= 'SELECT * FROM public."Priem_cost"
INNER JOIN public."Priem"
ON "Priem_cost".id_priem = "Priem"."id_priemFK"
ORDER BY id_priem DESC';
 
$a4='Выборочная информация о докторах с именем Sam или Артем, результат по алфавиту по возрастанию:';
$sql4= 'SELECT UPPER(full_name), specialization, male_female, birthday FROM public."Doctors"
WHERE (POSITION(\'Sam\' in full_name) = 1 or POSITION(\'Artem\' in full_name) = 1)
ORDER BY UPPER(full_name) ASC';

$a5='Полное ФИО пациента с самой ранней датой приема:';
$sql5= 'SELECT "Medical_records".full_name as patient  FROM public."Medical_records"
INNER JOIN public."Priem" ON "Medical_records".id_patient = "Priem"."id_patientFK"
ORDER BY "Priem".date_priem limit 1';

$sql = array($sql1, $sql2, $sql3, $sql4, $sql5);
$a = array($a1, $a2, $a3, $a4, $a5);

$i=0; 
foreach ($sql as $value) {
	echo $a[$i];
	echo "</br>";
		foreach ($pdo->query($value) as $data) {
		for ($p=0; $p<100; $p++){
		print_r($data[$p].'  ');
		}	
		echo "</br>";
		}
		$i+=1;
		echo "</br>";
		echo "</br>";
		echo "</br>";
	}
	
?>

<html>
 <head>
  <meta charset="utf-8">
  <title>main</title>
 </head>
 <body>
  <form action="http://localhost:8888/my/2.php" target="_blank">
   <button>Таблица медицинских карт</button></br></form>

<form action="http://localhost:8888/my/3.php" target="_blank">
   <button>Таблица стоимости приемов</button></br></form>

<form action="http://localhost:8888/my/4.php" target="_blank">
   <button>Таблица приемов</button></br></form>

<form action="http://localhost:8888/my/5.php" target="_blank">
   <button>Таблица диагнозы пациента</button></form>

<form action="http://localhost:8888/my/6.php" target="_blank">
   <button>Таблица диагнозов</button></form>
  </form>
 </body>
</html>

