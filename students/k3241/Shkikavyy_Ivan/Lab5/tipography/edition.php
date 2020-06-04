<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тираж</title>
</head>

<body>
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
        $sql = 'SELECT * from public."Edition" where "ID_Edition" = :ID_Edition';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Edition' => $_POST["ID_Edition"]));
        $data = $sth->fetchAll();
        if(count($data) > 0){
            $status = "Результат:";
        }else{
            $status = "Информации нет.";
        }
    }
	elseif(isset($_POST["edit"])) {
		if($_POST["ID_Edition"] != ""){
			$sql = 'SELECT * from public."Edition" where "ID_Edition" = :ID_Edition';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Edition' => intval($_POST["ID_Edition"])));
			$data = $sth->fetchAll();
		}
		elseif($_POST["ID_Edition"] != "" && count($data) > 0){
			$sql = 'UPDATE public."Edition" SET "ID_Newspaper"= :ID_Newspaper, "Publication_number"= :Publication_number, "Newspaper_amount"= :Newspaper_amount, "Price"= :Price where "ID_Edition" = :ID_Edition';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Edition' => $_POST["ID_Edition"],':ID_Newspaper' => $_POST["ID_Newspaper"],':Publication_number' => $_POST["Publication_number"], ':Newspaper_amount' => $_POST["Newspaper_amount"], ':Price' => $_POST["Price"]));
			$data = $sth->fetchAll();
			$status = "Изменено";
			$data = null;
		}
    }
	elseif(isset($_POST["insert"])) {
		$sql = 'INSERT INTO public."Edition"("ID_Newspaper", "Publication_number", "Newspaper_amount", "Price") VALUES (:ID_Newspaper, :Publication_number,  :Newspaper_amount, :Price)';
		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':ID_Newspaper' => $_POST["ID_Newspaper"],':Publication_number' => $_POST["Publication_number"], ':Newspaper_amount' => $_POST["Newspaper_amount"], ':Price' => $_POST["Price"]));
		$data = $sth->fetchAll();
		 $status = "Добавлено";
		 $data = null;
	}
	elseif(isset($_POST["delete"])) {
        $sql = 'delete from public."Edition" where "ID_Edition" = :ID_Edition';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Edition' => $_POST["ID_Edition"]));
        $data = $sth->fetchAll();
        $status = "Удалено.";
        $data = null;  
	}
}
?>
<form action="" method="post">
	Введите ID </br>
    <input name="ID_Edition" value="<?php echo '' ?>"> </br>
    <button type="submit" name="find">Поиск</button>
    <button type="submit" name="delete">Удаление</button>
</form>
</br>
<?php echo $status ?>
</br>
<form action="" method="post">
	 Идентификатор тиража</br>
    <input name="ID_Edition" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Edition']?>">
	 <br>Идентификатор Газеты</br>
    <input name="ID_Newspaper" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Newspaper']?>">
	 <br>Номер журнала</br>
    <input name="Publication_number" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Publication_number']?>">
	 <br>Запланированное количество номеров</br>
    <input name="Newspaper_amount" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Newspaper_amount']?>">
	<br>Цена</br>
    <input name="Price" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Price']?>"></br>
    <button type="submit" name="insert">Добавление</button>
	<button type="submit" name="edit">Редактирование</button>
	<br><a href="index.php">"Назад"</a><br/>
</form>
</body>