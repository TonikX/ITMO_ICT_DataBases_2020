<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Распределение</title>
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
        $sql = 'SELECT * from public."Distribution" where "ID_Distribution" = :ID_Distribution';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Distribution' => $_POST["ID_Distribution"]));
        $data = $sth->fetchAll();
        if(count($data) > 0){
            $status = "Результат:";
        }else{
            $status = "Информации нет.";
        }
    }
	elseif(isset($_POST["edit"])) {
		if($_POST["ID_Distribution"] != ""){
			$sql = 'SELECT * from public."Distribution" where "ID_Distribution" = :ID_Distribution';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Distribution' => ($_POST["ID_Distribution"])));
			$data = $sth->fetchAll();
		}
		elseif($_POST["ID_Distribution"] != "" && count($data) > 0){
			$sql = 'UPDATE public."Distribution" SET "ID_Post"= :ID_Post, "ID_Edition"= :ID_Edition, "Full_quantity_newspaper"= :Full_quantity_newspaper where "ID_Distribution" = :ID_Distribution';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Distribution' => $_POST["ID_Distribution"],':ID_Post' => $_POST["ID_Post"],':ID_Edition' => $_POST["ID_Edition"], ':Full_quantity_newspaper' => $_POST["Full_quantity_newspaper"]));
			$data = $sth->fetchAll();
			$status = "Изменено";
			$data = null;
		}else{
		$sql = 'INSERT INTO public."Distribution"("ID_Post", "ID_Edition", "Full_quantity_newspaper") VALUES (:ID_Post, :ID_Edition,  Full_quantity_newspaper)';
		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':ID_Post' => $_POST["ID_Post"],':ID_Edition' => $_POST["ID_Edition"], ':Full_quantity_newspaper' => $_POST["Full_quantity_newspaper"]));
		$data = $sth->fetchAll();
		 $status = "Добавлено";
		 $data = null;
        }
    }
	elseif(isset($_POST["insert"])){
		$sql = 'INSERT INTO public."Distribution"("ID_Post", "ID_Edition", "Full_quantity_newspaper") VALUES (:ID_Post, :ID_Edition,  Full_quantity_newspaper)';
		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':ID_Post' => $_POST["ID_Post"],':ID_Edition' => $_POST["ID_Edition"], ':Full_quantity_newspaper' => $_POST["Full_quantity_newspaper"]));
		$data = $sth->fetchAll();
		 $status = "Добавлено";
		 $data = null;
	}
	elseif(isset($_POST["delete"])) {
        $sql = 'delete from public."Distribution" where "ID_Distribution" = :ID_Distribution';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Distribution' => $_POST["ID_Distribution"]));
        $data = $sth->fetchAll();
        $status = "Удалено.";
        $data = null;  
	}
}
?>
<body>
<form action="" method="post">
	Введите ID </br>
    <input name="ID_Distribution" value="<?php echo '' ?>"> </br>
    <button type="submit" name="find">Поиск</button>
    <button type="submit" name="delete">Удаление</button>
</form>
<?php echo $status ?>
</br>
<form action="" method="post">
	 Идентификатор распределения</br>
    <input name="ID_Distribution" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Distribution']?>">
	 <br>Идентификатор почтового отделения</br>
    <input name="ID_Post" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Post']?>">
	 <br>Идентификатор тиража</br>
    <input name="ID_Edition" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Edition']?>">
	 <br>Количество номеров на распределение</br>
    <input name="Full_quantity_newspaper" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Full_quantity_newspaper']?>"></br>
    <button type="submit" name="insert">Добавление</button>
	<button type="submit" name="edit">Редактирование</button>
	<br><a href="index.php">"Назад"</a><br/>
</form>
</body>