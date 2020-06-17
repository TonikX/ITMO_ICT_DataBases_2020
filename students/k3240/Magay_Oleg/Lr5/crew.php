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
                $sql = 'SELECT * from "Аэропорт"."Экипаж" where "Номер экипажа" = :crew_num';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':crew_num' => intval($_POST["crew_num"])));
                $value = $sth->fetchAll();
                if(count($value) > 0){
                    $message = "Запись найдена";
                }else{
                    $message = "Запись не найдена";
                }
            }

            if (isset($_POST["edit"])) {
                $exist = false;
                if($_POST["crew_num"] != ""){
                    $sql = 'SELECT * from "Аэропорт"."Экипаж" where "Номер экипажа" = :crew_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':crew_num' => intval($_POST["crew_num"])));
                    if (count($sth->fetchAll())>0){
                        $exist = true;
                    }
                }
                if ($exist) {
                    $sql = 'UPDATE "Аэропорт"."Экипаж" SET "Номер экипажа"= :crew_num, "Командир"= :commander, "Штурман"= :navigator, "Второй пилот"= :sec_pilot,
                    "Стюарды"= :steward where "Номер экипажа" = :crew_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':crew_num' => $_POST["crew_num"], ':commander' => $_POST["commander"],
                                        ':navigator' => $_POST["navigator"], ':sec_pilot' => $_POST["sec_pilot"],
                                        ':steward' => $_POST["steward"]));
                    $value = null;
                } elseif($_POST["crew_num"] != "") {
                    $sql = 'INSERT INTO "Аэропорт"."Экипаж"(
	                        "Номер экипажа", "Командир ", "Штурман", "Второй пилот", "Стюарды")
                            VALUES (:crew_num, :commander, :navigator, :sec_pilot, :steward)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':crew_num' => $_POST["crew_num"], ':commander' => $_POST["commander"],
                                        ':navigator' => $_POST["navigator"], ':sec_pilot' => $_POST["sec_pilot"],
                                        ':steward' => $_POST["steward"]));
                    $value = null;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET["с_num"] != "") {
                $sql = 'delete from "Аэропорт"."Экипаж" where "Номер экипажа" = :с_num';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':с_num' => $_GET["с_num"]));
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
    <a href='crew.php'>Показать всю таблицу</a>
</div>
<div>
    <table align='center' border=1px cellpadding=5px>
        <tbody>
        <tr>
            <th>Номер экипажа</th>
            <th>Командир</th>
            <th>Штурман</th>
            <th>Второй пилот</th>
            <th>Стюарды</th>
            <th>Delete</th>
         </tr>

        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) {
             for($i=0; $i<count($value); $i++) {
                 $crew_num = $value[0]['Номер экипажа'];
                 $commander = $value[0]['Командир '];
                 $navigator = $value[0]['Штурман'];
                 $sec_pilot = $value[0]['Второй пилот'];
                 $steward = $value[0]['Стюарды'];
                 echo "<tr>
                        <td>$crew_num</td>
                        <td>$commander</td>
                        <td>$navigator</td>
                        <td>$sec_pilot</td>
                        <td>$steward</td>
                        <td><a href='?с_num=$crew_num'>Delete</a></td>
                     </tr>";
             }
        } else {
            $sql = 'SELECT * from "Аэропорт"."Экипаж"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $crew_num = $data[$i]['Номер экипажа'];
                $commander = $data[$i]['Командир '];
                $navigator = $data[$i]['Штурман'];
                $sec_pilot = $data[$i]['Второй пилот'];
                $steward = $data[$i]['Стюарды'];
                echo "<tr>
                    <td>$crew_num</td>
                    <td>$commander</td>
                    <td>$navigator</td>
                    <td>$sec_pilot</td>
                    <td>$steward</td>
                    <td><a href='?с_num=$crew_num'>Delete</a></td>
                 </tr>";
            }
        }?>
        </tbody>
    </table>
</div>

<div class="layer1">
    <form action="crew.php" method="post">
        <input name="crew_num" size="40" placeholder="Номер экипажа" value="<?php echo '' ?>"></br>
        <button type="submit" name="find">Найти</button>
    </form>
    <?php echo $message ?>
</div>

<div class="layer1">
    <form action="crew.php" method="post">
        <input name="crew_num" size="30" placeholder="..."> - Номер экипажа</br>
        <input name="commander" size="30" placeholder="..."> - Командир</br>
        <input name="navigator" size="30" placeholder="..."> - Штурман</br>
        <input name="sec_pilot" size="30" placeholder="..."> - Второй пилот</br>
        <input name="steward" size="30" placeholder="..."> - Стюарды</br>
        <button type="submit" name="edit">Добавить/Редактировать</button>
    </form>
</div>

</body>
</html>