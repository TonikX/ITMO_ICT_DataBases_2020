<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body style=>
		<h3>Вносим изменения о ценах на услуги</h3>
		<ul>
			<form name="edit" action="edit.php" method="POST" >
				<ul>Название: </ul><ul><input type="text" name="service_name"/></ul>
				<br>
				<ul>Цена:  </ul><ul><input type="text" name="service_price"/></ul>
				<br>
				<ul><input type="submit" name="edit" /></ul>
			</form>
		</ul>
	</body>
</html>

<?php
$connect = pg_connect("host=localhost port=5432 dbname=ClinicDB user=postgres password=1708");
$edit = '"ClinicDB"."Prices"';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["edit"])) {
            $q = "UPDATE $edit SET \"service_price\"='$_POST[service_price]' WHERE \"service_name\"='$_POST[service_name]'";
            $cur = pg_query($connect, $q);
			$all = pg_fetch_all($cur);
			pg_close($connect);
	}
}


$connect = pg_connect("host=localhost port=5432 dbname=ClinicDB user=postgres password=1708");
$q = "SELECT * FROM $edit";
$cur = pg_query($connect, $q);
$all = pg_fetch_all($cur);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	}
	echo "<br>";

};
?>