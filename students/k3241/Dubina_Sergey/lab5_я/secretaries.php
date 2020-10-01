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
                $sql = 'SELECT * from secretary where secretary_id = :secretary_id'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':secretary_id' => $_POST["secretary_id"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from secretary where secretary_id = :secretary_id';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':secretary_id' => $_POST["secretary_id"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["secretary_id"] != ""){
                    $sql = 'SELECT * from secretary where secretary_id = :secretary_id';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':secretary_id' => intval($_POST["secretary_id"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["secretary_id"] != "" && count($data) > 0){
                    $sql = 'UPDATE secretary SET secretary_contacts= :secretary_contacts, fio = :fio,
                    work_experience = :work_experience
                    where secretary_id = :secretary_id';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':secretary_id' => $_POST["secretary_id"],
                    ':secretary_contacts' => $_POST["secretary_contacts"],
                    ':fio' => $_POST["fio"],
                    ':work_experience' => $_POST["work_experience"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO secretary(secretary_id, secretary_contacts, fio, work_experience)
                    VALUES
                    (:secretary_id, :secretary_contacts, :fio, :work_experience)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':secretary_id' => $_POST["secretary_id"],
                    ':secretary_contacts' => $_POST["secretary_contacts"],
                    ':fio' => $_POST["fio"],
                    ':work_experience' => $_POST["work_experience"]
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
    <input name="secretary_id" placeholder="secretary_id..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:green" name="find">Найти</button>
    <button type="submit" style = "background-color:red" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="secretary_id" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['secretary_id']?>"> - id</br>
    <input name="secretary_contacts" size="40" placeholder="Contacts..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['secretary_contacts']?>"> - Contacts</br>
    <input name="fio" size="40" placeholder="FIO..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['fio']?>"> - FIO</br>
    <input name="work_experience" size="40" placeholder="Work experience..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['work_experience']?>"> - Work experience </br>
    <button type="submit" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
