<?php
define("tr", "<br>");
$title = '1914';
include("header.php");
//$con_link = "host=localhost port=5432 user= postgres password=02588522 dbname=lab_03";
// $dbconn = pg_connect("");
// $result = pg_query($dbconn, "select * from chicken order by id_chicken");
//while ($row = pg_fetch_assoc($result)) {
//    echo $row['id_chicken'].' ';
//    echo $row['chicken_weight'].' ';
//    echo $row['number_of_eggs'].tr;
//}
$dbuser = "postgres";
$dbpass = "02588522";
$host = "localhost";
$dbname="lab_03";
$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);

?>
<div class="container-fluid">
    <div style="margin-top: 30px" class="row justify-content-md-center">
        <h1>Птицефабрика</h1>
    </div>
    <div class="row justify-content-md-center">
        <img style="margin-top: 30px" src="https://static.mk.ru/upload/entities/2016/12/29/articles/detailPicture/b7/f6/22/c28968465_7047236.jpg" alt="">
    </div>
</div>



<?php include ("footer.php"); ?>

