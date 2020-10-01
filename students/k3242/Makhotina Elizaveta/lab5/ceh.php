<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>plant</title>
</head>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

$dbName = "ptizefabrika";
$dbuser = "root";
$dbpass = "";

try{
$pdo = new PDO("mysql:host=localhost;dbname=$dbName", $dbuser, $dbpass);

if (isset($_POST["find"])) {
                $sql = 'SELECT * from plant where number_of_plant = :number_of_plant'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':number_of_plant' => $_POST["number_of_plant"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from plant where number_of_plant = :number_of_plant';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':number_of_plant' => $_POST["number_of_plant"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["number_of_plant"] != ""){
                    $sql = 'SELECT * from plant where number_of_plant = :number_of_plant';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':number_of_plant' => intval($_POST["number_of_plant"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["number_of_plant"] != "" && count($data) > 0){
                    $sql = 'UPDATE plant SET location= :location, id_director_fk = :id_director_fk
                    where number_of_plant = :number_of_plant';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':number_of_plant' => $_POST["number_of_plant"],
                    ':id_director_fk' => $_POST["id_director_fk"],
                    ':location' => $_POST["location"]

                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO plant(number_of_plant, location, id_director_fk)
                    VALUES
                    (:number_of_plant, :location, :id_director_fk)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':number_of_plant' => $_POST["number_of_plant"],
                    	':id_director_fk' => $_POST["id_director_fk"],
                    	':location' => $_POST["location"]
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
    <input name="number_of_plant" placeholder="number_of_plant..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:tan" name="find">Найти</button>
    <button type="submit" style = "background-color:tan" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="number_of_plant" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['number_of_plant']?>"> - id</br>
    <input name="location" size="40" placeholder="location..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['location']?>"> - location</br>
    <input name="id_director_fk" size="40" placeholder="director id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_director_fk']?>"> - id_director_fk</br>
    <button type="submit" style ='background-color:tan'name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
