<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Диагнозы</title>
</head>


<?php

$data = null;
$status = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dbuser = 'postgres';		$dbpassword = '756831';		$host = 'localhost';		$dbname = 'db_lab';

    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );

    if (isset($_POST["delete"])) {
        $sql = 'DELETE from lab3."Diagnosis" where "id_diagnosis" = :id_diagnosis';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id_diagnosis' => $_POST["id_diagnosis"]));
        $data = $sth->fetchAll();
        if(count($data) > 0){
            $status = "Запись удалена";
        }
        else{
            $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
        }
    }
    if (isset($_POST["find"])) {
        $sql = 'SELECT * from lab3."Diagnosis" where "id_diagnosis" = :id_diagnosis';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id_diagnosis' => $_POST["id_diagnosis"]));
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
        if($_POST["id_diagnosis"] != ""){
            $sql = 'SELECT * from lab3."Diagnosis" where "id_diagnosis" = :id_diagnosis';
            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_diagnosis' => intval($_POST["id_diagnosis"])));
            $data = $sth->fetchAll();
        }
        if($_POST["id_diagnosis"] != "" && count($data) > 0){
            $sql = 'UPDATE lab3."Diagnosis" SET "diagnosis_name" = :diagnosis_name, "diagnosis_descr" = :diagnosis_descr where "id_diagnosis" = :id_diagnosis';
            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_diagnosis' => $_POST["id_diagnosis"],':diagnosis_name' => $_POST["diagnosis_name"],':diagnosis_descr' => $_POST["diagnosis_descr"]));
            $data = $sth->fetchAll();
            print_r ($sth->errorInfo()[2]);
            $status = "Запись изменена";
            $data = null;

        }else{
            $status = "Упс, что-то пошло не так... введите id";
        }
    }
    if (isset($_POST["add"])){
        $sql = 'INSERT INTO lab3."Diagnosis"("diagnosis_name", "diagnosis_descr") VALUES (:diagnosis_name, :diagnosis_descr)';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':diagnosis_name' => $_POST["diagnosis_name"],':diagnosis_descr' => $_POST["diagnosis_descr"]));
        $data = $sth->fetchAll();
        print_r ($sth->errorInfo()[2]);
        $status = "Запись добавлена";
        $data = null;
    }

}
?>



<body>
<form action="" method="post">
    <input name="id_diagnosis" placeholder="id диагноза..." value="<?php echo '' ?>"></br>
    <button type="submit" name="find">Найти </button>
    <button type="submit" name="delete">Удалить</button>


</form>
<?php echo $status ?>
</br>
<form action="" method="post">
    <input name="id_diagnosis" size="40" placeholder="id диагноза..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_diagnosis']?>"> <-id диагноза</br>
    <input name="diagnosis_name" size="40" placeholder="Название..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['diagnosis_name']?>"> <-Название</br>
    <input name="diagnosis_descr" size="40" placeholder="Описание..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['diagnosis_descr']?>"> <-Описание </br>
    <button type="submit" name="add">Добавить</button>
    <button type="submit" name="edit">Редактировать</button>
</form>
</body>
</html>