<!DOCTYPE html>
<html>
<head>
	<title>Управление данными</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/edit.css">
	<script type="text/javascript" src="js/edit.js"></script>

</head>
<body>
<?php 
include 'php/helper.php';

// var_dump($_POST);

$db = pg_connect("host=localhost dbname=Lab password=123456 user=postgres");

if (isset($_POST['save'])) {
	$query = 'update ' . $_POST['edit_table'] . ' set ';

	foreach ($_POST as $key => $value) {
		if ($key != 'save' & $key != 'edit_table') {
			$query .= $key . ' = ';

			if (!is_numeric($value)) {
				$query .= "'" . $value . "'" . ', ';
			} else {
				$query .= $value . ', ';
			}
		}
	}
	$query = substr($query, 0, strlen($query) - 2) . ' where ';
	$query .= array_keys($_POST)[1] . '=' .  array_values($_POST)[1];
	pg_query($db, $query);

} else if (isset($_POST['delete'])) {
	$query = 'delete from ' . $_POST['edit_table'] . ' where ' . array_keys($_POST)[1] . '=' .  array_values($_POST)[1];
	pg_query($db, $query);

} else if (isset($_POST['add'])) {
	$query = 'insert into ' . $_POST['edit_table'] . ' values (';

	foreach ($_POST as $key => $value) {
		if ($key != 'add' & $key != 'edit_table') {
			if (!is_numeric($value)) {
				$query .= "'" . $value . "'" . ', ';
			} else {
				$query .= $value . ', ';
			}
		}
	}
	$query = substr($query, 0, strlen($query) - 2) . ')';
	pg_query($db, $query);
}


pg_close($db);
?>


<h1>Гостиничка</h1>

<?php 

if (isset($_POST['edit_table'])) {
	echo "<h2>" . $_POST['edit_table'] . "</h2>";
	echoEditTable($_POST['edit_table']);

} else {
	echo '<h2>Выберите таблицу</h2>
		<form action="edit.php" method="POST">
			<ul id="tables-selection">
				<li><input type="submit" class="input-submit" name="edit_table" value="Клиент"></li>
				<li><input type="submit" class="input-submit" name="edit_table" value="Номер"></li>
				<li><input type="submit" class="input-submit" name="edit_table" value="Смена"></li>
				<li><input type="submit" class="input-submit" name="edit_table" value="Проживание"></li>
				<li><input type="submit" class="input-submit" name="edit_table" value="Служащий"></li>
				<li><input type="submit" class="input-submit" name="edit_table" value="Тип_номера"></li>
			</ul>
		</form>';

}
?>


</body>
</html>