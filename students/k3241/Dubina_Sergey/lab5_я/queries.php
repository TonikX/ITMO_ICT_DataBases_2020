<?php


$dbName = "university";
$dbuser = "sergey";
$dbpass = "2058";

$pdo = new PDO("mysql:host=localhost;dbname=$dbName", $dbuser, $dbpass);

$sql1 = 'select * from abiturient inner join 9_grade_certificat on
9_grade_certificat.abiturient_id_fk = abiturient.abiturient_id where
9_grade_certificat.prof_discipline_1>58';
$sql2 = 'select spciality_name from speciality inner join faculty on faculty.faculty_id = speciality.faculty_id_fk where faculty_id<4 order by
spciality_name ASC';

$sql3 = 'select faculty_name from faculty where faculty_id = any(select faculty_id from faculty intersect select faculty_id_fk from abiturient)';

$sql4 = 'select avg(prof_discipline_1), max(prof_discipline_2) from 9_grade_certificat
where 9_grade_certificat.abiturient_id_fk not in(3, 4)';

$sql5 = 'select avg(prof_discipline_1) from 9_grade_certificat inner join abiturient on
9_grade_certificat.abiturient_id_fk = abiturient.abiturient_id where silver_medal = true';



$reqs = array($sql1, $sql2, $sql3, $sql4, $sql5);
$i = 0;
foreach ($reqs as $value) {
    $i++;
    echo $i, " запрос:" ;
    echo "</br>";
    
    foreach ($pdo->query($value) as $row) {
        for ($j = 0; $j < (count($row))/2; $j++){
        print $row[$j];
        echo "</br>";
    }
    }
    echo "</br>";
}

?>

