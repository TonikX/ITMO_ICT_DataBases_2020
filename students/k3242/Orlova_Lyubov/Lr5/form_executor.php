<!DOCTYPE html>
<head>
<title>Change data: executor</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<style>
li {listt-style: none;}
</style>
</head>
<body>
</body>
</html>

<?php

try {

	$host = "localhost";
	$dbname = "Advertizing_Agency_Lych";
	$dbuser = "postgres";
	$dbpass = "mrorl";
	$connec = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	// Вывод Таблицы

	echo "
	<h2>Table executor</h2>";

	$result = $connec->query("SELECT * FROM clients.executor");

	foreach ($result as $row) {

		print $row['exe_id'] . " ";
		print $row['exe_name'] . " ";
		print $row['exe_ph'] . "<br>";

	}
	echo '<p></p>';

		//Добавление данных в таблицу
	
	echo "
	<h2>Enter information regarding executor to INSERT</h2>

	<form name='insert' action='form_executor.php' method='POST' >
	<li>Executor ID:</li><li><input type='character' name='exe_id' /></li>
	<li>Executor name:</li><li><input type='character varying' name='exe_name'  /></li>
	<li>Executor phone:</li><li><input type='character varying' name='exe_ph' /></li>
	<li><input type='submit' name='new' /></li>";

	if (isset($_POST['new']))
	{
		$connec->beginTransaction();
		$result_new = $connec->exec("INSERT INTO clients.executor (exe_id, exe_name, exe_ph) VALUES ('$_POST[exe_id]', '$_POST[exe_name]', '$_POST[exe_ph]')");
		$connec->commit();
		
		if (!$result_new) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Удаление данных из таблицы

	echo "
	<h2>Enter information regarding executor to DELETE</h2>
	<form name='delete' action='form_executor.php' method='POST' >
	<li>Executor ID:</li><li><input type='character' name='exe_id_delete' /></li>
	<li><input type='submit' name='delete' /></li>
	</form>";

	if (isset($_POST['delete'])) {
		$connec->beginTransaction();
		$result_del = $connec->exec("DELETE FROM clients.executor WHERE (exe_id='$_POST[exe_id_delete]')");
		$connec->commit();

		if (!$result_del) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Изменение данных в таблице

	// Ввод id исполнителя, данные о котором требуется изменить

	echo "
	<h2>Enter information regarding executor to UPDATE </h2>
	<form name='display' action='form_executor.php' method='POST' >
	<li>Executor ID:</li><li><input type='character' name='exe_id_to_upd' /></li>
	<li><input type='submit' name='submit' /></li>
	</form>"; 

	if (isset($_POST['submit'])) {

		$result_id = $connec->query("SELECT * FROM clients.executor WHERE exe_id = '$_POST[exe_id_to_upd]'");
		$row = $result_id->fetch();


		echo "<ul>
		<form name='upd' action='form_executor.php' method='POST' >
		<li>Executor ID:</li><li><input type='character' name='exe_id_upd' value='$row[exe_id]' /></li>
		<li>Executor name:</li><li><input type='character varying' name='exe_name_upd' value='$row[exe_name]' /></li>
		<li>Executor phone:</li><li><input type='character varying' name='exe_ph_upd' value='$row[exe_ph]' /></li>
		<li><input type='submit' name='update' /></li></form>
		</ul>";

		}


		if (isset($_POST['update'])) {
			$connec->beginTransaction();
			$result_upd = $connec->exec("UPDATE clients.executor SET exe_id = '$_POST[exe_id_upd]', exe_name = '$_POST[exe_name_upd]', exe_ph = '$_POST[exe_ph_upd]' WHERE exe_id = '$_POST[exe_id_upd]' ");
			$connec->commit();

			if (!$result_upd) {
				echo "<p>Update failed!!</p>";
			} else {
				echo "<p>Update successfull;</p>";
			}
		}
		

	

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br />";
}

?>