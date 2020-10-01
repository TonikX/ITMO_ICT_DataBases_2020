<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Тираж</title>
</head>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
$output = true;
$dbuser = 'postgres';
$dbpass = 'admin';
$host = 'localhost';
$dbname = 'laba3_bd';

if (isset($_POST['delete'])){
	$id = $_POST['delete'];
	delete_($id);
}



if (isset($_POST['gazeta_title'])){
	$tirazh_id = $_POST['tirazh_id'];
	$gazeta_title = $_POST['gazeta_title'];
	$stoimost = $_POST['stoimost'];
	$amount = $_POST['amount'];
	put_($tirazh_id, $gazeta_title, $stoimost, $amount);
}



?>



<body>


    <ul class="bar-my">
      <li class="my-item">
        <a class="my-link" href="index.php">Газета</a>
      </li>
      <li class="my-item active">
        <a class="my-link" href="tirazh.php">Тираж</a>
      </li>
      <li class="my-item">
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
      <h3 align='center'>Добавление тиража</h3>
	  <br>
	  <form method='post' action='Tirazh.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>Номер тиража</th>
			<th>Название газеты</th>
			<th>Стоимость</th>
			<th>Кол-во газет в тираже</th>
			<th><p align='center'>Добавить тираж</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='tirazh_id' value=''></td>
			<td><input required type='text' name='gazeta_title' value=''></td>
			<td><input required type='text' name='stoimost' value=''></td>
			<td><input required type='text' name='amount' value=''></td>
			<td><input required type='submit' name='button' value='Добавить тираж'></td>
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
	  <h3 align='center'>Вывод тиражей</h3>
	  <br>
	    
		<?php
		if ($output)
		{
			$query = 'SELECT tirazh_id, gazeta_title, stoimost, amount FROM "Tirazh"';
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>tirazh_id</th>
					<th>gazeta_title</th>
					<th>stoimost</th>
					<th>amount</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
		
				";
				foreach($rows as $row)
				{	
					$id = $row['tirazh_id'];
					echo "<tr>";
					echo "<form method='post' action='Tirazh.php'>";
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
    </div>
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

function put_($tirazh_id, $gazeta_title, $stoimost, $amount)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'INSERT INTO "Tirazh" ("tirazh_id", "gazeta_title", "stoimost", "amount")
			  VALUES (:tirazh_id, :gazeta_title, :stoimost, :amount)';
	$params = [
    ':gazeta_title' => $gazeta_title,
	':tirazh_id' => $tirazh_id,
	':stoimost' => $stoimost,
	':amount' => $amount
	];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'DELETE FROM "Tirazh" WHERE tirazh_id = ?';
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