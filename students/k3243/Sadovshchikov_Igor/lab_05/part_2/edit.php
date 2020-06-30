<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<hr>
		<a href='/lab_05/part_2/index.php'> Главная </a><br>
		<a href='/lab_05/part_2/add.php'> Добавить </a><br>
		<a href='/lab_05/part_2/edit.php'> Изменить </a><br>
		<a href='/lab_05/part_2/delete.php'> Удалить </a><br>

		<h3>Введите серию и номер слитно</h3>

		<ul>
			<form name="edit" action="edit.php" method="POST" >
				<ul>Серия и номер:</ul><ul><input type="text" name="serial_num"/></ul><br>
				<ul>Имя:</ul><ul><input type="text" name="first_name"/></ul><br>
				<ul>Фамилия:</ul><ul><input type="text" name="last_name"/></ul><br>
				<ul><input type="submit" name="edit" /></ul>
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
	if (isset($_POST["edit"])) {

            $query = "UPDATE $target_table
											SET \"first_name\"='$_POST[first_name]',
											\"last_name\"='$_POST[last_name]'
											WHERE \"serial_num\"='$_POST[serial_num]'";

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
