<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Priem cost</title>
</head>


<?php

$data = null;
$status = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dbuser = 'postgres';		$dbpassword = 'XHUSF2rS';		$host = 'localhost';		$dbname = 'clinics';     
		
		$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );
			
			if (isset($_POST["delete"])) {
                $sql = 'DELETE from public."Priem_cost" where "id_priem" = :id_priem';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_priem' => $_POST["id_priem"]));
                $data = $sth->fetchAll();
				if(count($data) > 0){
                	$status = "Запись удалена";
				}
				else{
                $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
                }            
				}
           	if (isset($_POST["find"])) {
                $sql = 'SELECT * from public."Priem_cost" where "id_priem" = :id_priem';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_priem' => $_POST["id_priem"]));
                $data = $sth->fetchAll();
				print_r ($sth->errorInfo()[2]);
                if(count($data) > 0){
                	$status = "Запись найдена";
                }
				else{
                    $status = "Запись не найдена";
                }
           	}
		   	if (isset($_POST["edit"])) {
                if($_POST["id_priem"] != ""){
                   $sql = 'SELECT * from public."Priem_cost" where "id_priem" = :id_priem';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_priem' => intval($_POST["id_priem"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["id_priem"] != "" && count($data) > 0){
                    $sql = 'UPDATE public."Priem_cost" SET "cost" = :cost, "title" = :title, "description" = :description where "id_priem" = :id_priem';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_priem' => $_POST["id_priem"],':cost' => $_POST["cost"],':title' => $_POST["title"],':description' => $_POST["description"]));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменена";
                    $data = null;

                }else{
					$status = "Упс, что-то пошло не так... введите id";
					}
		   	}
				if (isset($_POST["add"])){
                    $sql = 'INSERT INTO public."Priem_cost"("cost", "title", "description") VALUES (:cost, :title, :description)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':cost' => $_POST["cost"],':title' => $_POST["title"],':description' => $_POST["description"]));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись добавлена";
                    $data = null;
                }
			
}
?>



<body>
<form action="" method="post">
    <input name="id_priem" placeholder="id..." value="<?php echo '' ?>"></br>
    <button type="submit" name="find">Найти </button>
	<button type="submit" name="delete">Удалить</button>


</form>
<?php echo $status ?>
</br>
<form action="" method="post">
    <input name="id_priem" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_priem']?>"> <-id</br>
    <input name="cost" size="40" placeholder="Стоимость..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['cost']?>"> <-Стоимость</br>
    <input name="title" size="40" placeholder="Название..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['title']?>"> <-Название</br>
    <input name="description" size="40" placeholder="Описание..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['description']?>"> <-Описание </br>
    <button type="submit" name="add">Добавить</button>
	<button type="submit" name="edit">Редактировать</button>
</form>
</body>
</html>




 

