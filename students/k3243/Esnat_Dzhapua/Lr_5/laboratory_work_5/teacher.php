<?php
echo"<h1><a href = indexx.php>Школа</a></h1>","<br>";
echo"<h2>Предмет</h2>";

$dbuser = "postgres";
$dbpass = "3766";
$host = "localhost";
$dbname = "lab3";
$table = '"shkola"."teacher"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$query = "select * from $table";
$result = pg_fetch_all(pg_query($db, $query));
$status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	if (isset($_POST["Delete"])){
		$query = "delete from $table where \"id_teacher\"='$_POST[id_teacher]'";
		$status = "Deleted";
	}

	if (isset($_POST["Add"])){
		$query = "insert into $table values ('$_POST[id_teacher]',
		'$_POST[firstname]',
		'$_POST[lastname]',
		'$_POST[id_cabinet]')";
		$status = "Added";
	}

	if (isset($_POST["Update"])){
		$query = "Update $table set \"firstname\"='$_POST[firstname]',
		\"lastname\"='$_POST[lastname]',
		\"id_cabinet\"='$_POST[id_cabinet]'
		where \"id_teacher\"='$_POST[id_teacher]'";
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
	<title>Учитель</title>
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
		<label><input name="id_teacher" placeholder="***">ID учителя</label>
		<button type="submit" name="Delete">Удалить</button>
	</form>

	<form action="" method="post">
		<input name="id_teacher" size="30" placeholder="***">ID учителя <br>
		<input name="firstname" size="30" placeholder="***">Имя <br>
		<input name="lastname" size="30" placeholder="***">Фамилия <br>
		<input name="id_cabinet" size="30" placeholder="***">ID кабинета <br>
		<button type="submit" name="Add">Добавить</button>
		<button type="submit" name="Update">Редактировать</button>
	</form>
	<?php echo $status ?>
</body>
</html>