<!DOCTYPE html>
<head>
<title>Change data: request</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<style>
li {listt-style: none;}
</style>
</head>
<body>
</body>
</html>

<?php
//error_reporting(0);
try {

	$host = "localhost";
	$dbname = "Advertizing_Agency_Lych";
	$dbuser = "postgres";
	$dbpass = "mrorl";
	$connec = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Вывод Таблицы

	echo "
	<h2>Table requests</h2>";

	$result = $connec->query("SELECT * FROM clients.request");

	foreach ($result as $row) {

		print $row['request_id'] . " ";
		print $row['request_date'] . " ";
		print $row['total_cost'] . " ";
		print $row['work_scope'] . " ";
		print $row['status'] . " ";
		print $row['req_cl_id'] . "<br>";

	}
	echo '<p></p>';


	//Добавление данных в таблицу
	
	echo "
	<h2>Enter information regarding request to INSERT</h2>
	<form name='insert' action='form_request.php' method='POST' >
	<li>Request id:</li><li><input type='character' name='request_id' /></li>
	<li>Request date:</li><li><input type='date' name='request_date'  /></li>
	<li>Total cost:</li><li><input type='numeric' name='total_cost'/></li>
	<li>Work scope:</li><li><input type='character varying' name='work_scope' /></li>
	<li>Status:</li><li><input type='character varying' name='status' /></li>
	<li>Request client ID:</li><li><input type='character' name='req_cl_id' /></li>
	<li><input type='submit' name='new' /></li>";

	if (isset($_POST['new']))
	{
		$connec->beginTransaction();
		$result_new = $connec->exec("INSERT INTO clients.request (request_id, request_date, total_cost, work_scope, status, req_cl_id) VALUES ('$_POST[request_id]', '$_POST[request_date]', '$_POST[total_cost]', '$_POST[work_scope]', '$_POST[status]', '$_POST[req_cl_id]')");
		$connec->commit();
		
		if (!$result_new) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Удаление данных из таблицы

	echo "
	<h2>Enter information regarding request to DELETE</h2>
	<form name='delete' action='form_request.php' method='POST' >
	<li>Request ID to delete:</li><li><input type='character' name='request_id_delete' /></li>
	<li><input type='submit' name='delete' /></li>
	</form>";

	if (isset($_POST['delete'])) {
		$connec->beginTransaction();
		$result_del = $connec->exec("DELETE FROM clients.request WHERE (request_id='$_POST[request_id_delete]')");
		$connec->commit();

		if (!$result_del) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}



	//Изменение данных в таблице

	// Ввод id заявки, данные о которой требуется изменить

	echo "
	<h2>Enter information regarding request to UPDATE </h2>
	<form name='display' action='form_request.php' method='POST' >
	<li>Request ID:</li><li><input type='character' name='req_id_to_upd' /></li>
	<li><input type='submit' name='submit' /></li>
	</form>"; 

	if (isset($_POST['submit'])) {

		$result_id = $connec->query("SELECT * FROM clients.request WHERE request_id = '$_POST[req_id_to_upd]'");
		$row = $result_id->fetch();


		echo "<ul>
		<form name='upd' action='form_request.php' method='POST' >
		<li>Request id:</li><li><input type='character' name='request_id_upd' value='$row[request_id]' /></li>
		<li>Request date:</li><li><input type='date' name='request_date_upd' value='$row[request_date]' /></li>
		<li>Total cost:</li><li><input type='numeric' name='total_cost_upd' value='$row[total_cost]' /></li>
		<li>Work scope:</li><li><input type='character varying' name='work_scope_upd' value='$row[work_scope]' /></li>
		<li>Status:</li><li><input type='character varying' name='status_upd' value='$row[status]' /></li>
		<li>Request client ID:</li><li><input type='character' name='req_cl_id_upd' value='$row[req_cl_id]' /></li>
		<li><input type='submit' name='update' /></li>
		</form>
		</ul>";

	}

	// Изменение данных

	if (isset($_POST['update'])) {
		$connec->beginTransaction();
		$result_upd = $connec->exec("UPDATE clients.request SET request_date = '$_POST[request_date_upd]', total_cost = '$_POST[total_cost_upd]', work_scope = '$_POST[work_scope_upd]', status = '$_POST[status_upd]', req_cl_id = '$_POST[req_cl_id_upd]' WHERE request_id = '$_POST[request_id_upd]' ");
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