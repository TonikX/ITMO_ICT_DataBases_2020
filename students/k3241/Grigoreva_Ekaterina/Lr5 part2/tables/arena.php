<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dog Show</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <nav class="navbar navbar-default">
        <div class="">
            <div>
                <a class="navbar-brand" style="margin-left: 46%" href="arena.php">Arena</a>
            </div>
        </div>
    </nav>

    <style>
        body {
            background-color: #edf6fa;
        }
        .layer1 {
            boarder: 1px;
            padding: 5px;
            float: left;
            width: 500px;
        }
        .layer2 {
            boarder: 1px;
            padding: 5px;
            width: 400px;
            float: right;
        }
    </style>
</head>


<?php

    try {
        $dbuser = 'postgres';
        $dbpass = '89214483826';
        $host = 'localhost';
        $dbname= 'Dog_show';

        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $value = null;
            $new_value = null;
            $message = "";

            if (isset($_POST["find"])) {
                $sql = 'SELECT * from show."Arena" where "Arena_number" = :arena_num';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':arena_num' => intval($_POST["arena_num"])));
                $value = $sth->fetchAll();
                if(count($value) > 0){
                    $message = "Запись найдена";
                }else{
                    $message = "Запись не найдена";
                }
            }

            if (isset($_POST["edit"])) {
                $exist = false;
                if($_POST["arena_num"] != ""){
                    $sql = 'SELECT * from show."Arena" where "Arena_number" = :arena_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':arena_num' => intval($_POST["arena_num"])));
                    if (count($sth->fetchAll())>0){
                        $exist = true;
                    }
                }
                if ($exist) {
                    $sql = 'UPDATE show."Arena" SET "Arena_number"= :arena_num, "Arena_name"= :arena_name
                    where "Arena_number" = :arena_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':arena_num' => $_POST["arena_num"], ':arena_name' => $_POST["arena_name"]));
                    $sql = 'SELECT * from show."Arena" where "Arena_number" = :arena_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':arena_num' => intval($_POST["arena_num"])));
                    $new_value = $sth->fetchAll();
                    $message = "Запись изменена";
                    $value = null;
                } elseif($_POST["arena_num"] != "") {
                    $sql = 'INSERT INTO show."Arena"("Arena_number", "Arena_name") VALUES (:arena_num, :arena_name)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':arena_num' => $_POST["arena_num"], ':arena_name' => $_POST["arena_name"]));
                    $sql = 'SELECT * from show."Arena" where "Arena_number" = :arena_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':arena_num' => intval($_POST["arena_num"])));
                    $new_value = $sth->fetchAll();
                    $message = "Запись добавлена";
                    $value = null;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET["a_num"] != "") {
                $sql = 'delete from show."Arena" where "Arena_number" = :arena_num';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':arena_num' => $_GET["a_num"]));
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
<div class="layer1" align="left">
    <form action="arena.php" method="post">
        <input name="arena_num" size="30" placeholder="arena number..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Arena_number']?>"> - Номер арены</br>
        <input name="arena_name" size="30" placeholder="arena name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Arena_name']?>"> - Название</br>
        <button type="submit" name="edit">Добавить/Редактировать</button>
    </form>
</div>
<div class="layer2" align="right">
    <form action="arena.php" method="post">
        <input name="arena_num" size="40" placeholder="Arena number..." value="<?php echo '' ?>"></br>
        <button type="submit" name="find">Найти</button>
    </form>
    <?php echo $message ?>
</div>
<div class="container">
    <table class="table">
        <tbody>
        <tr>
            <th>Arena_number</th>
            <th>Arena_name</th>
            <th>Delete</th>
         </tr>

        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) {
            $arena_num = $value[0]['Arena_number'];
            $arena_name = $value[0]['Arena_name'];
            echo "<tr>
                <td>$arena_num</td>
                <td>$arena_name</td>
                <td><a href='?a_num=$arena_num'>Delete</a></td>
             </tr>";
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $new_value) {
            $arena_num = $new_value[0]['Arena_number'];
            $arena_name = $new_value[0]['Arena_name'];
            echo "<tr>
                <td>$arena_num</td>
                <td>$arena_name</td>
                <td><a href='?a_num=$arena_num'>Delete</a></td>
             </tr>";
        } else {
            $sql = 'SELECT * from show."Arena"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $arena_num = $data[$i]['Arena_number'];
                $arena_name = $data[$i]['Arena_name'];
                echo "<tr>
                    <td>$arena_num</td>
                    <td>$arena_name</td>
                    <td><a href='?a_num=$arena_num'>Delete</a></td>
                 </tr>";
            }
        }?>
        </tbody>
    </table>
</div>


</body>
</html>