<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body style=>
		<h3>Удалить клиента</h3>
		<ul>
			<form name="delete" action="delete.php" method="POST" >
				<ul>Кого удаляем?</ul><ul><input type="text" name="name"/></ul>
				<ul><input type="submit" name="delete" /></ul>
			</form>
		</ul>
	</body>
</html>

<?php

$connect = pg_connect("host=localhost port=5432 dbname=Lych user=postgres password=123");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["delete"])) {
        $q = "DELETE FROM \"Client\" WHERE \"Name\"='$_POST[name]'";
        $result = pg_query($q);
		$all = pg_fetch_all($result);
    }
}

$q = "SELECT * FROM \"Client\"";
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	}
	echo "<br><br>";
};
?>

<form action="index.php">
<button>На главную</button></br></form>