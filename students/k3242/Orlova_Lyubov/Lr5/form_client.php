<!DOCTYPE html>
<head>
<title>Change data: clients</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<style>
li {listt-style: none;}
</style>
</head>
<body>
</body>
</html>
<?php
error_reporting(1);
try {

	$host = "localhost";
	$dbname = "Advertizing_Agency_Lych";
	$dbuser = "postgres";
	$dbpass = "mrorl";
	$connec = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
	$connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Вывод Таблицы

	echo "
	<h2>Table clients</h2>";

	$result = $connec->query("SELECT * FROM clients.client");

	foreach ($result as $row) {

			print $row['client_id'] . " ";
			print $row['legal_ent'] . " ";
			print $row['contact_pers'] . " ";
			print $row['phone_num'] . " ";
			print $row['mail'] . " ";
			print $row['bank_det'] . "<br>";
		}
		echo '<p></p>';

	//Добавление данных в таблицу
	
	echo "
	<h2>Enter information regarding client to INSERT</h2>
	<form name='insert' action='form_client.php' method='POST' >
	<li>Client ID:</li><li><input type='character' name='client_id' /></li>
	<li>Legal Entity:</li><li><input type='character varying' name='legal_ent' /></li>
	<li>Contact Person:</li><li><input type='character varying' name='contact_pers'/></li>
	<li>Phone Number:</li><li><input type='character varying' name='phone_num' /></li>
	<li>Mail:</li><li><input type='character varying' name='mail' /></li>
	<li>Bank details:</li><li><input type='character varying' name='bank_det' /></li>
	<li><input type='submit' name='new' /></li>";
	if (isset($_POST['new']))
	{
		$connec->beginTransaction();
		$result_new = $connec->exec("INSERT INTO clients.client (client_id, legal_ent, contact_pers, phone_num, mail, bank_det) VALUES ('$_POST[client_id]', '$_POST[legal_ent]', '$_POST[contact_pers]', '$_POST[phone_num]', '$_POST[mail]', '$_POST[bank_det]')");
		$connec->commit();
		
		if (!$result_new) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Удаление данных из таблицы

	echo "
	<h2>Enter information regarding client to DELETE</h2>
	<form name='delete' action='form_client.php' method='POST' >
	<li>Client ID to delete:</li><li><input type='character' name='client_id_delete' /></li>
	<li><input type='submit' name='delete' /></li>
	</form>";

	if (isset($_POST['delete'])) {
		$connec->beginTransaction();
		$result_del = $connec->exec("DELETE FROM clients.client WHERE (client_id='$_POST[client_id_delete]')");
		$connec->commit();

		if (!$result_del) {
		echo "<p>Update failed!!</p>";
		} else {
		echo "<p>Update successfull;</p>";
		}
	}


	//Изменение данных в таблице

	// Ввод id пользователя, данные о котором требуется изменить

	echo "
	<h2>Enter information regarding client to UPDATE </h2>
	<form name='display' action='form_client.php' method='POST' >
	<li>Client ID:</li><li><input type='character' name='client_id_to_upd' /></li>
	<li><input type='submit' name='submit' /></li>
	</form>"; 

	if (isset($_POST['submit'])) {

		$result_id = $connec->query("SELECT * FROM clients.client WHERE client_id = '$_POST[client_id_to_upd]'");
		$row = $result_id->fetch();


		echo "<ul>
		<form name='upd' action='form_client.php' method='POST' >
		<li>Client ID:</li><li><input type='character' name='client_id_upd' value='$row[client_id]' /></li>
		<li>Legal Entity:</li><li><input type='character varying' name='legal_ent_upd' value='$row[legal_ent]' /></li>
		<li>Contact Person:</li><li><input type='character varying' name='contact_pers_upd' value='$row[contact_pers]' /></li>
		<li>Phone Number:</li><li><input type='character varying' name='phone_num_upd' value='$row[phone_num]' /></li>
		<li>Mail:</li><li><input type='character varying' name='mail_upd' value='$row[mail]' /></li>
		<li>Bank details:</li><li><input type='character varying' name='bank_det_upd' value='$row[bank_det]' /></li>
		<li><input type='submit' name='update' /></li></form>
		</ul>";

	}

	// Изменение данных

	if (isset($_POST['update'])) {
		$connec->beginTransaction();
		$result_upd = $connec->exec("UPDATE clients.client SET legal_ent = '$_POST[legal_ent_upd]', contact_pers = '$_POST[contact_pers_upd]', phone_num = '$_POST[phone_num_upd]', mail = '$_POST[mail_upd]', bank_det = '$_POST[bank_det_upd]' WHERE client_id = '$_POST[client_id_upd]' ");
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
