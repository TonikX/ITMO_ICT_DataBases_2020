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
                $sql = 'SELECT * from director where id_director = :id_director'; 
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_director' => $_POST["id_director"]));
                $data = $sth->fetchAll();
                    if(count($data) > 0){
                    echo "Запись найдена";
                }else{
                    echo "Запись не найдена. Введите новые данные в форму ниже, если хотите создать запись с таким ID";
                }
}

if (isset($_POST["delete"])) {
                $sql = 'delete from director where id_director = :id_director';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_director' => $_POST["id_director"]));
                $data = $sth->fetchAll();
                print_r ($sth->errorInfo()[2]);
                $status = "Запись удалена";
                $data = null;
            }

            if (isset($_POST["edit"])) {
                if($_POST["id_director"] != ""){
                    $sql = 'SELECT * from director where id_director = :id_director';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_director' => intval($_POST["id_director"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["id_director"] != "" && count($data) > 0){
                    $sql = 'UPDATE director SET name_of_dir= :name_of_dir, experience = :experience
                    where id_director = :id_director';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(
                    ':name_of_dir' => $_POST["name_of_dir"],
                    ':experience' => $_POST["experience"]
                    ));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменина";
                    $data = null;

                } else{
                    $sql = 'INSERT INTO director(id_director, name_of_dir, experience)
                    VALUES
                    (:id_director, :name_of_dir, :experience)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_director' => $_POST["id_director"],
                    ':name_of_dir' => $_POST["name_of_dir"],
                    ':experience' => $_POST["experience"]
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
    <input name="id_director" placeholder="ID директора..." value="<?php echo '' ?>">
    <button type="submit" style = "background-color:tan" name="find">Найти</button>
    <button type="submit" style = "background-color:tan" name="delete">Удалить</button>
</form>
<p></p>
<form action="" method="post">
    <input name="id_director" size="40" placeholder="ID директора..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_director']?>"> - ID директора</br>
    <input name="name_of_dir" size="40" placeholder="фио_директора..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['name_of_dir']?>"> - фио_директора</br>
    <input name="experience" size="40" placeholder="стаж работы..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['experience']?>"> - стаж работы</br>
    <button type="submit" style = "background-color:tan" name="edit">Редактировать/Добавить</button>
</form>
<a href="index.html">Главная</a>
</body>
</html>
