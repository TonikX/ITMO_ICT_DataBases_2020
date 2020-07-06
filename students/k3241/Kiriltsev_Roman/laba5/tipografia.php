<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Типография</title>
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



if (isset($_POST['tipografia_title'])){
	$tipografia_title = $_POST['tipografia_title'];
	$adress = $_POST['adress'];
	put_($tipografia_title, $adress);
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
	  <li class="nav-item">
        <a class="nav-link" href="dostavka.php">Доставка</a>
      </li>
      <li class="nav-item active">
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
      <h3 align='center'>Добавление типография</h3>
	  <br>
	  <form method='post' action='Tipografia.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>Название типографии</th>
			<th>Адрес</th>
			<th><p align='center'>Добавить типографию</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='tipografia_title' value=''></td>
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
	  <h3 align='center'>Вывод</h3>
	  <br>
	    
		<?php
		if ($output)
		{
			$query = 'SELECT tipografia_title, adress FROM "Tipografia"';
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>Название типографии</th>
					<th>Адрес</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
		
				";
				foreach($rows as $row)
				{	
					$id = $row['tipografia_title'];
					echo "<tr>";
					echo "<form method='post' action='Tipografia.php'>";
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

function put_($tipografia_title, $adress)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'INSERT INTO "Tipografia" (tipografia_title, adress)
			  VALUES (:tipografia_title, :adress)';
	$params = [
    ':tipografia_title' => $tipografia_title,
	':adress' => $adress];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'DELETE FROM "Tipografia" WHERE tipografia_title = ?';
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