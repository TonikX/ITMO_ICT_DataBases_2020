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
                $sql = 'SELECT * from speciality where speciality_id = :speciality_id'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':speciality_id' => $_POST["speciality_id"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from speciality where speciality_id = :speciality_id';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':speciality_id' => $_POST["speciality_id"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["speciality_id"] != ""){
                    $sql = 'SELECT * from speciality where speciality_id = :speciality_id';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':speciality_id' => intval($_POST["speciality_id"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["speciality_id"] != "" && count($data) > 0){
                    $sql = 'UPDATE speciality SET faculty_id_fk= :faculty_id_fk, spciality_name = :spciality_name,
                    max_stud_amount = :max_stud_amount, min_grade = :min_grade
                    where speciality_id = :speciality_id';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':speciality_id' => $_POST["speciality_id"],
                    ':faculty_id_fk' => $_POST["faculty_id_fk"],
                    ':spciality_name' => $_POST["spciality_name"],
                    ':max_stud_amount' => $_POST["max_stud_amount"],
                    ':min_grade' => $_POST["min_grade"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO speciality(speciality_id, faculty_id_fk, spciality_name, max_stud_amount, min_grade)
                    VALUES
                    (:speciality_id, :faculty_id_fk, :spciality_name, :max_stud_amount, :min_grade)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':speciality_id' => $_POST["speciality_id"],
                    ':faculty_id_fk' => $_POST["faculty_id_fk"],
                    ':spciality_name' => $_POST["spciality_name"],
                    ':max_stud_amount' => $_POST["max_stud_amount"],
                    ':min_grade' => $_POST["min_grade"]
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
    <input name="speciality_id" placeholder="speciality_id..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:green" name="find">Найти</button>
    <button type="submit" style = "background-color:red" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="speciality_id" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['speciality_id']?>"> - id</br>
    <input name="faculty_id_fk" size="40" placeholder="faculty_id_fk..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['faculty_id_fk']?>"> - faculty_id_fk</br>
    <input name="spciality_name" size="40" placeholder="spciality_name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['spciality_name']?>"> - spciality_name</br>
    <input name="max_stud_amount" size="40" placeholder="max_stud_amount..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['max_stud_amount']?>"> - max_stud_amount </br>
    <input name="min_grade" size="40" placeholder="min_grade..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['min_grade']?>"> - min_grade </br>
    <button type="submit" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
