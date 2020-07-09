<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Приемы</title>
</head>


<?php

$data = null;
$status = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dbuser = 'postgres';		$dbpassword = '756831';		$host = 'localhost';		$dbname = 'db_lab';

    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );

    if (isset($_POST["delete"])) {
        $sql = 'DELETE from lab3."Reception" where "id_reception" = :id_reception';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id_reception' => $_POST["id_reception"]));
        $data = $sth->fetchAll();
        if(count($data) > 0){
            $status = "Запись удалена";
        }
        else{
            $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
        }
    }
    if (isset($_POST["find"])) {
        $sql = 'SELECT * from lab3."Reception" where "id_reception" = :id_reception';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id_reception' => $_POST["id_reception"]));
        $data = $sth->fetchAll();
        print_r ($sth->errorInfo()[2]);
        if(count($data) > 0){
            $status = "Запись найдена";
        }
        else{
            $status = "Запись не найдена";
        }
    }
    if (isset($_POST["edit"])) {
        if($_POST["id_reception"] != ""){
            $sql = 'SELECT * from lab3."Reception" where "id_reception" = :id_reception';
            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_reception' => intval($_POST["id_reception"])));
            $data = $sth->fetchAll();
        }
        if($_POST["id_reception"] != "" && count($data) > 0){
            $sql = 'UPDATE lab3."Reception" SET "id_doctor" = :id_doctor, "id_patient" = :id_patient, "reception_date" = :reception_date, "reception_time" = :reception_time, "reception_price" = :reception_price where "id_reception" = :id_reception';
            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_reception' => $_POST["id_reception"],':id_patient' => $_POST["id_patient"], ':id_doctor' => $_POST["id_doctor"], ':reception_date' => $_POST["reception_date"],':reception_time' => $_POST["reception_time"], ':reception_price' => $_POST["reception_price"]));

            $data = $sth->fetchAll();
            print_r ($sth->errorInfo()[2]);
            $status = "Запись изменена";
            $data = null;

        }else{
            $status = "Упс, что-то пошло не так... введите id";
        }
    }
    if (isset($_POST["add"])){
        $sql = 'INSERT INTO lab3."Reception"("id_patient", "id_doctor", "reception_date", "reception_time", "reception_price") VALUES (:id_patient, :id_doctor, :reception_date, :reception_time, :reception_price)';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id_reception' => $_POST["id_reception"],':id_patient' => $_POST["id_patient"], ':id_doctor' => $_POST["id_doctor"], ':reception_date' => $_POST["reception_date"],':reception_time' => $_POST["reception_time"], ':reception_price' => $_POST["reception_price"]));
        $data = $sth->fetchAll();
        print_r ($sth->errorInfo()[2]);
        $status = "Запись добавлена";
        $data = null;
    }

}
?>



<body>
<form action="" method="post">
    <input name="id_reception" placeholder="id приема..." value="<?php echo '' ?>"></br>
    <button type="submit" name="find">Найти </button>
    <button type="submit" name="delete">Удалить</button>


</form>
<?php echo $status ?>
</br>
<form action="" method="post">
    <input name="id_reception" size="40" placeholder="id приема..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_reception']?>"> <-id приема</br>
    <input name="id_patient" size="40" placeholder="id пациента..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_patient']?>"> <-id пациента</br>
    <input name="id_doctor" size="40" placeholder="id доктора..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_doctor']?>"> <-id доктора</br>
    <input name="reception_date" size="40" placeholder="Дата приема..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['reception_date']?>"> <-Дата приема</br>
    <input name="reception_time" size="40" placeholder="Время приема..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['reception_time']?>"> <-Время приема</br>
    <input name="reception_price" size="40" placeholder="Цена приема..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['reception_price']?>"> <-Цена приема </br>
    <button type="submit" name="add">Добавить</button>
    <button type="submit" name="edit">Редактировать</button>
</form>
</body>
</html>