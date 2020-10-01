<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Газеты</title>
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
	$gazeta_title = $_POST['gazeta_title'];
	$index = $_POST['index'];
	$Imya_redactora = $_POST['Imya_redactora'];
	$Familia_redactora = $_POST['Familia_redactora'];
	$Otchestvo_redactora = $_POST['Otchestvo_redactora'];
	put_($gazeta_title, $Imya_redactora, $Familia_redactora, $Otchestvo_redactora, $index);
}



?>



<body>



    <ul class="bar-my">
      <li class="my-item active">
        <a class="my-link" href="index.php">Газета</a>
      </li>
      <li class="my-item">
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
      <h3 align='center'>Добавить газету</h3>
	  <br>
	  <form method='post' action='index.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>Номер газеты</th>
			<th>Название газеты</th>
			<th>Имя редактора</th>
			<th>Отчество редактора</th>
			<th>Фамилия редактора</th>
			<th><p align='center'>Добавить</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='index' value=''></td>
			<td><input required type='text' name='gazeta_title' value=''></td>
			<td><input required type='text' name='Imya_redactora' value=''></td>
			<td><input required type='text' name='Familia_redactora' value=''></td>
			<td><input required type='text' name='Otchestvo_redactora' value=''></td>
			<td><input required type='submit' name='button' value='Добавить газету'></td>
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
	  <h3 align='center'>Газеты в таблице:</h3>
	  <br>
	    
		<?php
		if ($output)
		{
			$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
		
			$query = 'SELECT index,gazeta_title, "Imya_redactora", "Familia_redactora", "Otchestvo_redactora" from "Gazeta"';
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>Index</th>
					<th>Gazeta Name</th>
					<th>Editor Name</th>
					<th>Editor Patronymic</th>
					<th>Editor Surname</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
		
				";
				foreach($rows as $row)
				{	
					$id = $row['index'];
					echo "<tr>";
					echo "<form method='post' action='index.php'>";
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

function put_($gazeta_title, $Imya_redactora, $Familia_redactora, $Otchestvo_redactora, $index)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'INSERT INTO "Gazeta" (gazeta_title, "Imya_redactora", "Familia_redactora", "Otchestvo_redactora", index)
			  VALUES (:gazeta_title, :Imya_redactora, :Familia_redactora, :Otchestvo_redactora, :index)';
	$params = [
	':index' => $index,
    ':gazeta_title' => $gazeta_title,
	':Imya_redactora' => $Imya_redactora,
	':Familia_redactora' => $Familia_redactora,
	':Otchestvo_redactora' => $Otchestvo_redactora
	];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = 'DELETE FROM "Gazeta" WHERE index = ?';
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