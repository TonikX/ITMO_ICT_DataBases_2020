<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Аэропорт</title>

<style>
    td {
        text-align:center;
    }
    .layer1 {
            padding: 40px 5px 0px;
            float: left;
            width: 100%;
        }
</style>
</head>


<?php

    try {
        $dbuser = 'postgres';
        $dbpass = '89214483826';
        $host = 'localhost';
        $dbname= 'Airport';

        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $value = null;
            $new_value = null;
            $message = "";

            if (isset($_POST["find"])) {
                $sql = 'SELECT * from "Аэропорт"."Авиаперевозчик" where "Номер отдела" = :dep_num and "Название"= :name';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':dep_num' => intval($_POST["dep_num"]), ':name' => $_POST["name"]));
                $value = $sth->fetchAll();
                if(count($value) > 0){
                    $message = "Запись найдена";
                }else{
                    $message = "Запись не найдена";
                }
            }

            if (isset($_POST["edit"])) {
                $exist = false;
                if($_POST["dep_num"] != ""){
                    $sql = 'SELECT * from "Аэропорт"."Авиаперевозчик" where "Номер отдела" = :dep_num and "Название"= :name';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dep_num' => intval($_POST["dep_num"]), ':name' => $_POST["name"]));
                    if (count($sth->fetchAll())>0){
                        $exist = true;
                    }
                }
                if ($exist) {
                    $sql = 'UPDATE "Аэропорт"."Авиаперевозчик" SET "Номер отдела"= :dep_num, "Заключение договоров"= :doc,
                    "Собеседования"= :inter, "Лицензия"= :licence, "Название"= :name
                    where "Номер отдела" = :dep_num and "Название"= :name';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dep_num' => $_POST["dep_num"], ':doc' => $_POST["doc"],
                                        ':inter' => $_POST["inter"], ':licence' => $_POST["licence"],
                                        ':name' => $_POST["name"]));
                    $value = null;
                } elseif($_POST["dep_num"] != "") {
                    $sql = 'INSERT INTO "Аэропорт"."Авиаперевозчик"(
	                        "Номер отдела", "Заключение договоров", "Собеседования", "Лицензия", "Название")
                            VALUES (:dep_num, :doc, :inter, :licence, :name)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dep_num' => $_POST["dep_num"], ':doc' => $_POST["doc"],
                                        ':inter' => $_POST["inter"], ':licence' => $_POST["licence"],
                                        ':name' => $_POST["name"]));
                    $value = null;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET["d_num"] != "" && $_GET["name"] != "") {
                $sql = 'delete from "Аэропорт"."Авиаперевозчик" where "Номер отдела" = :d_num and "Название"= :name';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':d_num' => $_GET["d_num"], ':name' => $_GET["name"]));
                $message = "Запись удалена";
                $value = null;
            }
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>


<body>
<div style='text-align: center'>
    <a href='carrier.php'>Показать всю таблицу</a>
</div>
<div>
    <table align='center' border=1px cellpadding=5px>
        <tbody>
        <tr>
            <th>Номер отдела</th>
            <th>Заключение договоров</th>
            <th>Собеседования</th>
            <th>Лицензия</th>
            <th>Название</th>
            <th>Delete</th>
         </tr>

        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) {
             for($i=0; $i<count($value); $i++) {
                 $dep_num = $value[$i]['Номер отдела'];
                 $doc = $value[$i]['Заключение договоров'];
                 $inter = $value[$i]['Собеседования'];
                 $licence = $value[$i]['Лицензия'];
                 $name = $value[$i]['Название'];
                 echo "<tr>
                        <td>$dep_num</td>
                        <td>$doc</td>
                        <td>$inter</td>
                        <td>$licence</td>
                        <td>$name</td>
                        <td><a href='?d_num=$dep_num&name=$name'>Delete</a></td>
                     </tr>";
             }
        } else {
            $sql = 'SELECT * from "Аэропорт"."Авиаперевозчик"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $dep_num = $data[$i]['Номер отдела'];
                $doc = $data[$i]['Заключение договоров'];
                $inter = $data[$i]['Собеседования'];
                $licence = $data[$i]['Лицензия'];
                $name = $data[$i]['Название'];
                echo "<tr>
                    <td>$dep_num</td>
                    <td>$doc</td>
                    <td>$inter</td>
                    <td>$licence</td>
                    <td>$name</td>
                    <td><a href='?d_num=$dep_num&name=$name'>Delete</a></td>
                 </tr>";
            }
        }?>
        </tbody>
    </table>
</div>

<div class="layer1">
    <form action="carrier.php" method="post">
        <input name="dep_num" size="40" placeholder="Номер отдела" value="<?php echo '' ?>"></br>
        <input name="name" size="40" placeholder="Название" value="<?php echo '' ?>"></br>
        <button type="submit" name="find">Найти</button>
    </form>
    <?php echo $message ?>
</div>

<div class="layer1">
    <form action="carrier.php" method="post">
        <input name="dep_num" size="30" placeholder="..."> - Номер отдела</br>
        <input name="doc" size="30" placeholder="..."> - Заключение договоров</br>
        <input name="inter" size="30" placeholder="..."> - Собеседования</br>
        <input name="licence" size="30" placeholder="..."> - Лицензия</br>
        <input name="name" size="30" placeholder="..."> - Название</br>
        <button type="submit" name="edit">Добавить/Редактировать</button>
    </form>
</div>

</body>
</html>