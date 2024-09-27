<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<h2>Добавить клиента</h2>
		<ul>
			<form name="new" action="new.php" method="POST" >
				<ul>Контактное лицо: </ul><ul><input type="text" name="name"/></ul>
					<br>
				<ul>Электронная почта: </ul><ul><input type="text" name="email"/></ul>
					<br>
				<ul>Телефон:  </ul><ul><input type="text" name="phone"/></ul>
					<br>
				<ul><input type="submit" name="add" /></ul>
			</form>
		</ul>
	</body>
</html>

<?php

$connect = pg_connect("host=localhost port=5432 dbname=Lych user=postgres password=123");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["add"])) {
			$q = "INSERT INTO \"Client\" VALUES ('$_POST[name]', '$_POST[email]', '$_POST[phone]')";
        $result = pg_query($connect, $q);
		$all = pg_fetch_all($result);
		pg_close($connect);
  }
};
?>

<form action="index.php">
<button>На главную</button></br></form>