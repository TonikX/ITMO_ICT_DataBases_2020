<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>5 запросов</title>
</head>
<b>Запросы лабы №4:</b></br>
<?php
$dbuser = 'postgres';
$dbpassword = '1234';
$host = 'localhost';
$dbname = 'lab3';

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
$sql1= 'SELECT * FROM public."Postoffice" WHERE "Post_adress" LIKE \'%д.34%\' OR "Branch_number" > 10';
$sql2= 'SELECT * FROM public."Newspaper" INNER JOIN public."Edition" on "Edition"."ID_Newspaper"="Newspaper"."ID_Newspaper" ORDER BY "Publication_number"'; 
$sql3= 'SELECT * FROM public."Newspaper" WHERE POSITION(btrim(LOWER(\' Сергей \')) in LOWER ("Reductor"))>0 OR POSITION(btrim(LOWER(\'С\')) in LOWER("Naming"))>0';
$sql4= 'SELECT COUNT(DISTINCT "Printed_quantity") AS "Quantity_of_1_ID_Edition" FROM public."Print" WHERE "Printed_quantity" IN (SELECT "Printed_quantity" FROM public."Print" WHERE "ID_Edition" = 1)';
$sql5= 'SELECT "Newspaper"."Naming", "Newspaper"."Index", "Newspaper"."Reductor", MIN ("Print"."Printed_quantity") FROM public."Edition" INNER JOIN public."Newspaper" ON "Edition"."ID_Newspaper"="Newspaper"."ID_Newspaper" INNER JOIN public."Print" ON "Edition"."ID_Edition"="Print"."ID_Edition"GROUP BY "Newspaper"."Naming", "Newspaper"."Index", "Newspaper"."Reductor" HAVING MIN ("Print"."Printed_quantity")<11';
$reqs = array($sql1, $sql2, $sql3, $sql4, $sql5);
foreach ($reqs as $value) {
    foreach ($pdo->query($value) as $row) {
        print_r($row);
    }
    echo "</br>";
    echo "</br>";
}
?>
<br><a href="index.php">"Назад"</a><br/>
</html>