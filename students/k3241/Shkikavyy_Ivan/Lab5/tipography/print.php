<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Печать</title>
</head>
<?php
$data = null;
$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$dbuser = 'postgres';
    $dbpassword = '1234';
    $host = 'localhost';
    $dbname = 'lab3';
	 $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );
    if(isset($_POST["find"])) {
        $sql = 'SELECT * from public."Print" where "ID_Print" = :ID_Print';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Print' => $_POST["ID_Print"]));
        $data = $sth->fetchAll();
        if(count($data) > 0){
            $status = "Результат:";
        }else{
            $status = "Информации нет.";
        }
    }
	elseif(isset($_POST["edit"])) {
		if($_POST["ID_Print"] != ""){
			$sql = 'SELECT * from public."Print" where "ID_Print" = :ID_Print';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Print' => intval($_POST["ID_Print"])));
			$data = $sth->fetchAll();
		}
		elseif($_POST["ID_Print"] != "" && count($data) > 0){
			$sql = 'UPDATE public."Print" SET "ID_Edition"= :ID_Edition, "ID_Tipography"= :ID_Tipography, "Printed_quantity"= :Printed_quantity where "ID_Print" = :ID_Print';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Print' => $_POST["ID_Print"],':ID_Edition' => $_POST["ID_Edition"],':ID_Tipography' => $_POST["ID_Tipography"], ':Printed_quantity' => $_POST["Printed_quantity"]));
			$data = $sth->fetchAll();
			$status = "Изменено";
			$data = null;
		}
    }
	elseif(isset($_POST["insert"])){
		$sql = 'INSERT INTO public."Print"("ID_Edition", "ID_Tipography", "Printed_quantity") VALUES (:ID_Edition, :ID_Tipography,  Printed_quantity)';
		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':ID_Edition' => $_POST["ID_Edition"],':ID_Tipography' => $_POST["ID_Tipography"], ':Printed_quantity' => $_POST["Printed_quantity"]));
		$data = $sth->fetchAll();
		 $status = "Добавлено";
		 $data = null;
	}
	elseif(isset($_POST["delete"])) {
        $sql = 'delete from public."Print" where "ID_Print" = :ID_Print';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Print' => $_POST["ID_Print"]));
        $data = $sth->fetchAll();
        $status = "Удалено.";
        $data = null;  
	}
}
?>
<body>
<form action="" method="post">
	Введите ID </br>
    <input name="ID_Print"  value="<?php echo '' ?>"> </br>
    <button type="submit" name="find">Поиск</button>
    <button type="submit" name="delete">Удаление</button>
</form>
<?php echo $status ?>
</br>
<form action="" method="post">
	 Идентификатор печати</br>
    <input name="ID_Print" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Print']?>">
	 <br>Идентификатор тиража</br>
    <input name="ID_Edition" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Print']?>">
	 <br>Идентификатор типографии</br>
    <input name="ID_Tipography" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Tipography']?>">
	 <br>Напечатанное количество экземпляров</br>
    <input name="Printed_quantity" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Printed_quantity']?>"></br>
    <button type="submit" name="insert">Добавление</button>
	<button type="submit" name="edit">Редактирование</button>
	<br><a href="index.php">"Назад"</a><br/>
</form>
</body>