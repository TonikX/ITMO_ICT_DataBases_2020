<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div align="left"><a href='index.php'>Main</a></div>
		<div align="left"><a href='exhibition_insert.php'>Add data to Exhibition</a></div>
		<div align="left"><a href='exhibition_delete.php'>Delete data from Exhibition</a></div>
		<hr>
		<h3>Изменить выставку</h3>
		<ul>
			<form name="change" action="exhibition_change.php" method="POST" >
				<ul>ID выставки:</ul><ul><input type="int" name="Exhibition_id"/></ul>
				<ul>Название выставки:</ul><ul><input type="text" name="Exhibition_name"/></ul>
				<ul>Тип выставки:</ul><ul><input type="text" name="Exhibition_type"/></ul>
				<ul>Дата выставки:</ul><ul><input type="date" name="Exhibition_date"/></ul>
				<ul>Место выставки:</ul><ul><input type="text" name="Exhibition_place"/></ul>
				<ul>Имя спонсора:</ul><ul><input type="text" name="Exhibition_sponsor_name"/></ul>
				<ul><input type="submit" name="Change" /></ul>
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
	if (isset($_POST["Change"])) {
            $infoA = "update $ExhibitionTable set \"Exhibition_name\"='$_POST[Exhibition_name]', \"Exhibition_type\"='$_POST[Exhibition_type]', \"Exhibition_date\"='$_POST[Exhibition_date]', \"Exhibition_place\"='$_POST[Exhibition_place]', \"Exhibition_sponsor_name\"='$_POST[Exhibition_sponsor_name]' where \"Exhibition_id\"='$_POST[Exhibition_id]'";
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