<?php
echo"<h1><a href = indexx.php>Школа</a></h1>","<br>";
echo"<h2>Запросы</h2>";

$dbuser = "postgres";
$dbpass = "3766";
$host = "localhost";
$dbname = "lab3";
$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);


$query1 = "SELECT firstname,
       lastname,
       disc_type
FROM shkola.teacher
INNER JOIN shkola.discipline ON teacher.id_teacher = discipline.id_teacher
WHERE EXISTS
    (SELECT disc_type
     FROM shkola.discipline
     WHERE discipline.id_teacher = teacher.id_teacher
       AND disc_type LIKE '%ий')";


$query2 = "SELECT firstname,
       lastname,
       cab_number,
       cab_floor
FROM shkola.teacher
LEFT JOIN shkola.cabinet ON teacher.id_cabinet = cabinet.id_cabinet 
WHERE cab_floor = 1";

$query3 = "SELECT disc_type, sub_name FROM shkola.discipline
INNER JOIN shkola.subject ON discipline.id_subject = subject.id_subject";

$result1 = $db->query($query1);
$result2 = $db->query($query2);
$result3 = $db->query($query3);


echo "<h3>Выбор преподавателей название дисциплины которых заканчивается на 'ий'<br></h3>";
foreach ($result1 as $row) {
	echo $row['firstname']." ";
	echo $row['lastname']." ";
	echo $row['disc_type']." "."<br>";
};

echo "<br><br>";
echo "<h3>Выбор преподавателей занятия которых проходят на первом этаже <br></h3>";

foreach ($result2 as $row) {
	echo $row['firstname']." ";
	echo $row['lastname']."	";
	echo "№".$row['cab_number']." ";
	echo $row['cab_floor']." этаж"."<br>";
};

echo "<br><br>";
echo "<h3>Выбор предметов и их вид дисциплины<br></h3>";

foreach ($result3 as $row) {
	echo $row['disc_type']." - ";
	echo $row['sub_name']."<br>";

};

?>