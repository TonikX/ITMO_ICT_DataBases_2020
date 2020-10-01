<html>
<head>
	<meta charset="utf-8">
	<title>Секретари</title>
	<style type="text/css">
	body {
		background-color:
	}
	h3 {
		text-align:center
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}

	</style>
</head>
<body>

	<h3>Секретари</h3>

	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>

	<form action="" method="post">
		<input type="number" name="ID_Secretary" required placeholder="ID (обязательно)">
		<input type="text" name="Name" placeholder="Имя">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать">
			<input type="submit" name="Delete" value="Удалить"></p>
	</form>

	<table align="left" bgcolor="#E6E6FA" frame="border" rules="all" cellpadding="10">
		<tr>
			<td>ID</td>
			<td>Имя</td>
			
		</tr>

			<?php

			$dbuser = 'postgres';
			$dbpass = 'Kriper13';
			$host = 'localhost';
			$dbname='postgres';

			$pdo = new PDO("pgsql:host=$host; port=5433 dbname=$dbname", $dbuser, $dbpass);

			if (isset($_POST['Add'])) { 

				$request = $pdo->prepare('INSERT INTO "students"."Secretary" VALUES (?,?)');
				$request->execute([$_POST['ID_Secretary'], $_POST['Name']]);
				
			} elseif (isset($_POST['Delete'])) {

				$params = array();
				$request = $pdo->prepare('DELETE FROM "students"."Secretary" WHERE "Secretary"."ID_Secretary"=?');
				array_push($params, "$_POST[ID_Secretary]");
				$request->execute($params);

			} elseif (isset($_POST['Edit'])) {

				$params = array();
				$req = 'UPDATE "students"."Secretary" SET ';
				if (!empty($_POST['Secretary'])) { 
					$req .= "\"Secretary\"=? ,";
					array_push($params, "$_POST[Secretary]");
				} if (!empty($_POST['Name'])) {
					$req .= "\"Name\"=? ,";
					array_push($params, "$_POST[Name]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . 'WHERE "Secretary"."ID_Secretary"=?');
				array_push($params, "$_POST[ID_Secretary]");
				$request->execute($params); 
			}

			$stmt = $pdo->query('SELECT * FROM "students"."Secretary" ORDER BY "Secretary"."ID_Secretary"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_Secretary'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			
			echo "</tr>";
			}
			?>

	</table>

</body>
</html>