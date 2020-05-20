<?php
$dbuser = 'postgres';
$dbpassword = 'admin';
$host = 'localhost';
$dbname = 'library';

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
$sql1= 'SELECT full_name FROM public."Readers" order by full_name ASC';
$sql2= 'SELECT * FROM public."Readers" 
  inner join public."Instance_issues" 
  on public."Instance_issues".id_reader = public."Readers".id 
  order by number_of_card';
$sql3= 'SELECT AVG((current_date - "Readers".data_of_birthday)/365) as age, AVG(ABS("Instance_issues".date_of_issue - "Instance_issues".return_date )) from public."Readers"
  INNER JOIN "Instance_issues" on "Readers".id = "Instance_issues".id_reader';
$sql4= 'Select * from public."Books" where name Like \'%7%\' union
  Select * from public."Books" where debit_date is not NULL';
$sql5= 'Select * from public."Books" where POSITION(btrim(LOWER(\'Узник     \')) in LOWER(name)) > 0 or POSITION(btrim(LOWER(\'   Джон  \')) in LOWER(author)) > 0';
$reqs = array($sql1, $sql2, $sql3, $sql4, $sql5);
foreach ($reqs as $value) {
    foreach ($pdo->query($value) as $row) {
        print_r($row);
    }
    echo "</br>";
    echo "</br>";
}