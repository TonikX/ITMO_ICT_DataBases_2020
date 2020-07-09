<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sec</title>
</head>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

$dbName = "ptizefabrika";
$dbuser = "root";
$dbpass = "";

try{
$pdo = new PDO("mysql:host=localhost;dbname=$dbName", $dbuser, $dbpass);

if (isset($_POST["find"])) {
                $sql = 'SELECT * from breed where id_of_breed = :id_of_breed'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_of_breed' => $_POST["id_of_breed"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from breed where id_of_breed = :id_of_breed';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_of_breed' => $_POST["id_of_breed"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["id_of_breed"] != ""){
                    $sql = 'SELECT * from breed where id_of_breed = :id_of_breed';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_of_breed' => intval($_POST["id_of_breed"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["id_of_breed"] != "" && count($data) > 0){
                    $sql = 'UPDATE breed SET capacity= :capacity, name_of_breed = :name_of_breed, diet = :diet,
                    average_weight = :average_weight
                    where id_of_breed = :id_of_breed';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':name_of_breed' => $_POST["name_of_breed"],
                    ':capacity' => $_POST["capacity"],
                    ':average_weight' => $_POST["average_weight"],
                    ':diet' => $_POST["diet"],
                    ':id_of_breed' => $_POST["id_of_breed"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO breed(name_of_breed, capacity, average_weight, id_of_breed, diet)
                    VALUES
                    (:name_of_breed, :capacity, :average_weight, :id_of_breed, :diet)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':name_of_breed' => $_POST["name_of_breed"],
                    ':capacity' => $_POST["capacity"],
                    ':average_weight' => $_POST["average_weight"],
                    ':diet' => $_POST["diet"],
                    ':id_of_breed' => $_POST["id_of_breed"]
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
    <input name="id_of_breed" placeholder="id..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:tan" name="find">Найти</button>
    <button type="submit" style = "background-color:tan" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="name_of_breed" size="40" placeholder="name of breed" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['name_of_breed']?>"> - name_of_breedd</br>
    <input name="capacity" size="40" placeholder="capacity..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['capacity']?>"> - capacity</br>
    <input name="average_weight" size="40" placeholder="average_weight..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['average_weight']?>"> - average_weight</br>
    <input name="diet" size="40" placeholder="diet..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['diet']?>"> - diet</br>
    <input name="id_of_breed" size="40" placeholder="id_of_breed..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_of_breed']?>"> - id_of_breed</br>
    <button type="submit" style = "background-color:tan" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
