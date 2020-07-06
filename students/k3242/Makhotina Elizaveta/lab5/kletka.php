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
                $sql = 'SELECT * from cage where id_of_cage = :id_of_cage'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_of_cage' => $_POST["id_of_cage"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from cage where id_of_cage = :id_of_cage';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_of_cage' => $_POST["id_of_cage"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["id_of_cage"] != ""){
                    $sql = 'SELECT * from cage where id_of_cage = :id_of_cage';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_of_cage' => intval($_POST["id_of_cage"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["id_of_cage"] != "" && count($data) > 0){
                    $sql = 'UPDATE cage SET row_of_cage = :row_of_cage, number_of_cage = :number_of_cage,
                    capacity = :capacity, 
                    number_of_plant_fk = :number_of_plant_fk

                    where id_of_cage = :id_of_cage';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':id_of_cage' => $_POST["id_of_cage"],
                    ':row_of_cage' => $_POST["row_of_cage"],
                    ':number_of_cage' => $_POST["number_of_cage"],
                    ':capacity' => $_POST["capacity"],
                    ':number_of_plant_fk' => $_POST["number_of_plant_fk"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO cage(id_of_cage, row_of_cage, number_of_cage, capacity, number_of_plant_fk)
                    VALUES
                    (:id_of_cage, :row_of_cage, :number_of_cage, :capacity, :number_of_plant_fk)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_of_cage' => $_POST["id_of_cage"],
                    ':row_of_cage' => $_POST["row_of_cage"],
                    ':number_of_cage' => $_POST["number_of_cage"],
                    ':capacity' => $_POST["capacity"],
                    ':number_of_plant_fk' => $_POST["number_of_plant_fk"]
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
    <input name="id_of_cage" placeholder="id_of_cage..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:tan" name="find">Найти</button>
    <button type="submit" style = "background-color:tan" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="id_of_cage" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_of_cage']?>"> - id</br>
    <input name="row_of_cage" size="40" placeholder="row_of_cage..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['row_of_cage']?>"> - row_of_cage</br>
    <input name="number_of_cage" size="40" placeholder="number_of_cage..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['number_of_cage']?>"> - number_of_cage </br>
    <input name="capacity" size="40" placeholder="capacity..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['capacity']?>"> - capacity</br>
    <input name="number_of_plant_fk" size="40" placeholder="number_of_plant_fk..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['number_of_plant_fk']?>"> - number_of_plant_fk</br>   
    <button type="submit" style = "background-color:tan" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
