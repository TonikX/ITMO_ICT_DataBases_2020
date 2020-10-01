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
                $sql = 'SELECT * from 9_grade_certificat where  abiturient_id_fk = :abiturient_id_fk'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':abiturient_id_fk' => $_POST["abiturient_id_fk"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from 9_grade_certificat where abiturient_id_fk = :abiturient_id_fk';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':abiturient_id_fk' => $_POST["abiturient_id_fk"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["abiturient_id_fk"] != ""){
                    $sql = 'SELECT * from 9_grade_certificat where abiturient_id_fk = :abiturient_id_fk';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':abiturient_id_fk' => intval($_POST["abiturient_id_fk"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["abiturient_id_fk"] != "" && count($data) > 0){
                    $sql = 'UPDATE 9_grade_certificat SET  abiturient_id_fk = :abiturient_id_fk, prof_discipline_1 = :prof_discipline_1, prof_discipline_2 = :prof_discipline_2, prof_discipline_3 = :prof_discipline_3, prof_discipline_4 = :prof_discipline_4, average_grade = :average_grade
                    where abiturient_id_fk = :abiturient_id_fk';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':abiturient_id_fk' => $_POST["abiturient_id_fk"],
                    ':prof_discipline_1' => $_POST["prof_discipline_1"],
                    ':prof_discipline_2' => $_POST["prof_discipline_2"],
                    ':prof_discipline_3' => $_POST["prof_discipline_3"],
                    ':prof_discipline_4' => $_POST["prof_discipline_4"],
                    ':average_grade' => $_POST["average_grade"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO 9_grade_certificat(abiturient_id_fk, prof_discipline_1, prof_discipline_2, prof_discipline_3, prof_discipline_4, average_grade)
                    VALUES
                    (:abiturient_id_fk, :prof_discipline_1, :prof_discipline_2, :prof_discipline_3, :prof_discipline_4, :average_grade)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':abiturient_id_fk' => $_POST["abiturient_id_fk"],
                    ':prof_discipline_1' => $_POST["prof_discipline_1"],
                    ':prof_discipline_2' => $_POST["prof_discipline_2"],
                    ':prof_discipline_3' => $_POST["prof_discipline_3"],
                    ':prof_discipline_4' => $_POST["prof_discipline_4"],
                    ':average_grade' => $_POST["average_grade"]
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
    <input name="abiturient_id_fk" placeholder="abiturient_id..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:green" name="find">Найти</button>
    <button type="submit" style = "background-color:red" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="abiturient_id_fk" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['abiturient_id_fk']?>"> - id</br>
    <input name="prof_discipline_1" size="40" placeholder="prof_discipline_1..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['prof_discipline_1']?>"> - prof_discipline_1</br>
    <input name="prof_discipline_2" size="40" placeholder="prof_discipline_2..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['prof_discipline_2']?>"> - prof_discipline_2</br>
    <input name="prof_discipline_3" size="40" placeholder="prof_discipline_3..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['prof_discipline_3']?>"> - prof_discipline_3</br>
    <input name="prof_discipline_4" size="40" placeholder="prof_discipline_4..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['prof_discipline_4']?>"> - prof_discipline_4</br>
    <input name="average_grade" size="40" placeholder="average_grade..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['average_grade']?>"> - average_grade4</br>
    
    <button type="submit" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
