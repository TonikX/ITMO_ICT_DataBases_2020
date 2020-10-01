<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sec</title>
</head>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

$dbName = "university";
$dbuser = "sergey";
$dbpass = "2058";

try{
$pdo = new PDO("mysql:host=localhost;dbname=$dbName", $dbuser, $dbpass);

if (isset($_POST["find"])) {
                $sql = 'SELECT * from abiturient where abiturient_id = :abiturient_id'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':abiturient_id' => $_POST["abiturient_id"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from abiturient where abiturient_id = :abiturient_id';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':abiturient_id' => $_POST["abiturient_id"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["abiturient_id"] != ""){
                    $sql = 'SELECT * from abiturient where abiturient_id = :abiturient_id';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':abiturient_id' => intval($_POST["abiturient_id"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["abiturient_id"] != "" && count($data) > 0){
                    $sql = 'UPDATE abiturient SET fio= :fio, birthday = :birthday,
                    faculty_id_fk = :faculty_id_fk, 
                    speciality_id_fk = :speciality_id_fk, 
                    school_num_fk = :school_num_fk,
                    passport_info = :passport_info,
                    gold_medal = :gold_medal,
                    silver_medal = :silver_medal,
                    form_of_studying = :form_of_studying,
                    graduation_date = :graduation_date,
                    organisation = :organisation
                    where abiturient_id = :abiturient_id';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':abiturient_id' => $_POST["abiturient_id"],
                    ':fio' => $_POST["fio"],
                    ':birthday' => $_POST["birthday"],
                    ':faculty_id_fk' => $_POST["faculty_id_fk"],
                    ':speciality_id_fk' => $_POST["speciality_id_fk"],
                    ':school_num_fk' => $_POST["school_num_fk"],
                    ':passport_info' => $_POST["passport_info"],
                    ':gold_medal' => $_POST["gold_medal"],
                    ':silver_medal' => $_POST["silver_medal"],
                    ':form_of_studying' => $_POST["form_of_studying"],
                    ':graduation_date' => $_POST["graduation_date"],
                    ':organisation' => $_POST["organisation"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO abiturient(abiturient_id, fio, birthday, faculty_id_fk, speciality_id_fk, school_num_fk, passport_info, gold_medal, silver_medal, form_of_studying, graduation_date, organisation)
                    VALUES
                    (:abiturient_id, :fio, :birthday, :faculty_id_fk, :speciality_id_fk, :school_num_fk, :passport_info, :gold_medal, :silver_medal, :form_of_studying, :graduation_date, :organisation)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':abiturient_id' => $_POST["abiturient_id"],
                    ':fio' => $_POST["fio"],
                    ':birthday' => $_POST["birthday"],
                    ':faculty_id_fk' => $_POST["faculty_id_fk"],
                    ':speciality_id_fk' => $_POST["speciality_id_fk"],
                    ':school_num_fk' => $_POST["school_num_fk"],
                    ':passport_info' => $_POST["passport_info"],
                    ':gold_medal' => $_POST["gold_medal"],
                    ':silver_medal' => $_POST["silver_medal"],
                    ':form_of_studying' => $_POST["form_of_studying"],
                    ':graduation_date' => $_POST["graduation_date"],
                    ':organisation' => $_POST["organisation"]
                                        ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись добавлена";
                    $data = null;
                }
}
}
catch(PDOException $e) {
	echo $e->getMessage();
}
}

?>

<body>
	<b>Введите ID записи, с которой хотите работать</b>
<form action="" method="post">
    <input name="abiturient_id" placeholder="abiturient_id..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:green" name="find">Найти</button>
    <button type="submit" style = "background-color:red" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="abiturient_id" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['abiturient_id']?>"> - id</br>
    <input name="fio" size="40" placeholder="FIO..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['fio']?>"> - FIO</br>
    <input name="birthday" size="40" placeholder="birthday..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['birthday']?>"> - birthday </br>
    <input name="faculty_id_fk" size="40" placeholder="faculty_id_fk..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['faculty_id_fk']?>"> - faculty_id_fk</br>
    <input name="speciality_id_fk" size="40" placeholder="speciality_id_fk..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['speciality_id_fk']?>"> - speciality_id_fk</br>
    <input name="school_num_fk" size="40" placeholder="school_num_fk..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['school_num_fk']?>"> - school_num_fk </br>

    <input name="passport_info" size="40" placeholder="passport_info..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['passport_info']?>"> - passport_info </br>
    <input name="gold_medal" size="40" placeholder="gold_medal..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['gold_medal']?>"> - gold_medal</br>
    <input name="silver_medal" size="40" placeholder="silver_medal..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['silver_medal']?>"> - silver_medal</br>
    <input name="form_of_studying" size="40" placeholder="form_of_studying..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['form_of_studying']?>"> - form_of_studying </br>

    <input name="graduation_date" size="40" placeholder="graduation_date..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['graduation_date']?>"> - graduation_date</br>
    <input name="organisation" size="40" placeholder="organisation..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['organisation']?>"> - organisation </br>
    <button type="submit" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
