<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body style=>
		<h3>Изменим статус платежного поручения</h3>
		<ul>
			<form name="edit" action="edit.php" method="POST" >
				<ul>ID заявки: </ul><ul><input type="text" name="Req_ID"/></ul>
				    <br>
				<ul>Текущий статус:  </ul><ul><input type="text" name="sstatus"/></ul>
				    <br>
				<ul>Дата оплаты:  </ul><ul><input type="text" name="ddate"/></ul>
				    <br>
				<ul><input type="submit" name="edit" /></ul>
			</form>
		</ul>
	</body>
</html>

<?php

$connect = pg_connect("host=localhost port=5432 dbname=Lych user=postgres password=123");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["edit"])) {
            $q = "UPDATE \"Payment_order\" SET \"Status\" = '$_POST[sstatus]', \"Date\" = '$_POST[ddate]' WHERE \"Req_ID\" = '$_POST[Req_ID]' ";
            $result = pg_query($connect, $q);
			$all = pg_fetch_all($result);
	}
}

$q = "SELECT * FROM \"Payment_order\" order by \"Req_ID\"";
$result = pg_query($connect, $q);
$all = pg_fetch_all($result);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	}
	echo "<br>";

};
?>

<form action="index.php">
<button>На главную</button></br></form>
