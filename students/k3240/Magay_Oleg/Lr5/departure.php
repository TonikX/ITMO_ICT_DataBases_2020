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
                $sql = 'SELECT * from "Аэропорт"."Вылет" where "Номер рейса" = :race_num';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':race_num' => intval($_POST["race_num"])));
                $value = $sth->fetchAll();
                if(count($value) > 0){
                    $message = "Запись найдена";
                }else{
                    $message = "Запись не найдена";
                }
            }

            if (isset($_POST["edit"])) {
                $exist = false;
                if($_POST["race_num"] != ""){
                    $sql = 'SELECT * from "Аэропорт"."Вылет" where "Номер рейса" = :race_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':race_num' => intval($_POST["race_num"])));
                    if (count($sth->fetchAll())>0){
                        $exist = true;
                    }
                }
                if ($exist) {
                    $sql = 'UPDATE "Аэропорт"."Вылет" SET "Номер рейса"= :race_num, "Пункт вылета"= :dep_place,
                    "Расстояние"= :distance, "Пункт прилета"= :ar_place, "Дата и время"= :date, "Транзит"= :transit,
                    "Номер экипажа"= :crew_num, "Командир"= :commander, "Штурман"= :navigator, "Второй пилот"= :sec_pilot,
                    "Стюарды"= :steward, "Номер выхода"= :gate
                    where "Номер рейса" = :race_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':race_num' => $_POST["race_num"], ':dep_place' => $_POST["dep_place"],
                                        ':distance' => $_POST["distance"], ':ar_place' => $_POST["ar_place"],
                                        ':date' => $_POST["date"], ':transit' => $_POST["transit"],
                                        ':crew_num' => $_POST["crew_num"], ':commander' => $_POST["commander"],
                                        ':navigator' => $_POST["navigator"], ':sec_pilot' => $_POST["sec_pilot"],
                                        ':steward' => $_POST["steward"], ':gate' => $_POST["gate"]));
                    $value = null;
                } elseif($_POST["race_num"] != "") {
                    $sql = 'INSERT INTO "Аэропорт"."Вылет"("Номер рейса", "Пункт вылета", "Расстояние", "Пункт прилета",
                                                     "Дата и время", "Транзит", "Номер экипажа", "Командир",
                                                     "Штурман", "Второй пилот", "Стюарды", "Номер выхода")
                            VALUES (:race_num, :dep_place, :distance, :ar_place, :date, :transit,
                                    :crew_num, :commander, :navigator, :sec_pilot, :steward, :gate)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':race_num' => $_POST["race_num"], ':dep_place' => $_POST["dep_place"],
                                        ':distance' => $_POST["distance"], ':ar_place' => $_POST["ar_place"],
                                        ':date' => $_POST["date"], ':transit' => $_POST["transit"],
                                        ':crew_num' => $_POST["crew_num"], ':commander' => $_POST["commander"],
                                        ':navigator' => $_POST["navigator"], ':sec_pilot' => $_POST["sec_pilot"],
                                        ':steward' => $_POST["steward"], ':gate' => $_POST["gate"]));
                    $value = null;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET["r_num"] != "") {
                $sql = 'delete from "Аэропорт"."Вылет" where "Номер рейса" = :r_num';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':r_num' => $_GET["r_num"]));
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
    <a href='departure.php'>Показать всю таблицу</a>
</div>
<div>
    <table align='center' border=1px cellpadding=5px>
        <tbody>
        <tr>
            <th>Номер рейса</th>
            <th>Пункт вылета</th>
            <th>Расстояние</th>
            <th>Пункт прилета</th>
            <th>Дата и время</th>
            <th>Транзит</th>
            <th>Номер экипажа</th>
            <th>Командир</th>
            <th>Штурман</th>
            <th>Второй пилот</th>
            <th>Стюарды</th>
            <th>Номер выхода</th>
            <th>Delete</th>
         </tr>

        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) {
             $race_num = $value[0]['Номер рейса'];
             $dep_place = $value[0]['Пункт вылета'];
             $distance = $value[0]['Расстояние'];
             $ar_place = $value[0]['Пункт прилета'];
             $date = $value[0]['Дата и время'];
             $transit = $value[0]['Транзит'];
             $crew_num = $value[0]['Номер экипажа'];
             $commander = $value[0]['Командир '];
             $navigator = $value[0]['Штурман'];
             $sec_pilot = $value[0]['Второй пилот'];
             $steward = $value[0]['Стюарды'];
             $gate = $value[0]['Номер выхода'];
             echo "<tr>
                    <td>$race_num</td>
                    <td>$dep_place</td>
                    <td>$distance</td>
                    <td>$ar_place</td>
                    <td>$date</td>
                    <td>$transit</td>
                    <td>$crew_num</td>
                    <td>$commander</td>
                    <td>$navigator</td>
                    <td>$sec_pilot</td>
                    <td>$steward</td>
                    <td>$gate</td>
                    <td><a href='?r_num=$race_num'>Delete</a></td>
                 </tr>";
        } else {
            $sql = 'SELECT * from "Аэропорт"."Вылет"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $race_num = $data[$i]['Номер рейса'];
                $dep_place = $data[$i]['Пункт вылета'];
                $distance = $data[$i]['Расстояние'];
                $ar_place = $data[$i]['Пункт прилета'];
                $date = $data[$i]['Дата и время'];
                $transit = $data[$i]['Транзит'];
                $crew_num = $data[$i]['Номер экипажа'];
                $commander = $data[$i]['Командир '];
                $navigator = $data[$i]['Штурман'];
                $sec_pilot = $data[$i]['Второй пилот'];
                $steward = $data[$i]['Стюарды'];
                $gate = $data[$i]['Номер выхода'];
                echo "<tr>
                    <td>$race_num</td>
                    <td>$dep_place</td>
                    <td>$distance</td>
                    <td>$ar_place</td>
                    <td>$date</td>
                    <td>$transit</td>
                    <td>$crew_num</td>
                    <td>$commander</td>
                    <td>$navigator</td>
                    <td>$sec_pilot</td>
                    <td>$steward</td>
                    <td>$gate</td>
                    <td><a href='?r_num=$race_num'>Delete</a></td>
                 </tr>";
            }
        }?>
        </tbody>
    </table>
</div>

<div class="layer1">
    <form action="departure.php" method="post">
        <input name="race_num" size="40" placeholder="Номер рейса" value="<?php echo '' ?>"></br>
        <button type="submit" name="find">Найти</button>
    </form>
    <?php echo $message ?>
</div>

<div class="layer1">
    <form action="departure.php" method="post">
        <input name="race_num" size="30" placeholder="..."> - Номер рейса</br>
        <input name="dep_place" size="30" placeholder="..."> - Пункт вылета</br>
        <input name="distance" size="30" placeholder="..."> - Расстояние</br>
        <input name="ar_place" size="30" placeholder="..."> - Пункт прилета</br>
        <input name="date" size="30" placeholder="..."> - Дата и время</br>
        <input name="transit" size="30" placeholder="..."> - Транзит</br>
        <input name="crew_num" size="30" placeholder="..."> - Номер экипажа</br>
        <input name="commander" size="30" placeholder="..."> - Командир</br>
        <input name="navigator" size="30" placeholder="..."> - Штурман</br>
        <input name="sec_pilot" size="30" placeholder="..."> - Второй пилот</br>
        <input name="steward" size="30" placeholder="..."> - Стюарды</br>
        <input name="gate" size="30" placeholder="..."> - Номер выхода</br>
        <button type="submit" name="edit">Добавить/Редактировать</button>
    </form>
</div>

</body>
</html>