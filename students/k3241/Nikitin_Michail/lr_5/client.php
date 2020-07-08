<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Lab 5</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
$output = false;
$dbuser = 'postgres';
$dbpass = '1';
$host = 'localhost';
$dbname = 'exchange';

if (isset($_POST['delete'])){
	$id = $_POST['delete'];
	delete_($id);
}


if (isset($_GET['search'])){
	$id_client = $_GET['search'];
	$output = true;
}

if (isset($_POST['id_client'])){
	$id_client = $_POST['id_client'];
	$client_name = $_POST['client_name'];;
	put_($id_client, $client_name);
}



?>



<body>

<nav class="navbar navbar-expand-lg navbar-black bg-black">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul>
	<li class="nav-item">
        <a class="nav-link" href="query.php"><b>QUERIES</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Exchange</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="client.php">Client</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="broker.php">Broker</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="treaty.php">Treaty</a>
      </li>
    </ul>
  </div>
</nav>
<br>
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h3 align='center'>Добавить</h3>
	  <br>
	  <form method='post' action='client.php'>
	  <table border='1px' width='100%'>
	  <tr>
			<th>ID</th>
			<th>Name</th>
			<th><p align='center'>Добавить</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='id_client' value=''></td>
			<td><input required type='text' name='client_name' value=''></td>
			<td><input required type='submit' name='button' value='Добавить'></td>
	  </tr>
	  </table>
	  </form>
    </div>
	<div class="col-sm">
	  <h3 align='center'>Найти</h3>
	  <br>
	    <form method='get' action='client.php' align="center">
		
		<p><b>ID: </b><input type='text' name='search' value=''> <input type='submit' name='button' value='Найти'></p>
		
		</form>
    </div>
	<div class="col-sm">
	  <h3 align='center'>Показать</h3>
	  <br>
	    
		<?php
		if ($output)
		{
			$query = "SELECT client.id_client, client.client_name FROM exchange.client WHERE client.id_client='$id_client'";
			$rows = fetch_data($query);
				echo "<table border='1px' width='100%'>";
				echo 
				"
				<tr>
					<th>ID</th>
					<th>Client name</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
				";
				foreach($rows as $row)
				{	
					$id = $row['id_client'];
					echo "<tr>";
					echo "<form method='post' action='client.php'>";
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
<br>
<br>


 
</body>
</html>


<?php

function put_($id_client, $client_name)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "INSERT INTO exchange.client (id_client, client_name)
			  VALUES (:id_client, :client_name)";
	$params = [
	':id_client' => $id_client,
    ':client_name' => $client_name,
	];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "DELETE FROM exchange.client WHERE client.id_client = ?";
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
