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
	$newspaper_name = $_GET['search'];
	$output = true;
}

if (isset($_POST['newspaper_name'])){
	$newspaper_name = $_POST['newspaper_name'];
	$index = $_POST['index'];
	$editor_name = $_POST['Editor_Name'];
	$editor_surname = $_POST['Editor_Surname'];
	$editor_patronymic = $_POST['Editor_Patronymic'];
	put_($newspaper_name, $editor_name, $editor_surname, $editor_patronymic, $index);
}



?>



<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Newspaper<span class="sr-only">(current)</span></a>
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
	  <form method='post' action='index.php'>
	  <table border='1px' cellspacing='2' cellpadding='10' width='100%'>
	  <tr>
			<th>Index</th>
			<th>Newspaper Name</th>
			<th>Editor Name</th>
			<th>Editor Patronymic</th>
			<th>Editor Surname</th>
			<th><p align='center'>Добавить</p></th>
		</tr>
	  <tr>
			<td><input required type='text' name='index' value=''></td>
			<td><input required type='text' name='newspaper_name' value=''></td>
			<td><input required type='text' name='Editor_Name' value=''></td>
			<td><input required type='text' name='Editor_Patronymic' value=''></td>
			<td><input required type='text' name='Editor_Surname' value=''></td>
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
			$query = "SELECT index, newspaper_name, editor_name, editor_patronymic, editor_surname FROM newspaper WHERE newspaper_name='$newspaper_name'";
			$rows = fetch_data($query);
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo 
				"
				<tr>
					<th>Index</th>
					<th>Newspaper Name</th>
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
	<div class="col-sm">
	  <h3 align='center'>Поиск</h3>
	  <br>
	    <form method='get' action='index.php' align="center">
		
		<p><b>Newspaper Name: </b><input type='text' name='search' value=''> <input type='submit' name='button' value='Найти'></p>
		
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

function put_($newspaper_name, $editor_name, $editor_surname, $editor_patronymic, $index)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "INSERT INTO newspaper (newspaper_name, editor_name, editor_surname, editor_patronymic, index)
			  VALUES (:newspaper_name, :editor_name, :editor_surname, :editor_patronymic, :index)";
	$params = [
	':index' => $index,
    ':newspaper_name' => $newspaper_name,
	':editor_name' => $editor_name,
	':editor_surname' => $editor_surname,
	':editor_patronymic' => $editor_patronymic
	];
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	
}

function delete_($id)
{
	global $dbuser, $dbpass, $host, $dbname;
	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$query = "DELETE FROM newspaper WHERE index = ?";
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


