<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div align="left"><a href='index.php'>Main</a></div>
		<div align="left"><a href='expert_change.php'>Change data in Expert</a></div>
		<div align="left"><a href='expert_delete.php'>Delete data from Expert</a></div>
		<hr>
		<h3>Добавить эксперта</h3>
		<ul>
			<form name="insert" action="expert_insert.php" method="POST" >
				<ul>ID эксперта:</ul><ul><input type="int" name="Expert_id"/></ul>
				<ul>Имя эксперта:</ul><ul><input type="text" name="Expert_name"/></ul>
				<ul>Клуб, в котором числится эксперт:</ul><ul><input type="text" name="Expert_club_name"/></ul>
				<ul><input type="submit" name="Add" /></ul>
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
$ExpertTable = '"public"."Expert"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["Add"])) {
            $infoA = "insert into $ExpertTable values ('$_POST[Expert_id]', '$_POST[Expert_name]', '$_POST[Expert_club_name]')";
            $result = pg_query($db, $infoA);
			$result = pg_fetch_all($result);
			pg_close($db);
         }
}

$dbuser = 'postgres';
$dbpass = '2001335';
$host = 'localhost';
$dbname='Dog_Exhibition';
$ExpertTable = '"public"."Expert"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$info = "select * from $ExpertTable";
$result = pg_query($db, $info);
$result = pg_fetch_all($result);
foreach ($result as $value) {
	echo "----------------------<br/>";
	foreach ($value as $key => $value) {
		echo "|  $key = $value <br/>";
	}
}; echo" ----------------------<br/>";
?>