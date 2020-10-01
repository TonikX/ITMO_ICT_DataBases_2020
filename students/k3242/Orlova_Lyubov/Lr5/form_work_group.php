<!DOCTYPE html>
<head>
<title>Change data: work group</title>
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
	<h2>Table work group</h2>";

	$result = $connec->query("SELECT * FROM clients.work_group");

	foreach ($result as $row) {

		print $row['start_d'] . " ";
		print $row['end_d'] . " ";
		print $row['wg_exe_id'] . " ";
		print $row['wg_req_id'] . "<br>";

	}
	echo '<p></p>';

		//Добавление данных в таблицу
	
	echo "
	<h2>Enter information regarding work group to INSERT</h2>

	<form name='insert' action='form_work_group.php' method='POST' >
	<li>Start date:</li><li><input type='date' name='start_d' /></li>
	<li>End date:</li><li><input type='date' name='end_d'  /></li>
	<li>Executor ID:</li><li><input type='character' name='wg_exe_id'/></li>
	<li>Request ID:</li><li><input type='character' name='wg_req_id' /></li>
	<li><input type='submit' name='new' /></li>";

	if (isset($_POST['new']))
	{
		$connec->beginTransaction();
		$result_new = $connec->exec("INSERT INTO clients.work_group (start_d, end_d, wg_exe_id, wg_req_id) VALUES ('$_POST[start_d]', '$_POST[end_d]', '$_POST[wg_exe_id]', '$_POST[wg_req_id]')");
		$connec->commit();
		
		if (!$result_new) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Удаление данных из таблицы

	echo "
	<h2>Enter information regarding work group to DELETE</h2>
	<form name='delete' action='form_work_group.php' method='POST' >
	<li>Executor ID:</li><li><input type='character' name='wg_exe_id_delete' /></li>
	<li>Request ID:</li><li><input type='character' name='wg_req_id_delete' /></li>
	<li><input type='submit' name='delete' /></li>
	</form>";

	if (isset($_POST['delete'])) {
		$connec->beginTransaction();
		$result_del = $connec->exec("DELETE FROM clients.work_group WHERE (wg_exe_id='$_POST[wg_exe_id_delete]') AND (wg_req_id='$_POST[wg_req_id_delete]')");
		$connec->commit();

		if (!$result_del) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


		//Изменение данных в таблице

	// Ввод id рабочей группы, данные о которой требуется изменить

	echo "
	<h2>Enter information regarding work group to UPDATE </h2>
	<form name='display' action='form_work_group.php' method='POST' >
	<li>Executor ID:</li><li><input type='character' name='exe_id_to_upd' /></li>
	<li>Request ID:</li><li><input type='character' name='req_id_to_upd' /></li>

	<li><input type='submit' name='submit' /></li>
	</form>"; 

	if (isset($_POST['submit'])) {

		$result_id = $connec->query("SELECT * FROM clients.work_group WHERE wg_exe_id = '$_POST[exe_id_to_upd]' AND wg_req_id = '$_POST[req_id_to_upd]' ");
		$row = $result_id->fetch();


		echo "<ul>
		<form name='upd' action='form_work_group.php' method='POST' >
		<li>Start date:</li><li><input type='date' name='start_d_upd' value='$row[start_d]' /></li>
		<li>End date:</li><li><input type='date' name='end_d_upd' value='$row[end_d]' /></li>
		<li>Executor ID:</li><li><input type='character' name='wg_exe_id_upd' value='$row[wg_exe_id]' /></li>
		<li>Request ID:</li><li><input type='character' name='wg_req_id_upd' value='$row[wg_req_id]' /></li>
		<li><input type='submit' name='update' /></li></form>
		</ul>";

	}

	// Изменение данных

	if (isset($_POST['update'])) {
		$connec->beginTransaction();
		$result_upd = $connec->exec("UPDATE clients.work_group SET start_d = '$_POST[start_d_upd]', end_d = '$_POST[end_d_upd]' WHERE wg_exe_id = '$_POST[wg_exe_id_upd]' AND wg_req_id = '$_POST[wg_exe_id_upd]' ");
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