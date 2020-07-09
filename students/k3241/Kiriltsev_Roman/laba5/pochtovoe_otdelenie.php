<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Почтовое отделение</title>
</head>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
$output = 1;
$dbuser = 'postgres';
$dbpass = 'admin';
$host = 'localhost';
$dbname = 'laba3_bd';

if (isset($_POST['delete'])){
	$id = $_POST['delete'];
	delete_($id);
}



if (isset($_POST['pochtovoe_otdelenie_id'])){
	$pochtovoe_otdelenie_id = $_POST['pochtovoe_otdelenie_id'];
	$adress = $_POST['adress'];
	put_($pochtovoe_otdelenie_id, $adress);
}



?>



<body>


    <ul class="bar-my">
      <li class="my-item">
        <a class="my-link" href="index.php">Газета</a>
      </li>
      <li class="my-item">
        <a class="my-link" href="tirazh.php">Тираж</a>
      </li>
      <li class="my-item active">
        <a class="my-link" href="pochtovoe_otdelenie.php">Почтовое отделение</a>
      </li>
	  <li class="my-item">
        <a class="my-link" href="dostavka.php">Доставка</a>
      </li>
      <li class="my-item">
        <a class="my-link" href="tipografia.php">Типография</a>
      </li>
    </ul>

<br>
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h3 align='center'>Добавление отделения</h3>
	  <br>
	  <form method='post' action='pochtovoe_otdelenie.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>Номер отделения</th>
			<th>Адрес</th>
			<th><p align='center'>Добавить отделение</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='pochtovoe_otdelenie_id' value=''></td>
			<td><input required type='text' name='adress' value=''></td>
			<td><input required type='submit' name='button' value='Добавить'></td>
	  </tr>
	  </table>
	  </form>
    </div>
  </div>
</div>
<br>
<hr>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm">
	  <h3 align='center'>Вывод почтовых отделений</h3>
	  <br>
	    
		<?php
		if ($output)
		{
			$query = 'SELECT pochtovoe_otdelenie_id, adress FROM "Pochtovoe_otdelenie"';
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>pochtovoe_otdelenie_id</th>
					<th>adress</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
		
				";
				foreach($rows as $row)
				{	
					$id = $row['pochtovoe_otdelenie_id'];
					echo "<tr>";
					echo "<form method='post' action='pochtovoe_otdelenie.php'>";
					foreach($row as $name)
					{
						echo "<td>";
						echo $name . " ";
						echo "</td>";
				
					}
					echo"<td>";
					echo"<input type='hidden' name='delete' value=$id>";
					echo"<input type='submit' name='button' value='Удалить'>";
					echo"</td>";
					echo"</tr>";
					echo "</form>";
				}
				echo "</table>";
		}
		
		?>
		
	  
    </div>
	<div class="col-sm">
  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<hr>

 
</body>
</html>


<?php

function put_($pochtovoe_otdelenie_id, $adress)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'INSERT INTO "Pochtovoe_otdelenie" (pochtovoe_otdelenie_id, adress)
			  VALUES (:pochtovoe_otdelenie_id, :adress)';
	$params = [
    ':pochtovoe_otdelenie_id' => $pochtovoe_otdelenie_id,
	':adress' => $adress];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'DELETE FROM "Pochtovoe_otdelenie" WHERE pochtovoe_otdelenie_id = ?';
	$params = [$id];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
}

function fetch_data($query)
{
	
		global $dbuser, $dbpass, $host, $dbname;
		$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	
	
	
}
?>