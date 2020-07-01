<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical records</title>
</head>


<?php

$data = null;
$status = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dbuser = 'postgres';		$dbpassword = 'XHUSF2rS';		$host = 'localhost';		$dbname = 'clinics';     
		
		$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );
			
			if (isset($_POST["delete"])) {
                $sql = 'DELETE from public."Medical_records" where "id_patient" = :id_patient';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_patient' => $_POST["id_patient"]));
                $data = $sth->fetchAll();
				if(count($data) > 0){
                	$status = "Запись удалена";
				}
				else{
                $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
                }            
				}
           	if (isset($_POST["find"])) {
                $sql = 'SELECT * from public."Medical_records" where "id_patient" = :id_patient';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_patient' => $_POST["id_patient"]));
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
                if($_POST["id_patient"] != ""){
                   $sql = 'SELECT * from public."Medical_records" where "id_patient" = :id_patient';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_patient' => intval($_POST["id_patient"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["id_patient"] != "" && count($data) > 0){
                    $sql = 'UPDATE public."Medical_records" SET "contacts" = :contacts, "birthday" = :birthday, "full_name" = :full_name where "id_patient" = :id_patient';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_patient' => $_POST["id_patient"],':contacts' => $_POST["contacts"],':birthday' => $_POST["birthday"],':full_name' => $_POST["full_name"]));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменена";
                    $data = null;

                }else{
					$status = "Упс, что-то пошло не так... введите id";
					}
		   	}
				if (isset($_POST["add"])){
                    $sql = 'INSERT INTO public."Medical_records"("contacts", "birthday", "full_name") VALUES (:contacts, :birthday, :full_name)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':contacts' => $_POST["contacts"],':birthday' => $_POST["birthday"],':full_name' => $_POST["full_name"]));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись добавлена";
                    $data = null;
                }
			
}
?>



<body>
<form action="" method="post">
    <input name="id_patient" placeholder="id..." value="<?php echo '' ?>"></br>
    <button type="submit" name="find">Найти </button>
	<button type="submit" name="delete">Удалить</button>


</form>
<?php echo $status ?>
</br>
<form action="" method="post">
    <input name="id_patient" size="40" placeholder="id..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_patient']?>"> <-id</br>
    <input name="contacts" size="40" placeholder="Контакты..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['contacts']?>"> <-Контакты</br>
    <input name="birthday" size="40" placeholder="Дата рождения..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['birthday']?>"> <-Дата рождения</br>
    <input name="full_name" size="40" placeholder="ФИО..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['full_name']?>"> <-ФИО </br>
    <button type="submit" name="add">Добавить</button>
	<button type="submit" name="edit">Редактировать</button>
</form>
</body>
</html>




 

