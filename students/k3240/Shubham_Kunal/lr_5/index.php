<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Labwork 5</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
$output = false;
$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname = 'labwork';

if (isset($_POST['delete'])){
	$id = $_POST['delete'];
	delete_($id);
}

if (isset($_GET['search'])){
	$id_exchange = $_GET['search'];
	$output = true;
}

if (isset($_POST['id_exchange'])){
	$id_exchange = $_POST['id_exchange'];
	$name_exchange = $_POST['name_exchange'];;
	put_($id_exchange, $name_exchange);
}
?>
<h1><center><b>Interface for Database</b></center></h1>
<body style="background-color:rgb(253, 245, 230);">
<nav class="navbar navbar-expand-lg navbar-black bg-black">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ol><b>
	<li class="nav-item">
        <a class="nav-link" href="query.php">Queries</a>
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
        <a class="nav-link" href="contract.php">Contract</a>
      </li>
    </ol></b>
  </div>
</nav>
<br>
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h3 align='center'>Add Data</h3>
	  <br>
	  <form method='post' action='index.php'>
	  <table border='1px' width='100%'>
	  <tr>
			<th>ID</th>
			<th>Name</th>
			<th><p align='center'>Add</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='id_exchange' value=''></td>
			<td><input required type='text' name='name_exchange' value=''></td>
			<td><input required type='submit' name='button' value='Add'></td>
	  </tr>
	  </table>
	  </form>
    </div>
	<div class="col-sm">
	  <h3 align='center'>Search</h3>
	  <br>
	    <form method='get' action='index.php' align="center">
		<p><b>ID: </b><input type='text' name='search' value=''> <input type='submit' name='button' value='Click'></p>
		</form>
    </div>
	<div class="col-sm">
	  <h3 align='center'>Result</h3>
	  <br>
		<?php
		if ($output)
		{
			$query = "SELECT id_exchange, name_exchange FROM exchange WHERE id_exchange='$id_exchange'";
			$rows = fetch_data($query);
				echo "<table border='1px' width='100%'>";
				echo 
				"
				<tr>
					<th>ID</th>
					<th>name_exchange</th>
					<th><p align='center'>Delete</p></th>
				</tr>
				";
				foreach($rows as $row)
				{	
					$id = $row['id_exchange'];
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
					echo"<input type='submit' name='button' value='Delete'>";
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
</body>
</html>
<?php

function put_($id_exchange, $name_exchange)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "INSERT INTO exchange (id_exchange, name_exchange)
			  VALUES (:id_exchange, :name_exchange)";
	$params = [
	':id_exchange' => $id_exchange,
    ':name_exchange' => $name_exchange,
	];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
}
function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "DELETE FROM exchange WHERE id_exchange = ?";
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