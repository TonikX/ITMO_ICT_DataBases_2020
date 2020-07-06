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
                $sql = 'SELECT * from chicken where  id_of_chicken = :id_of_chicken'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_of_chicken' => $_POST["id_of_chicken"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    $status = "Запись найдена";
                }else{
                    $status = "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from chicken where id_of_chicken = :id_of_chicken';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_of_chicken' => $_POST["id_of_chicken"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["id_of_chicken"] != ""){
                    $sql = 'SELECT * from chicken where id_of_chicken = :id_of_chicken';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_of_chicken' => intval($_POST["id_of_chicken"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["id_of_chicken"] != "" && count($data) > 0){
                    $sql = 'UPDATE chicken SET  id_of_chicken = :id_of_chicken, 
                    weight = :weight,
                    id_breed_fk = :id_breed_fk, 
                    age = :age, 
                    num_of_eggs = :num_of_eggs, 
                    id_cage_fk = :id_cage_fk
                    where id_of_chicken = :id_of_chicken';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':id_of_chicken' => $_POST["id_of_chicken"],
                    ':weight' => $_POST["weight"],
                    ':id_breed_fk' => $_POST["id_breed_fk"],
                    ':age' => $_POST["age"],
                    ':num_of_eggs' => $_POST["num_of_eggs"],
                    ':id_cage_fk' => $_POST["id_cage_fk"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO chicken(id_of_chicken, weight, id_breed_fk, age, num_of_eggs, id_cage_fk)
                    VALUES
                    (:id_of_chicken, :weight, :id_breed_fk, :age, :num_of_eggs, :id_cage_fk)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_of_chicken' => $_POST["id_of_chicken"],
                    ':weight' => $_POST["weight"],
                    ':id_breed_fk' => $_POST["id_breed_fk"],
                    ':age' => $_POST["age"],
                    ':num_of_eggs' => $_POST["num_of_eggs"],
                    ':id_cage_fk' => $_POST["id_cage_fk"]
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
    <input name="id_of_chicken" placeholder="id..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:tan" name="find">Найти</button>
    <button type="submit" style = "background-color:tan" name="delete">Удалить</button>
</form>
<?php echo $status ?>
<p></p>
<form action="" method="post">
    <input name="id_of_chicken" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_of_chicken']?>"> - id</br>
    <input name="weight" size="40" placeholder="weight..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['weight']?>"> - weight</br>
    <input name="id_breed_fk" size="40" placeholder="id_breed_fk..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_breed_fk']?>"> - id_breed_fk</br>
    <input name="age" size="40" placeholder="age..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['age']?>"> - age</br>
    <input name="num_of_eggs" size="40" placeholder="num_of_eggs..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['num_of_eggs']?>"> - num_of_eggs</br>
    <input name="id_cage_fk" size="40" placeholder="id_cage_fk..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_cage_fk']?>"> - id_cage_fk</br>
    
    <button type="submit" style = "background-color:tan" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
