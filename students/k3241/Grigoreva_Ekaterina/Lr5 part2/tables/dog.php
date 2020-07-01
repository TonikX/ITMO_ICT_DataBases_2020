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
                <a class="navbar-brand" style="margin-left: 46%" href="dog.php">Dog</a>
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

    $message = "";
    try {
        $dbuser = 'postgres';
        $dbpass = '89214483826';
        $host = 'localhost';
        $dbname= 'Dog_show';

        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $value = null;
            $new_value = null;

            if (isset($_POST["find"])) {
                $sql = 'SELECT * from show."Dog_participant" where "Dog_document_number" = :dog_doc';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':dog_doc' => intval($_POST["dog_doc"])));
                $value = $sth->fetchAll();
                if(count($value) > 0){
                    $message = "Запись найдена";
                }else{
                    $message = "Запись не найдена";
                }
            }

            if (isset($_POST["edit"])) {
                $exist = false;
                if($_POST["dog_doc"] != ""){
                    $sql = 'SELECT * from show."Dog_participant" where "Dog_document_number" = :dog_doc';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dog_doc' => intval($_POST["dog_doc"])));
                    if (count($sth->fetchAll())>0){
                        $exist = true;
                    }
                }
                if ($exist) {
                    $sql = 'UPDATE show."Dog_participant" SET "Dog_document_number"= :dog_doc, "Breed_name"= :breed_name,
                    "Dog_name"= :dog_name, "Dog_age"= :dog_age, "Club"= :club, "Classiness"= :class,
                    "Mother_name"= :m_name, "Father_name"= :f_name, "Last_vaccination_date"= :vac_date,
                    "Participation_payment"= :payment, "Owner_passport"= :owner_pas
                    where "Dog_document_number" = :dog_doc';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dog_doc' => $_POST["dog_doc"],
                                        ':breed_name' => $_POST["breed_name"],
                                        ':dog_name' => $_POST["dog_name"],
                                        ':dog_age' => $_POST["dog_age"],
                                        ':club' => $_POST["club"],
                                        ':class' => $_POST["class"],
                                        ':m_name' => $_POST["m_name"],
                                        ':f_name' => $_POST["f_name"],
                                        ':vac_date' => $_POST["vac_date"],
                                        ':payment' => $_POST["payment"],
                                        ':owner_pas' => $_POST["owner_pas"]));
                    $sql = 'SELECT * from show."Arena" where "Arena_number" = :arena_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dog_doc' => $_POST["dog_doc"],
                                        ':breed_name' => $_POST["breed_name"],
                                        ':dog_name' => $_POST["dog_name"],
                                        ':dog_age' => $_POST["dog_age"],
                                        ':club' => $_POST["club"],
                                        ':class' => $_POST["class"],
                                        ':m_name' => $_POST["m_name"],
                                        ':f_name' => $_POST["f_name"],
                                        ':vac_date' => $_POST["vac_date"],
                                        ':payment' => $_POST["payment"],
                                        ':owner_pas' => $_POST["owner_pas"]));
                    $new_value = $sth->fetchAll();
                    $message = "Запись изменена";
                    $value = null;
                } elseif($_POST["dog_doc"] != "") {
                    $sql = 'INSERT INTO show."Dog_participant"("Dog_document_number", "Breed_name", "Dog_name", "Dog_age",
                            "Club", "Classiness", "Mother_name", "Father_name", "Last_vaccination_date",
                            "Participation_payment", "Owner_passport")
                            VALUES (:dog_doc, :breed_name, :dog_name, :dog_age, :club, :class, :m_name, :f_name,
                            :vac_date, :payment, :owner_pas)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dog_doc' => $_POST["dog_doc"],
                                        ':breed_name' => $_POST["breed_name"],
                                        ':dog_name' => $_POST["dog_name"],
                                        ':dog_age' => $_POST["dog_age"],
                                        ':club' => $_POST["club"],
                                        ':class' => $_POST["class"],
                                        ':m_name' => $_POST["m_name"],
                                        ':f_name' => $_POST["f_name"],
                                        ':vac_date' => $_POST["vac_date"],
                                        ':payment' => $_POST["payment"],
                                        ':owner_pas' => $_POST["owner_pas"]));
                    $sql = 'SELECT * from show."Arena" where "Arena_number" = :arena_num';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':dog_doc' => $_POST["dog_doc"],
                                        ':breed_name' => $_POST["breed_name"],
                                        ':dog_name' => $_POST["dog_name"],
                                        ':dog_age' => $_POST["dog_age"],
                                        ':club' => $_POST["club"],
                                        ':class' => $_POST["class"],
                                        ':m_name' => $_POST["m_name"],
                                        ':f_name' => $_POST["f_name"],
                                        ':vac_date' => $_POST["vac_date"],
                                        ':payment' => $_POST["payment"],
                                        ':owner_pas' => $_POST["owner_pas"]));
                    $new_value = $sth->fetchAll();
                    $message = "Запись добавлена";
                    $value = null;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET["d_doc"] != "") {
                $sql = 'delete from show."Dog_participant" where "Dog_document_number" = :dog_doc';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':dog_doc' => $_GET["d_doc"]));
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
    <form action="dog.php" method="post">
        <input name="dog_doc" size="30" placeholder="dog document number..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Dog_document_number']?>"> - Номер документа собаки</br>
        <input name="breed_name" size="30" placeholder="breed name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Breed_name']?>"> - Парода</br>
        <input name="dog_name" size="30" placeholder="dog name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Dog_name']?>"> - Кличка</br>
        <input name="dog_age" size="30" placeholder="dog age..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Dog_age']?>"> - Возраст</br>
        <input name="club" size="30" placeholder="club..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Club']?>"> - Клуб</br>
        <input name="class" size="30" placeholder="classiness..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Classiness']?>"> - Классность</br>
        <input name="m_name" size="30" placeholder="mother's name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Mother_name']?>"> - Имя матери</br>
        <input name="f_name" size="30" placeholder="father's name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Father_name']?>"> - Имя отца</br>
        <input name="vac_date" size="30" placeholder="last vaccination date..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Last_vaccination_date']?>"> - Дата последней прививки</br>
        <input name="payment" size="30" placeholder="payment..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Participation_payment']?>"> - Оплата</br>
        <input name="owner_pas" size="30" placeholder="owner passport number..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) echo $value[0]['Owner_passport']?>"> - Паспорт хозяина</br>
        <button type="submit" name="edit">Добавить/Редактировать</button>
    </form>
</div>
<div class="layer2" align="right">
    <form action="dog.php" method="post">
        <input name="dog_doc" size="40" placeholder="Dog document number..." value="<?php echo '' ?>"></br>
        <button type="submit" name="find">Найти</button>
    </form>
    <?php echo $message ?>
</div>
<div>
    <table class="table" style="margin: 0px">
        <tbody>
        <tr>
            <th>Dog_document_number</th>
            <th>Breed_name</th>
            <th>Dog_name</th>
            <th>Dog_age</th>
            <th>Club</th>
            <th>Classiness</th>
            <th>Mother_name</th>
            <th>Father_name</th>
            <th>Last_vaccination_date</th>
            <th>Participation_payment</th>
            <th>Owner_passport</th>
            <th>Delete</th>
         </tr>

        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $value) {
                $dog_num = $value[0]['Dog_document_number'];
                $breed_name = $value[0]['Breed_name'];
                $dog_name = $value[0]['Dog_name'];
                $dog_age = $value[0]['Dog_age'];
                $club = $value[0]['Club'];
                $class = $value[0]['Classiness'];
                $m_name = $value[0]['Mother_name'];
                $f_name = $value[0]['Father_name'];
                $vac_date = $value[0]['Last_vaccination_date'];
                $payment = $value[0]['Participation_payment'];
                $owner_pas = $value[0]['Owner_passport'];
            echo "<tr>
                    <td>$dog_num</td>
                    <td>$breed_name</td>
                    <td>$dog_name</td>
                    <td>$dog_age</td>
                    <td>$club</td>
                    <td>$class</td>
                    <td>$m_name</td>
                    <td>$f_name</td>
                    <td>$vac_date</td>
                    <td>$payment</td>
                    <td>$owner_pas</td>
                    <td><a href='?d_doc=$dog_num'>Delete</a></td>
             </tr>";
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $new_value) {
                $dog_num = $new_value[0]['Dog_document_number'];
                $breed_name = $new_value[0]['Breed_name'];
                $dog_name = $new_value[0]['Dog_name'];
                $dog_age = $new_value[0]['Dog_age'];
                $club = $new_value[0]['Club'];
                $class = $new_value[0]['Classiness'];
                $m_name = $new_value[0]['Mother_name'];
                $f_name = $new_value[0]['Father_name'];
                $vac_date = $new_value[0]['Last_vaccination_date'];
                $payment = $new_value[0]['Participation_payment'];
                $owner_pas = $new_value[0]['Owner_passport'];
            echo "<tr>
                    <td>$dog_num</td>
                    <td>$breed_name</td>
                    <td>$dog_name</td>
                    <td>$dog_age</td>
                    <td>$club</td>
                    <td>$class</td>
                    <td>$m_name</td>
                    <td>$f_name</td>
                    <td>$vac_date</td>
                    <td>$payment</td>
                    <td>$owner_pas</td>
                    <td><a href='?d_doc=$dog_num'>Delete</a></td>
             </tr>";
        } else {
            $sql = 'SELECT * from show."Dog_participant"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $dog_num = $data[$i]['Dog_document_number'];
                $breed_name = $data[$i]['Breed_name'];
                $dog_name = $data[$i]['Dog_name'];
                $dog_age = $data[$i]['Dog_age'];
                $club = $data[$i]['Club'];
                $class = $data[$i]['Classiness'];
                $m_name = $data[$i]['Mother_name'];
                $f_name = $data[$i]['Father_name'];
                $vac_date = $data[$i]['Last_vaccination_date'];
                $payment = $data[$i]['Participation_payment'];
                $owner_pas = $data[$i]['Owner_passport'];
                echo "<tr>
                    <td>$dog_num</td>
                    <td>$breed_name</td>
                    <td>$dog_name</td>
                    <td>$dog_age</td>
                    <td>$club</td>
                    <td>$class</td>
                    <td>$m_name</td>
                    <td>$f_name</td>
                    <td>$vac_date</td>
                    <td>$payment</td>
                    <td>$owner_pas</td>
                    <td><a href='?d_doc=$dog_num'>Delete</a></td>
                 </tr>";
            }
        }?>
        </tbody>
    </table>
</div>


</body>
</html>