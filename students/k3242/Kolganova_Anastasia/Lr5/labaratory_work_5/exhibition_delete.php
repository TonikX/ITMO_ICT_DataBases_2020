<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div align="left"><a href='index.php'>Main</a></div>
		<div align="left"><a href='exhibition_insert.php'>Add data to Exhibition</a></div>
		<div align="left"><a href='exhibition_change.php'>Change data in Exhibition</a></div>
		<hr>
		<h3>Удалить выставку</h3>
		<ul>
			<form name="delete" action="exhibition_delete.php" method="POST" >
				<ul>ID выставки:</ul><ul><input type="int" name="Exhibition_id"/></ul>
				<ul><input type="submit" name="Delete" /></ul>
			</form>
		</ul>
		<hr>
	</body>
</html>


<?php
echo "<br/>";
$dbuser = 'postgres';
$dbpass = '2001335';
$host = 'localhost';
$dbname='Dog_Exhibition';
$ExhibitionTable = '"public"."Exhibition"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["Delete"])) {
            $infoA = "delete from $ExhibitionTable where \"Exhibition_id\"='$_POST[Exhibition_id]'";
            $result = pg_query($db, $infoA);
			$result = pg_fetch_all($result);
			pg_close($db);
         }
}

$dbuser = 'postgres';
$dbpass = '2001335';
$host = 'localhost';
$dbname='Dog_Exhibition';
$ExhibitionTable = '"public"."Exhibition"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$info = "select * from $ExhibitionTable";
$result = pg_query($db, $info);
$result = pg_fetch_all($result);
foreach ($result as $value) {
	echo "----------------------<br/>";
	foreach ($value as $key => $value) {
		echo "|  $key = $value <br/>";
	}
}; echo" ----------------------<br/>";
?>
