<?php


$dbName = "ptizefabrika";
$dbuser = "root";
$dbpass = "";

$pdo = new PDO("mysql:host=localhost;dbname=$dbName", $dbuser, $dbpass);

$sql1 = 'select id_breed_fk from chicken inner join cage on
cage.id_of_cage = chicken.id_cage_fk where id_of_cage=2 order by
id_breed_fk';
$sql2 = 'select * from chicken group by id_of_chicken having num_of_eggs > 12';

$sql3 = 'select avg(num_of_eggs), max(weight) from chicken where chicken.id_cage_fk not in(1, 3)';

$sql4 = 'select capacity, upper(name_of_breed) from breed where average_weight > 4 ';

$sql5 = 'select capacity from cage where id_of_cage = any(select id_of_cage from cage
intersect select id_cage_fk from chicken)';



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

