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
                <a class="navbar-brand" style="margin-left: 46%" href="show.php">Show</a>
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
                $sql = 'SELECT * from show."Show" where "ID_show" = :id_show';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_show' => intval($_POST["id_show"])));
                $value = $sth->fetchAll();
                if(count($value) > 0){
                    $message = "Запись найдена";
                }else{
                    $message = "Запись не найдена";
                }
            }

            if (isset($_POST["edit"])) {
                $exist = false;
                if($_POST["id_show"] != ""){
                    $sql = 'SELECT * from show."Show" where "ID_show" = :id_show';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_show' => intval($_POST["id_show"])));
                    if (count($sth->fetchAll())>0){
                        $exist = true;
                    }
                }
                if ($exist) {
                    $sql = 'UPDATE show."Show" SET "ID_show"= :id_show, "Organisation_name"= :org_name,
                    "Show_name"= :show_name, "Location"= :location, "Date"= :date
                    where "Owner_passport" = :owner_pas';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_show' => $_POST["id_show"], ':org_name' => $_POST["org_name"],
                                        ':show_name' => $_POST["show_name"], ':location' => $_POST["location"],
                                        ':date' => $_POST["date"]));

                    $sql = 'SELECT * from show."Show" where "ID_show" = :id_show';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_show' => intval($_POST["id_show"])));
                    $new_value = $sth->fetchAll();
                    $message = "Запись изменена";
                    $value = null;
                } elseif($_POST["id_show"] != "") {
                    $sql = 'INSERT INTO show."Show"("ID_show", "Organisation_name", "Show_name", "Location", "Date")
                            VALUES (:id_show, :org_name, :show_name, :location, :date)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_show' => $_POST["id_show"], ':org_name' => $_POST["org_name"],
                                        ':show_name' => $_POST["show_name"], ':location' => $_POST["location"],
                                        ':date' => $_POST["date"]));

                    $sql = 'SELECT * from show."Show" where "ID_show" = :id_show';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_show' => intval($_POST["id_show"])));
                    $new_value = $sth->fetchAll();
                    $message = "Запись добавлена";
                    $value = null;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET["id_show"] != "") {
                $sql = 'delete from show."Show" where "ID_show" = :id_show';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_show' => $_GET["id_show"]));
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
    <form action="show.php" method="post">
        <input name="id_show" size="30" placeholder="id show..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['ID_show']?>"> - ID шоу</br>
        <input name="org_name" size="30" placeholder="organisation name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Organisation_name']?>"> - Спонсор</br>
        <input name="show_name" size="30" placeholder="show name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Show_name']?>"> - Название</br>
        <input name="location" size="30" placeholder="location..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Location']?>"> - Местоположение</br>
        <input name="date" size="30" placeholder="date..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Date']?>"> - Дата проведения</br>
        <button type="submit" name="edit">Добавить/Редактировать</button>
    </form>
</div>
<div class="layer2" align="right">
    <form action="show.php" method="post">
        <input name="id_show" size="40" placeholder="Id show..." value="<?php echo '' ?>"></br>
        <button type="submit" name="find">Найти</button>
    </form>
    <?php echo $message ?>
</div>
<div class="container">
    <table class="table">
        <tbody>
        <tr>
            <th>ID_show</th>
            <th>Organisation_name</th>
            <th>Show_name</th>
            <th>Location</th>
            <th>Date</th>
            <th>Delete</th>
         </tr>

        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) {
            $id_show = $value[0]['ID_show'];
            $org_name = $value[0]['Organisation_name'];
            $show_name = $value[0]['Show_name'];
            $location = $value[0]['Location'];
            $date = $value[0]['Date'];
            echo "<tr>
                <td>$id_show</td>
                <td>$org_name</td>
                <td>$show_name</td>
                <td>$location</td>
                <td>$date</td>
                <td><a href='?id_show=$id_show'>Delete</a></td>
             </tr>";
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $new_value) {
            $id_show = $new_value[0]['ID_show'];
            $org_name = $new_value[0]['Organisation_name'];
            $show_name = $new_value[0]['Show_name'];
            $location = $new_value[0]['Location'];
            $date = $new_value[0]['Date'];
            echo "<tr>
                <td>$id_show</td>
                <td>$org_name</td>
                <td>$show_name</td>
                <td>$location</td>
                <td>$date</td>
                <td><a href='?id_show=$id_show'>Delete</a></td>
             </tr>";
        } else {
            $sql = 'SELECT * from show."Show"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $id_show = $data[$i]['ID_show'];
                $org_name = $data[$i]['Organisation_name'];
                $show_name = $data[$i]['Show_name'];
                $location = $data[$i]['Location'];
                $date = $data[$i]['Date'];
                echo "<tr>
                    <td>$id_show</td>
                    <td>$org_name</td>
                    <td>$show_name</td>
                    <td>$location</td>
                    <td>$date</td>
                    <td><a href='?id_show=$id_show'>Delete</a></td>
                 </tr>";
            }
        }?>
        </tbody>
    </table>
</div>


</body>
</html>