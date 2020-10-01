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
                $sql = 'SELECT * from application where abiturient_id_fk = :abiturient_id_fk'; 
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
                $sql = 'delete from application where abiturient_id_fk = :abiturient_id_fk';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':abiturient_id_fk' => $_POST["abiturient_id_fk"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["abiturient_id_fk"] != ""){
                    $sql = 'SELECT * from application where abiturient_id_fk = :abiturient_id_fk';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':abiturient_id_fk' => intval($_POST["abiturient_id_fk"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["abiturient_id_fk"] != "" && count($data) > 0){
                    $sql = 'UPDATE application SET secretary_id_fk= :secretary_id_fk, application_date = :application_date
                    where abiturient_id_fk = :abiturient_id_fk';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':sabiturient_id_fk' => $_POST["abiturient_id_fk"],
                    ':secretary_id_fk' => $_POST["secretary_id_fk"],
                    ':application_date' => $_POST["application_date"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO application(abiturient_id_fk, secretary_id_fk, application_date)
                    VALUES
                    (:abiturient_id_fk, :secretary_id_fk, :application_date)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':abiturient_id_fk' => $_POST["abiturient_id_fk"],
                    ':secretary_id_fk' => $_POST["secretary_id_fk"],
                    ':application_date' => $_POST["application_date"]
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
    <input name="abiturient_id_fk" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['abiturient_id_fk']?>"> - id абитуриента</br>
    <input name="secretary_id_fk" size="40" placeholder="secretary_id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['secretary_id_fk']?>"> - secretary_id</br>
    <input name="application_date" size="40" placeholder="application_date..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['application_date']?>"> - application_date</br>
    <button type="submit" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
