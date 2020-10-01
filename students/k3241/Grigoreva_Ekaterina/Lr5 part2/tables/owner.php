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
                <a class="navbar-brand" style="margin-left: 46%" href="owner.php">Owner</a>
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
                $sql = 'SELECT * from show."Owner" where "Owner_passport" = :owner_pas';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':owner_pas' => intval($_POST["owner_pas"])));
                $value = $sth->fetchAll();
                if(count($value) > 0){
                    $message = "Запись найдена";
                }else{
                    $message = "Запись не найдена";
                }
            }

            if (isset($_POST["edit"])) {
                $exist = false;
                if($_POST["owner_pas"] != ""){
                    $sql = 'SELECT * from show."Owner" where "Owner_passport" = :owner_pas';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':owner_pas' => intval($_POST["owner_pas"])));
                    if (count($sth->fetchAll())>0){
                        $exist = true;
                    }
                }
                if ($exist) {
                    $sql = 'UPDATE show."Owner" SET "Owner_passport"= :owner_pas, "Owner_name"= :owner_name
                    where "Owner_passport" = :owner_pas';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':owner_pas' => $_POST["owner_pas"], ':owner_name' => $_POST["owner_name"]));

                    $sql = 'SELECT * from show."Owner" where "Owner_passport" = :owner_pas';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':owner_pas' => intval($_POST["owner_pas"])));
                    $new_value = $sth->fetchAll();
                    $message = "Запись изменена";
                    $value = null;
                } elseif($_POST["owner_pas"] != "") {
                    $sql = 'INSERT INTO show."Owner"("Owner_passport", "Owner_name") VALUES (:owner_pas, :owner_name)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':owner_pas' => $_POST["owner_pas"], ':owner_name' => $_POST["owner_name"]));

                    $sql = 'SELECT * from show."Owner" where "Owner_passport" = :owner_pas';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':owner_pas' => intval($_POST["owner_pas"])));
                    $new_value = $sth->fetchAll();
                    $message = "Запись добавлена";
                    $value = null;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET["o_pas"] != "") {
                $sql = 'delete from show."Owner" where "Owner_passport" = :owner_pas';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':owner_pas' => $_GET["o_pas"]));
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
    <form action="owner.php" method="post">
        <input name="owner_pas" size="30" placeholder="owner passport..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Owner_passport']?>"> - Паспорт</br>
        <input name="owner_name" size="30" placeholder="owner name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Owner_name']?>"> - Имя</br>
        <button type="submit" name="edit">Добавить/Редактировать</button>
    </form>
</div>
<div class="layer2" align="right">
    <form action="owner.php" method="post">
        <input name="owner_pas" size="40" placeholder="Passport number..." value="<?php echo '' ?>"></br>
        <button type="submit" name="find">Найти</button>
    </form>
    <?php echo $message ?>
</div>
<div class="container">
    <table class="table">
        <tbody>
        <tr>
            <th>Owner_passport</th>
            <th>Owner_name</th>
            <th>Delete</th>
         </tr>

        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) {
            $owner_pas = $value[0]['Owner_passport'];
            $owner_name = $value[0]['Owner_name'];
            echo "<tr>
                <td>$owner_pas</td>
                <td>$owner_name</td>
                <td><a href='?o_pas=$owner_pas'>Delete</a></td>
             </tr>";
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $new_value) {
            $owner_pas = $new_value[0]['Owner_passport'];
            $owner_name = $new_value[0]['Owner_name'];
            echo "<tr>
                <td>$owner_pas</td>
                <td>$owner_name</td>
                <td><a href='?o_pas=$owner_pas'>Delete</a></td>
             </tr>";
        } else {
            $sql = 'SELECT * from show."Owner"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $owner_pas = $data[$i]['Owner_passport'];
                $owner_name = $data[$i]['Owner_name'];
                echo "<tr>
                    <td>$owner_pas</td>
                    <td>$owner_name</td>
                    <td><a href='?o_pas=$owner_pas'>Delete</a></td>
                 </tr>";
            }
        }?>
        </tbody>
    </table>
</div>


</body>
</html>