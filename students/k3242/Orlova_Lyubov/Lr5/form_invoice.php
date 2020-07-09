<!DOCTYPE html>
<head>
<title>Change data: invoice</title>
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
	<h2>Table invoice</h2>";

	$result = $connec->query("SELECT * FROM clients.invoice");

	foreach ($result as $row) {

		print $row['inv_id'] . " ";
		print $row['inv_due'] . " ";
		print $row['inv_req_id'] . " ";
		print $row['inv_cl_id'] . "<br>";

	}
	echo '<p></p>';

		//Добавление данных в таблицу
	
	echo "
	<h2>Enter information regarding invoice to INSERT</h2>

	<form name='insert' action='form_invoice.php' method='POST' >
	<li>Invoice ID:</li><li><input type='character' name='inv_id' /></li>
	<li>Invoice due:</li><li><input type='date' name='inv_due'  /></li>
	<li>Request ID:</li><li><input type='character' name='inv_req_id'/></li>
	<li>Client ID:</li><li><input type='character' name='inv_cl_id' /></li>
	<li><input type='submit' name='new' /></li>";

	if (isset($_POST['new']))
	{
		$connec->beginTransaction();
		$result_new = $connec->exec("INSERT INTO clients.invoice (inv_id, inv_due, inv_req_id, inv_cl_id) VALUES ('$_POST[inv_id]', '$_POST[inv_due]', '$_POST[inv_req_id]', '$_POST[inv_cl_id]')");
		$connec->commit();
		
		if (!$result_new) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Удаление данных из таблицы

	echo "
	<h2>Enter information regarding invoice to DELETE</h2>
	<form name='delete' action='form_invoice.php' method='POST' >
	<li>Invoice ID to delete:</li><li><input type='character' name='inv_id_delete' /></li>
	<li><input type='submit' name='delete' /></li>
	</form>";

	if (isset($_POST['delete'])) {
		$connec->beginTransaction();
		$result_del = $connec->exec("DELETE FROM clients.invoice WHERE (inv_id='$_POST[inv_id_delete]')");
		$connec->commit();

		if (!$result_del) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Изменение данных в таблице

	// Ввод id платежного поручения, данные о котором требуется изменить

	echo "
	<h2>Enter information regarding invoice to UPDATE </h2>
	<form name='display' action='form_invoice.php' method='POST' >
	<li>Invoice ID:</li><li><input type='character' name='invoice_id_to_upd' /></li>
	<li><input type='submit' name='submit' /></li>
	</form>"; 

	if (isset($_POST['submit'])) {

		$result_id = $connec->query("SELECT * FROM clients.invoice WHERE inv_id = '$_POST[invoice_id_to_upd]'");
		$row = $result_id->fetch();


		echo "<ul>
		<form name='upd' action='form_invoice.php' method='POST' >
		<li>Invoice ID:</li><li><input type='character' name='inv_id_upd' value='$row[inv_id]' /></li>
		<li>Invoice due:</li><li><input type='date' name='inv_due_upd' value='$row[inv_due]' /></li>
		<li>Request ID:</li><li><input type='character' name='inv_req_id_upd' value='$row[inv_req_id]' /></li>
		<li>Client ID:</li><li><input type='character' name='inv_cl_id_upd' value='$row[inv_cl_id]' /></li>
		<li><input type='submit' name='update' /></li></form>
		</ul>";

	}

	// Изменение данных

	if (isset($_POST['update'])) {
		$connec->beginTransaction();
		$result_upd = $connec->exec("UPDATE clients.invoice SET inv_due = '$_POST[inv_due_upd]', inv_req_id = '$_POST[inv_req_id_upd]', inv_cl_id = '$_POST[inv_cl_id_upd]' WHERE inv_id = '$_POST[inv_id_upd]' ");
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