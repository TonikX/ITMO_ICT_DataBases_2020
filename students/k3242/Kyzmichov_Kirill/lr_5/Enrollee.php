<html>
<head>
	<meta charset="utf-8">
	<title>Список абитуриентов</title>
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

	<h3>Список абитуриентов</h3>

	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>

	<form action="" method="post">
		<p><input type="number" name="ID_Enrollee" required placeholder="ID (обязательно)"></P>
		<P><input type="number" name="Passport" placeholder="Паспорт">
		<input type="text" name="Name" placeholder="Имя">
		<input type="number" name="School" placeholder="Школа">
		<input type="text" name="Type" placeholder="Вид студента">
		<input type="text" name="Base" placeholder="База">
		<input type="number" name="Rate" placeholder="Рейтинг"></p>
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать">
			<input type="submit" name="Delete" value="Удалить"></p>
	</form>

	<table align="left" bgcolor="#E6E6FA" frame="border" rules="all" cellpadding="10">
		<tr>
			<td>ID</td>
			<td>Паспорт</td>
			<td>Имя</td>
			<td>Школа</td>
			<td>Вид студента</td>
			<td>База</td>
			<td>Рейтинг</td>
			
		</tr>

			<?php

			$dbuser = 'postgres';
			$dbpass = 'Kriper13';
			$host = 'localhost';
			$dbname='postgres';

			$pdo = new PDO("pgsql:host=$host; port=5433 dbname=$dbname", $dbuser, $dbpass);

			if (isset($_POST['Add'])) { 

				$request = $pdo->prepare('INSERT INTO "students"."enrollee" VALUES (?,?,?,?,?,?,?)');
				$request->execute([$_POST['ID_Enrollee'], $_POST['Passport'], $_POST['Name'], $_POST['School'], $_POST['Type'], $_POST['Base'], $_POST['Rate']]);
				
			} elseif (isset($_POST['Delete'])) {

				$params = array();
				$request = $pdo->prepare('DELETE FROM "students"."enrollee" WHERE "enrollee"."ID_Enrollee"=?');
				array_push($params, "$_POST[ID_Enrollee]");
				$request->execute($params);

			} elseif (isset($_POST['Edit'])) {

				$params = array();
				$req = 'UPDATE "students"."enrollee" SET ';
				if (!empty($_POST['Passport'])) { 
					$req .= "\"Passport\"=? ,";
					array_push($params, "$_POST[Passport]");
				} if (!empty($_POST['Name'])) {
					$req .= "\"Name\"=? ,";
					array_push($params, "$_POST[Name]");
				} if (!empty($_POST['School'])) {
					$req .= "\"School\"=? ,";
					array_push($params, "$_POST[School]");
				} if (!empty($_POST['Type'])) {
					$req .= "\"Type\"=? ,";
					array_push($params, "$_POST[Type]");
				} if (!empty($_POST['Base'])) {
					$req .= "\"Base\"=? ,";
					array_push($params, "$_POST[Base]");
				} if (!empty($_POST['Rate'])) {
					$req .= "\"Rate\"=? ,";
					array_push($params, "$_POST[Rate]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . 'WHERE "enrollee"."ID_Enrollee"=?');
				array_push($params, "$_POST[ID_Enrollee]");
				$request->execute($params); 
			}

			$stmt = $pdo->query('SELECT * FROM "students"."enrollee" ORDER BY "enrollee"."ID_Enrollee"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_Enrollee'] . "</td>";
			echo "<td>" . $row['Passport'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['School'] . "</td>";
			echo "<td>" . $row['Type'] . "</td>";
			echo "<td>" . $row['Base'] . "</td>";
			echo "<td>" . $row['Rate'] . "</td>";
			
			echo "</tr>";
			}
			?>

	</table>

</body>
</html>