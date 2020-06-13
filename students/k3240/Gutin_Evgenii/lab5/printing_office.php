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
$dbname = 'Newspaper';

if (isset($_POST['delete'])){
	$id = $_POST['delete'];
	delete_($id);
}


if (isset($_GET['search'])){
	$printing_office_name = $_GET['search'];
	$output = true;
}

if (isset($_POST['printing_office_name'])){
	$printing_office_name = $_POST['printing_office_name'];
	$adres = $_POST['adres'];
	put_($printing_office_name, $adres);
}



?>



<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Newspaper</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="query.php"><b>QUERY</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="edition.php">Edition</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="post_office.php">Post office</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="delivery.php">Delivery</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="printing_office.php">Printing office<span class="sr-only">(current)</span></a>
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
      <h3 align='center'>Добавление</h3>
	  <br>
	  <form method='post' action='printing_office.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>printing office name</th>
			<th>adres</th>
			<th><p align='center'>Добавить</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='printing_office_name' value=''></td>
			<td><input required type='text' name='adres' value=''></td>
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
			$query = "SELECT printing_office_name, adres FROM printing_office WHERE printing_office_name='$printing_office_name'";
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>printing office name</th>
					<th>adres</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
		
				";
				foreach($rows as $row)
				{	
					$id = $row['printing_office_name'];
					echo "<tr>";
					echo "<form method='post' action='printing_office.php'>";
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
	  <h3 align='center'>Поиск</h3>
	  <br>
	    <form method='get' action='printing_office.php' align="center">
		
		<p><b>Printing office name:</b> <input type='text' name='search' value=''> <input type='submit' name='button' value='Найти'></p>
		
		</form>
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
<footer>Evgenii Gutin - 2020(C)</footer>


 
</body>
</html>


<?php

function put_($printing_office_name, $adres)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "INSERT INTO printing_office (printing_office_name, adres)
			  VALUES (:printing_office_name, :adres)";
	$params = [
    ':printing_office_name' => $printing_office_name,
	':adres' => $adres];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "DELETE FROM printing_office WHERE printing_office_name = ?";
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