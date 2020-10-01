<?php
echo"<h1><a href = indexx.php>Школа</a></h1>","<br>";
echo"<h2>Кабинет</h2>";

$dbuser = "postgres";
$dbpass = "3766";
$host = "localhost";
$dbname = "lab3";
$table = '"shkola"."cabinet"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$query = "select * from $table";
$result = pg_fetch_all(pg_query($db, $query));
$status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	if (isset($_POST["Delete"])){
		$query = "delete from $table where \"id_cabinet\"='$_POST[id_cabinet]'";
		$status = "Deleted";
	}

	if (isset($_POST["Add"])){
		$query = "insert into $table values ('$_POST[id_cabinet]',
		'$_POST[cab_floor]',
		'$_POST[cab_number]')";
		$status = "Added";
	}

	if (isset($_POST["Update"])){
		$query = "Update $table set \"cab_floor\"='$_POST[cab_floor]',
		\"cab_number\"='$_POST[cab_number]'
		where \"id_cabinet\"='$_POST[id_cabinet]'";
		$status = "Updated";
	}
	pg_query($query);
	echo "<meta http-equiv='refresh' content='0'>";
}
pg_close($db);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Кабинеты</title>
</head>

<table>
	<thead>
		<tr>
			<th><?php echo implode('</th><th>', array_keys($result[0])); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($result as $row): array_map('htmlentities', $row); ?>
		<tr>
			<td><?php echo implode('</td><td>', $row); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<body>
	<form action="" method="post">
		<label><input name="id_cabinet" placeholder="*****"> ID кабинета </label>
		<button type="submit" name="Delete">Удалить</button>
	</form>

	<form action="" method="post">
		<input name="id_cabinet" size="30" placeholder="*****"> ID кабинета <Br>
		<input name="cab_floor" size="30" placeholder="*****"> Этаж кабинета <Br>
		<input name="cab_number" size="30" placeholder="*****"> Номер кабинета <Br>
		<button type="submit" name="Add">Добавить</button>
		<button type="submit" name="Update">Редактировать</button>
	</form>
	<?php echo $status ?>
</body>
</html>