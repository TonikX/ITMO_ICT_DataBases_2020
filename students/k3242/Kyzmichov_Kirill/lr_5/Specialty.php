<html>
<head>
	<meta charset="utf-8">
	<title>Специальности</title>
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

	<h3>Специальности</h3>

	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>

	<form action="" method="post">
		<input type="number" size="35" name="ID_Specialty" required placeholder="ID_Специальности (обязательно)">
		<input type="number" size="30" name="ID_Faculty" placeholder="ID_Факультета (обязательно)">
		<input type="text" size="10" name="Basis" placeholder="База">
		<input type="text" name="Name" placeholder="Наименование">
		<input type="number" name="Number of places" placeholder="Количество заявок">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать">
			<input type="submit" name="Delete" value="Удалить"></p>
	</form>

	<table align="left" bgcolor="#E6E6FA" frame="border" rules="all" cellpadding="10">
		<tr>
			<td>ID специальности</td>
			<td>ID факультета</td>
			<td>База</td>
			<td>Наименование</td>
			<td>Количество заявок</td>
			
		</tr>

			<?php

			$dbuser = 'postgres';
			$dbpass = 'Kriper13';
			$host = 'localhost';
			$dbname='postgres';

			$pdo = new PDO("pgsql:host=$host; port=5433 dbname=$dbname", $dbuser, $dbpass);

			if (isset($_POST['Add'])) { 

				$request = $pdo->prepare('INSERT INTO "students"."Specialty" VALUES (?,?,?,?,?)');
				$request->execute([$_POST['ID_Specialty'], $_POST['ID_Faculty'], $_POST['Basis'], $_POST['Name'], $_POST['Number_of_places']]);
				
			} elseif (isset($_POST['Delete'])) {

				$params = array();
				$request = $pdo->prepare('DELETE FROM "students"."Specialty" WHERE "Specialty"."ID_Specialty"=?');
				array_push($params, "$_POST[ID_Specialty]");
				$request->execute($params);

			} elseif (isset($_POST['Edit'])) {

				$params = array();
				$req = 'UPDATE "students"."Specialty" SET ';
				if (!empty($_POST['ID_Specialty'])) { 
					$req .= "\"ID_Specialty\"=? ,";
					array_push($params, "$_POST[ID_Specialty]");
				} if (!empty($_POST['ID_Faculty'])) {
					$req .= "\"ID_Faculty\"=? ,";
					array_push($params, "$_POST[ID_Faculty]");
				} if (!empty($_POST['Basis'])) {
					$req .= "\"Basis\"=? ,";
					array_push($params, "$_POST[Basis]");
				} if (!empty($_POST['Name'])) {
					$req .= "\"Name\"=? ,";
					array_push($params, "$_POST[Name]");
				} if (!empty($_POST['Number of places'])) {
					$req .= "\"Number of places\"=? ,";
					array_push($params, "$_POST[Number_of_places]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . 'WHERE "Specialty"."ID_Specialty"=?');
				array_push($params, "$_POST[ID_Specialty]");
				$request->execute($params); 
			}

			$stmt = $pdo->query('SELECT * FROM "students"."Specialty" ORDER BY "Specialty"."ID_Specialty"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_Specialty'] . "</td>";
			echo "<td>" . $row['ID_Faculty'] . "</td>";
			echo "<td>" . $row['Basis'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['Number_of_places'] . "</td>";

			echo "</tr>";
			}
			?>

	</table>

</body>
</html>