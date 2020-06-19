<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<hr>
		<h3>Введите информацию, чтобы добавить клиента</h3>
		<ul>
			<form name="insert" action="insert.php" method="POST" >
				<ul>ID клиента:</ul><ul><input type="int" name="ID_client"/></ul>
				<ul>Имя клиента:</ul><ul><input type="text" name="Client_name"/></ul>
				<ul>Сумма, которой обладает клиент:</ul><ul><input type="money" name="Account"/></ul>
				<ul><input type="submit" name="Add" /></ul>
			</form>
		</ul>
		<hr>
	</body>
</html>


<?php
echo "<br/>";
$dbuser = 'postgres';
$dbpass = '?';
$host = 'localhost';
$dbname ='Exchange';
$ClientTable = '"Exchange"."Client"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["Add"])) {
            $infoA = "insert into $ClientTable values ('$_POST[ID_client]', '$_POST[Client_name]', '$_POST[Account]')";
            $result = pg_query($db, $infoA);
			$result = pg_fetch_all($result);
			pg_close($db);
         }
}

$dbuser = 'postgres';
$dbpass = '?';
$host = 'localhost';
$dbname ='Exchange';
$ClientTable = '"Exchange"."Client"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$info = "select * from $ClientTable";
$result = pg_query($db, $info);
$result = pg_fetch_all($result);
foreach ($result as $value) {
	echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
	foreach ($value as $key => $value) {
		echo "|  $key = $value <br/>";
	}
}; echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
?>