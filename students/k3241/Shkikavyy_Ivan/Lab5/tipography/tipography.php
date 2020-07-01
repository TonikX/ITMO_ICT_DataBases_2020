<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Типографии</title>
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
        $sql = 'SELECT * from public."Tipography" where "ID_Tipography" = :ID_Tipography';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Tipography' => $_POST["ID_Tipography"]));
        $data = $sth->fetchAll();
        if(count($data) > 0){
            $status = "Результат:";
        }else{
            $status = "Информации нет.";
        }
    }
	elseif(isset($_POST["edit"])) {
		if($_POST["ID_Tipography"] != ""){
			$sql = 'UPDATE public."Tipography" SET "Tipography_name"= :Tipography_name, "Tipography_adress"= :Tipography_adress where "ID_Tipography" = :ID_Tipography';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Tipography' => $_POST["ID_Tipography"],':Tipography_name' => $_POST["Tipography_name"],':Tipography_adress' => $_POST["Tipography_adress"]));
			$data = $sth->fetchAll();
			$status = "Изменено";
			$data = null;
		}
    }
	elseif(isset($_POST["insert"])) {
		$sql = 'INSERT INTO public."Tipography"("Tipography_name", "Tipography_adress") VALUES (:Tipography_name, :Tipography_adress)';
		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':Tipography_name' => $_POST["Tipography_name"],':Tipography_adress' => $_POST["Tipography_adress"]));
		$data = $sth->fetchAll();
		 $status = "Добавлено";
		 $data = null;
	}
	elseif(isset($_POST["delete"])) {
        $sql = 'delete from public."Tipography" where "ID_Tipography" = :ID_Tipography';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Tipography' => $_POST["ID_Tipography"]));
        $data = $sth->fetchAll();
        $status = "Удалено.";
        $data = null;  
	}
}
?>
<body>
<form action="" method="post">
	Введите ID </br>
    <input name="ID_Tipography" placeholder value="<?php echo '' ?>"> </br>
    <button type="submit" name="find">Поиск</button>
    <button type="submit" name="delete">Удаление</button>
</form>
<?php echo $status ?>
</br>
<form action="" method="post">
	 Идентификатор типографии</br>
    <input name="ID_Tipography" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Tipography']?>">
	 <br>Типография</br>
    <input name="Tipography_name" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Tipography_name']?>">
	 <br>Адрес</br>
    <input name="Tipography_adress" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Tipography_adress']?>"></br>
    <button type="submit" name="insert">Добавление</button>
	<button type="submit" name="edit">Редактирование</button>
	<br><a href="index.php">"Назад"</a><br/>
</form>
<div>
    <table class="table" style="margin: 0px">
        <tbody>
        <tr>
            <th>ID_Tipography</th>
            <th>Tipography_name</th>
            <th>Tipography_adress</th>
         </tr>
		
		<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) {
			$ID_Tipography = $data[0]['ID_Tipography'];
            $Tipography_name = $data[0]['Tipography_name'];
            $Tipography_adress = $data[0]['Tipography_adress'];
			echo "<tr>
                    <td>$ID_Tipography</td>
                    <td>$Tipography_name</td>
                    <td>$Tipography_adress</td>
				</tr>";
		}else {
			$dbuser = 'postgres';
			$dbpassword = '1234';
			$host = 'localhost';
			$dbname = 'lab3';
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );
			$sql = 'SELECT * from public."Tipography"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();
            for($i=0; $i<count($data); $i++) {
                $ID_Tipography = $data[$i]['ID_Tipography'];
                $Tipography_name =  $data[$i]['Tipography_name'];
                $Tipography_adress = $data[$i]['Tipography_adress'];
                echo "<tr>
                   <td>$ID_Tipography</td>
                    <td>$Tipography_name</td>
                    <td>$Tipography_adress</td>>
                 </tr>";
			}
            }
?>
        </tbody>
    </table>
</div>

</body>