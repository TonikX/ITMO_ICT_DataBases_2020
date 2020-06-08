<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Газеты</title>
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
        $sql = 'SELECT * from public."Newspaper" where "ID_Newspaper" = :ID_Newspaper';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Newspaper' => $_POST["ID_Newspaper"]));
        $data = $sth->fetchAll();
        if(count($data) > 0){
            $status = "Результат:";
        }else{
            $status = "Информации нет.";
        }
    }
	elseif(isset($_POST["edit"])) {
		if($_POST["ID_Newspaper"] !=""){
			$sql = 'UPDATE public."Newspaper" SET "Naming"= :Naming, "Index"= :Index, "Reductor" = :Reductor where "ID_Newspaper" = :ID_Newspaper';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':ID_Newspaper' => $_POST["ID_Newspaper"],':Naming' => $_POST["Naming"],':Index' => $_POST["Index"],':Reductor' => $_POST["Reductor"]));
			$data = $sth->fetchAll();
			$status = "Изменено";
			$data = null;
		}
    }
	elseif(isset($_POST["insert"])){
		$sql = 'INSERT INTO public."Newspaper"("Naming", "Index", "Reductor") VALUES (:Naming, :Index, :Reductor)';
		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':Naming' => $_POST["Naming"],':Index' => $_POST["Index"],':Reductor' => $_POST["Reductor"]));
		$data = $sth->fetchAll();
		 $status = "Добавлено";
		 $data = null;
	}
	elseif(isset($_POST["delete"])) {
        $sql = 'delete from public."Newspaper" where "ID_Newspaper" = :ID_Newspaper';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':ID_Newspaper' => $_POST["ID_Newspaper"]));
        $data = $sth->fetchAll();
        $status = "Удалено.";
        $data = null;  
	}
}
?>
<form action="" method="post">
	Введите ID </br>
    <input name="ID_Newspaper"  value="<?php echo '' ?>"> </br>
    <button type="submit" name="find">Поиск</button>
    <button type="submit" name="delete">Удаление</button>
</form>
<?php echo $status ?>
</br>
<form action="" method="post">
	 Идентификатор газеты</br>
    <input name="ID_Newspaper" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['ID_Newspaper']?>">
	 <br>Бренд газеты</br>
    <input name="Naming" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Naming']?>">
	 <br>Индекс</br>
    <input name="Index" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Index']?>">
	 <br>Редактор</br>
    <input name="Reductor" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['Reductor']?>"></br>
    <button type="submit" name="insert">Добавление</button>
	<button type="submit" name="edit">Редактирование</button>
	<br><a href="index.php">"Назад"</a><br/>
			
</form>	
	<div>
    <table class="table" style="margin: 0px">
        <tbody>
        <tr>
            <th>ID_Newspaper</th>
            <th>Naming</th>
            <th>Index</th>
            <th>Reductor</th>
         </tr>
		
		<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) {
			$ID_Newspaper = $data[0]['ID_Newspaper'];
            $Naming = $data[0]['Naming'];
            $Index = $data[0]['Index'];
            $Reductor = $data[0]['Reductor'];
			echo "<tr>
                    <td>$ID_Newspaper</td>
                    <td>$Naming</td>
                    <td>$Index</td>
                    <td>$Reductor</td>
				</tr>";
		}else {
			$dbuser = 'postgres';
			$dbpassword = '1234';
			$host = 'localhost';
			$dbname = 'lab3';
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );
			$sql = 'SELECT * from public."Newspaper"';
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll();

            for($i=0; $i<count($data); $i++) {
                $ID_Newspaper = $data[$i]['ID_Newspaper'];
                $Naming =  $data[$i]['Naming'];
                $Index = $data[$i]['Index'];
                $Reductor = $data[$i]['Reductor'];
                echo "<tr>
                   <td>$ID_Newspaper</td>
                    <td>$Naming</td>
                    <td>$Index</td>
                    <td>$Reductor</td>
                 </tr>";
			}
            }
?>
        </tbody>
    </table>
</div>

</body>
</html>

