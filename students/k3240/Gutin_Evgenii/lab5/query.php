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

if (isset($_GET['query'])){
	$query = $_GET['query'];
	$output = true;
}
?>



<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Newspaper</a>
      </li>
	  <li class="nav-item  active">
        <a class="nav-link" href="query.php"><b>QUERY</b><span class="sr-only">(current)</span></a>
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
      <h3 align='center'>Put Your QUERY here</h3>
	  <br>
	  <form method='get' action='query.php' align="center">
		<textarea name="query" cols="100" rows="5">
SELECT newspaper_name, editor_surname FROM newspaper WHERE newspaper_name='Газета 1' OR newspaper_name = 'Газета 2'
UNION
SELECT newspaper_name, editor_surname FROM newspaper  WHERE newspaper_name='Газета 3'
EXCEPT
SELECT newspaper_name,editor_surname FROM newspaper WHERE newspaper_name='Газета 1';
		</textarea>
		<td><input required type='submit' name='button' value='Go!'></td>
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
	  <div>
		<?php
		if ($output)
		{
			$rows = fetch_data($query);
			if (!empty($rows)){
				
				echo "<table border='1px' cellspacing='2' cellpadding='10' width='100%'>";
				echo "<tr>";
				$counter = 1;
				foreach($rows[0] as $list){
						$keys = array_keys($rows[0], $list);
						foreach($keys as $key)
						{
								echo "<th>$key</th>";
						}
						
				}
				echo "</tr>";
				foreach($rows as $row)
				{	
				
					echo "<tr>";
					foreach($row as $name)
					{
						echo "<td>";
						echo $name . " ";
						echo "</td>";
				
					}
					echo"</tr>";
					echo "</form>";
				}
				
			}else{
				echo "No data or incorrect query";
			};
			
		}
		
		?>
		</div>
	  
    </div>
  </div>
</div>
<?php
function fetch_data($query)
{
	
		global $dbuser, $dbpass, $host, $dbname;
		$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		return $data;

	
}
?>
</body>
</html>