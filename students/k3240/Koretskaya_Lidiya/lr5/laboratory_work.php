<!DOCTYPE html>
<html>
<head>
	<title>lr 5</title>
</head>
<body>

<?php

	function func ($result) {

		echo "<table>\n";
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		    echo "\t<tr>\n";
		    foreach ($line as $col_value) {
		        echo "\t\t<td>$col_value</td>\n";
		    }
		    echo "\t</tr>\n";
		}
		echo "</table>\n";
	} 

	$db = pg_connect("host=localhost dbname=college user=postgres password=admin")
	    or die('Не удалось соединиться: ' . pg_last_error());

	$query = 'SELECT * FROM student';
	$result = pg_query($db, $query) or die('Ошибка запроса: ' . pg_last_error());
	func($result);

	pg_free_result($result);
	pg_close($db);

	echo "<br>countdown: ";
	$i = 5;
	do {
		$i --;
		echo $i;
	} while ($i > 0);

	echo "<br>count: ";
	for ($i=0; $i < 5; $i++) { 
		echo $i;
	}

	echo "<br>bars performance: ";
	$points = 74;
	switch ($points) {
		case ($points < 60):
			echo "poor";
			break;
		case ($points > 60  and $points <= 74);
			echo "satisfactory";
			break;
		case ($points > 74  and $points <= 90):
			echo "good";
			break;
		case ($points > 90):
			echo "excellent";
			break;	
		default:
			echo "unknown";
			break;
	}

	echo "<br>_SESSION['name'] = ";
	session_start();
	if (!isset($_SESSION['name'])) {
		$_SESSION['name'] = 'first';
	} else {
		$_SESSION['name'] = 'second';
	}

	echo $_SESSION['name'];

	session_destroy();
?>

</body>
</html>