<!DOCTYPE html>
<head>
<title>Change data: pay order</title>
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
	<h2>Table pay_order</h2>";

	$result = $connec->query("SELECT * FROM clients.pay_order");

	foreach ($result as $row) {

		print $row['pay_ord_id'] . " ";
		print $row['pay_date'] . " ";
		print $row['pay_inv_id'] . " ";
		print $row['pay_req_id'] . " ";
		print $row['pay_cl_id'] . "<br>";

	}
	echo '<p></p>';


	//Добавление данных в таблицу
	
	echo "
	<h2>Enter information regarding pay order to INSERT</h2>
	<form name='insert' action='form_pay_order.php' method='POST' >

	<li>Pay order ID:</li><li><input type='character' name='pay_ord_id' /></li>
	<li>Pay date:</li><li><input type='date' name='pay_date'  /></li>
	<li>Invoice ID:</li><li><input type='character' name='pay_inv_id'/></li>
	<li>Request ID:</li><li><input type='character' name='pay_req_id' /></li>
	<li>Client ID:</li><li><input type='character' name='pay_cl_id' /></li>

	<li><input type='submit' name='new' /></li>";

	if (isset($_POST['new']))
	{
		$connec->beginTransaction();
		$result_new = $connec->exec("INSERT INTO clients.pay_order (pay_ord_id, pay_date, pay_inv_id, pay_req_id, pay_cl_id) VALUES ('$_POST[pay_ord_id]', '$_POST[pay_date]', '$_POST[pay_inv_id]', '$_POST[pay_req_id]', '$_POST[pay_cl_id]')");
		$connec->commit();
		
		if (!$result_new) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Удаление данных из таблицы

	echo "
	<h2>Enter information regarding pay order to DELETE</h2>
	<form name='delete' action='form_pay_order.php' method='POST' >
	<li>Pay order ID to delete:</li><li><input type='character' name='pay_ord_id_delete' /></li>
	<li><input type='submit' name='delete' /></li>
	</form>";

	if (isset($_POST['delete'])) {
		$connec->beginTransaction();
		$result_del = $connec->exec("DELETE FROM clients.pay_order WHERE (pay_ord_id='$_POST[pay_ord_id_delete]')");
		$connec->commit();

		if (!$result_del) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Изменение данных в таблице

	// Ввод id счета на оплату, данные о котором требуется изменить

	echo "
	<h2>Enter information regarding pay order to UPDATE </h2>
	<form name='display' action='form_pay_order.php' method='POST' >
	<li>Pay order ID:</li><li><input type='character' name='pay_ord_id_to_upd' /></li>
	<li><input type='submit' name='submit' /></li>
	</form>"; 

	if (isset($_POST['submit'])) {

		$result_id = $connec->query("SELECT * FROM clients.pay_order WHERE pay_ord_id = '$_POST[pay_ord_id_to_upd]'");
		$row = $result_id->fetch();


		echo "<ul>
		<form name='upd' action='form_pay_order.php' method='POST' >
		<li>Pay order ID:</li><li><input type='character' name='pay_ord_id_upd' value='$row[pay_ord_id]' /></li>
		<li>Pay date:</li><li><input type='date' name='pay_date_upd' value='$row[pay_date]' /></li>
		<li>Invoice ID:</li><li><input type='character' name='pay_inv_id_upd' value='$row[pay_inv_id]' /></li>
		<li>Request ID:</li><li><input type='character' name='pay_req_id_upd' value='$row[pay_req_id]' /></li>
		<li>Client ID:</li><li><input type='character' name='pay_cl_id_upd' value='$row[pay_cl_id]' /></li>
		<li><input type='submit' name='update' /></li></form>
		</ul>";

	}

	// Изменение данных

	if (isset($_POST['update'])) {
		$connec->beginTransaction();
		$result_upd = $connec->exec("UPDATE clients.pay_order SET pay_date = '$_POST[pay_date_upd]', pay_inv_id = '$_POST[pay_inv_id_upd]', pay_req_id = '$_POST[pay_req_id_upd]', pay_cl_id = '$_POST[pay_cl_id_upd]' WHERE pay_ord_id = '$_POST[pay_ord_id_upd]' ");
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