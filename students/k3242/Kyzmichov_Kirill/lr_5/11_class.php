<html>
<head>
	<meta charset="utf-8">
	<title>11-e классы</title>
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

	<h3>11-е классы</h3>

	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>

	<form action="" method="post">
		<p><input type="number" name="ID_Enrollee" required placeholder="ID (обязательно)"></P>
		<P><input type="number" name="Points_1" placeholder="Баллы 1">
		<input type="number" name="Points_2" placeholder="Баллы 2">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать">
			<input type="submit" name="Delete" value="Удалить"></p>
	</form>

	<table align="left" bgcolor="#E6E6FA" frame="border" rules="all" cellpadding="10">
		<tr>
			<td>ID</td>
			<td>Баллы 1</td>
			<td>Баллы 2</td>
			
		</tr>

			<?php

			$dbuser = 'postgres';
			$dbpass = 'Kriper13';
			$host = 'localhost';
			$dbname='postgres';

			$pdo = new PDO("pgsql:host=$host; port=5433 dbname=$dbname", $dbuser, $dbpass);

			if (isset($_POST['Add'])) { 

				$request = $pdo->prepare('INSERT INTO "students"."11_grade" VALUES (?,?,?)');
				$request->execute([$_POST['ID_Enrollee'], $_POST['Points_1'], $_POST['Points_2']]);
				
			} elseif (isset($_POST['Delete'])) {

				$params = array();
				$request = $pdo->prepare('DELETE FROM "students"."11_grade" WHERE "11_grade"."ID_Enrollee"=?');
				array_push($params, "$_POST[ID_Enrollee]");
				$request->execute($params);

			} elseif (isset($_POST['Edit'])) {

				$params = array();
				$req = 'UPDATE "students"."11_grade" SET ';
				if (!empty($_POST['Points_1'])) { 
					$req .= "\"Points_1\"=? ,";
					array_push($params, "$_POST[Points_1]");
				} if (!empty($_POST['Points_2'])) {
					$req .= "\"Points_2\"=? ,";
					array_push($params, "$_POST[Points_2]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . 'WHERE "11_grade"."ID_Enrollee"=?');
				array_push($params, "$_POST[ID_Enrollee]");
				$request->execute($params); 
			}

			$stmt = $pdo->query('SELECT * FROM "students"."11_grade" ORDER BY "11_grade"."ID_Enrollee"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_Enrollee'] . "</td>";
			echo "<td>" . $row['Points_1'] . "</td>";
			echo "<td>" . $row['Points_2'] . "</td>";
			
			echo "</tr>";
			}
			?>

	</table>

</body>
</html>