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
	$post_office_number = $_GET['search'];
	$output = true;
}

if (isset($_POST['post_office_number'])){
	$post_office_number = $_POST['post_office_number'];
	$adres = $_POST['adres'];
	put_($post_office_number, $adres);
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
        <a class="nav-link" href="edition.php">Edition</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="post_office.php">Post office<span class="sr-only">(current)</span></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="delivery.php">Delivery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="printing_office.php">Printing office</a>
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
	  <form method='post' action='post_office.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>Post office number</th>
			<th>adres</th>
			<th><p align='center'>Добавить</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='post_office_number' value=''></td>
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
			$query = "SELECT post_office_number, adres FROM post_office WHERE post_office_number='$post_office_number'";
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>post_office_number</th>
					<th>adres</th>
					<th><p align='center'>Удалить</p></th>
				</tr>
		
				";
				foreach($rows as $row)
				{	
					$id = $row['post_office_number'];
					echo "<tr>";
					echo "<form method='post' action='post_office.php'>";
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
	    <form method='get' action='post_office.php' align="center">
		
		<p><b>Post office number:</b> <input type='text' name='search' value=''> <input type='submit' name='button' value='Найти'></p>
		
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

function put_($post_office_number, $adres)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "INSERT INTO post_office (post_office_number, adres)
			  VALUES (:post_office_number, :adres)";
	$params = [
    ':post_office_number' => $post_office_number,
	':adres' => $adres];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "DELETE FROM post_office WHERE post_office_number = ?";
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