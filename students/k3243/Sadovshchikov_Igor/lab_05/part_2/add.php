<!DOCTYPE html>
	<head>
		<meta content="text/html" />
	</head>
	<body>
		<hr>
		<a href='/lab_05/part_2/index.php'> Главная </a><br>
		<a href='/lab_05/part_2/add.php'> Добавить </a><br>
		<a href='/lab_05/part_2/edit.php'> Изменить </a><br>
		<a href='/lab_05/part_2/delete.php'> Удалить </a><br>

		<h3>Введите паспортные данные водителя</h3>
		<ul>
			<form name="add" action="add.php" method="POST" >
				<ul>Серия и номер:</ul><ul><input type="text" name="serial_num"/></ul><br>
				<ul>Имя:</ul><ul><input type="text" name="first_name"/></ul><br>
				<ul>Фамилия:</ul><ul><input type="text" name="last_name"/></ul><br>
				<ul>Дата рождения:</ul><ul><input type="text" name="birthday"/></ul><br>
				<ul>Дата выдачи:</ul><ul><input type="text" name="date_issued"/></ul><br>
				<ul>Кем выдан:</ul><ul><input type="text" name="issued_by"/></ul><br>
				<ul>Прописка:</ul><ul><input type="text" name="registration"/></ul><br>
				<ul><input type="submit" name="add" /></ul>
			</form>
		</ul>
		<hr>
	</body>
</html>


<?php
include 'config.php';

$conn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_pass");
$target_table = "passport";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["add"])) {

            $query = "INSERT INTO $target_table
											VALUES ('$_POST[serial_num]',
															'$_POST[first_name]',
															'$_POST[last_name]',
															'$_POST[birthday]',
															'$_POST[date_issued]',
															'$_POST[issued_by]',
															'$_POST[registration]')";

            $cursor = pg_query($conn, $query);
						$all = pg_fetch_all($cursor);
			pg_close($conn);
  }
}


$conn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_pass");

$query = "SELECT * FROM $target_table";

$cursor = pg_query($conn, $query);
$all = pg_fetch_all($cursor);

foreach ($all as $value) {
	echo "--------------------------------<br>";
	foreach ($value as $key => $value) {
		echo "|  $key = $value <br/>";
	}
	echo "--------------------------------<br><br>";
};

?>
