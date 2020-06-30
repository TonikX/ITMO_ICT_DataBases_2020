<html>
<head>
	<meta charset="utf-8">
	<title>Библиотека</title>
	<style type="text/css">
	body {
		zoom:150%;
		background-color:BurlyWood
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
	
	<h3>Читательский зал</h3>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="ID_room" required placeholder="ID (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<p><input type="number" name="Number" placeholder="Номер">
		<input type="text" name="Name" placeholder="Название">
		<input type="number" name="Capacity" placeholder="Вместимость"></p>
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="#FFF8DC" frame="border" rules="all">
		<tr>
			<td>ID</td>
			<td>Номер</td>
			<td>Название</td>
			<td>Вместимость</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '135790';
			$host = 'localhost';
			$dbname= 'Library';

			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare("INSERT INTO \"Reading_room\" VALUES (?,?,?,?)");
				$request->execute([$_POST['ID_room'], $_POST['Number'], $_POST['Name'], $_POST['Capacity']]);
			
			} elseif (isset($_POST['Delete'])) {
				
				$request = $pdo->prepare("DELETE FROM \"Reading_room\" WHERE \"ID_room\" = ?");
				$request->execute([$_POST['ID_room']]);
				
			} elseif (isset($_POST['Edit'])) {
					
				$params = array();
				$req = "UPDATE \"Reading_room\" SET ";
				if (!empty($_POST['Number'])) { 
					$req .= "\"Number\"=? ,";
					array_push($params, "$_POST[Number]");
				} if (!empty($_POST['Name'])) {
					$req .= "\"Name\"=? ,";
					array_push($params, "$_POST[Name]");
				} if (!empty($_POST['Capacity'])) {
					$req .= "\"Capacity\"=? ,";
					array_push($params, "$_POST[Capacity]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"ID_room\"=?");
				array_push($params, "$_POST[ID_room]");
				$request->execute($params); 
			}
			
			$stmt = $pdo->query('SELECT * FROM "Reading_room"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_room'] . "</td>";
			echo "<td>" . $row['Number'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['Capacity'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
</html>