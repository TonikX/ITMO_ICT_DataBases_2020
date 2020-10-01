<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<h2>Добавляем пациента</h2>
		<ul>
			<form name="add" action="add.php" method="POST" >
				<ul>ID: </ul><ul><input type="text" name="patient_id"/></ul>
					<br>
				<ul>Имя: </ul><ul><input type="text" name="patient_name"/></ul>
					<br>
				<ul>Пол: </ul><ul><input type="text" name="patient_sex"/></ul>
					<br>
				<ul>Адрес:  </ul><ul><input type="text" name="patient_adress"/></ul>
					<br>
				<ul>Дата рождения: </ul><ul><input type="text" name="patient_bd"/></ul>
					<br>
				<ul>Контакты: </ul><ul><input type="text" name="patient_contacts"/></ul>
					<br>
				<ul><input type="submit" name="add" /></ul>
			</form>
		</ul>

	</body>
</html>

<?php

$connect = pg_connect("host=localhost port=5432 dbname=ClinicDB user=postgres password=1708");
$add_to = '"ClinicDB"."MedicalFiles"';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["add"])) {
			$q = "INSERT INTO $add_to VALUES ('$_POST[patient_id]', '$_POST[patient_name]', '$_POST[patient_sex]', '$_POST[patient_adress]', '$_POST[patient_bd]', '$_POST[patient_contacts]')";
        $cur = pg_query($connect, $q);
		$all = pg_fetch_all($cur);
		pg_close($connect);
  }
}

$connect = pg_connect("host=localhost port=5432 dbname=ClinicDB user=postgres password=1708");
$q = "SELECT * FROM $add_to";
$cur = pg_query($connect, $q);
$all = pg_fetch_all($cur);
foreach ($all as $value) {
	foreach ($value as $key => $value) {
		echo "$key: $value <br/>";
	}
	echo "<br>";

};
?>