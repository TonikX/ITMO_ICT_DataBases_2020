<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Доставка</title>
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




if (isset($_POST['dostavka_id'])){
	$pochtovoe_otdelenie_id = $_POST['pochtovoe_otdelenie_id'];
	$dostavka_id = $_POST['dostavka_id'];
	$tirazh_id = $_POST['tirazh_id'];
	$gazeta_title = $_POST['gazeta_title'];
	$amount = $_POST['amount'];
	put_($pochtovoe_otdelenie_id, $dostavka_id, $tirazh_id, $gazeta_title, $amount);
}



?>


<body>


    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Газета</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tirazh.php">Тираж</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pochtovoe_otdelenie.php">Почтовое отделение</a>
      </li>
	  <li class="nav-item active>
        <a class="nav-link" href="dostavka.php">Доставка</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tipografia.php">Типография</a>
      </li>
    </ul>

<br>
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h3 align='center'>Добавление доставки</h3>
	  <br>
	  <form method='post' action='dostavka.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>Номер почтового отделения</th>
			<th>ID доставки</th>
			<th>Номер тиража</th>
			<th>Название газеты</th>
			<th>Количество</th>
			<th><p align='center'>Добавить доставку</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='pochtovoe_otdelenie_id' value=''></td>
			<td><input required type='text' name='dostavka_id' value=''></td>
			<td><input required type='text' name='tirazh_id' value=''></td>
			<td><input required type='text' name='gazeta_title' value=''></td>
			<td><input required type='text' name='amount' value=''></td>
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
	  <h3 align='center'>Вывод</h3>
	  <br>
	    
		<?php
		if ($output)
		{
			$query = 'SELECT pochtovoe_otdelenie_id, dostavka_id, tirazh_id, gazeta_title, amount FROM "Dostavka"';
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>pochtovoe_otdelenie_id</th>
					<th>dostavka_id</th>
					<th>tirazh_id</th>
					<th>gazeta_title</th>
					<th>amount</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
		
				";
				foreach($rows as $row)
				{	
					$id = $row['dostavka_id'];
					echo "<tr>";
					echo "<form method='post' action='dostavka.php'>";
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

function put_($pochtovoe_otdelenie_id, $dostavka_id, $tirazh_id, $gazeta_title, $amount)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'INSERT INTO "Dostavka" (pochtovoe_otdelenie_id, dostavka_id, tirazh_id, gazeta_title, amount)
			  VALUES (:pochtovoe_otdelenie_id, :dostavka_id, :tirazh_id, :gazeta_title, :amount)';
	$params = [
    ':gazeta_title' => $gazeta_title,
	':tirazh_id' => $tirazh_id,
	':dostavka_id' => $dostavka_id,
	':pochtovoe_otdelenie_id' => $pochtovoe_otdelenie_id,
	':amount' => $amount
	];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'DELETE FROM "Dostavka" WHERE dostavka_id = ?';
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