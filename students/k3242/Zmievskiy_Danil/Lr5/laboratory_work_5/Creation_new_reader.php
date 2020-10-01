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
	
	<h3>Запись нового читателя</h3>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="ID_reader" required placeholder="ID читателя(обязательно)">
		<input type="number" name="ID_room" required placeholder="ID зала(обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<p><table><tr>
					<td><label>Дата записи</label></td>
					<td><label>Дата перерегестрации</label></td>
					<td><label>Дата исключения</label></td></tr>
		<tr><td><input type="date" name="Date_of_creation" placeholder="Дата записи"></td>
		<td><input type="date" name="Date_of_re-registration" placeholder="Дата перерегестрации"></td>
		<td><input type="date" name="Date_of_exclusion" placeholder="Дата исключения"></td></tr></table></p>
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="#FFF8DC" frame="border" rules="all">
		<tr>
			<td>ID читателя</td>
			<td>ID зала</td>
			<td>Дата записи</td>
			<td>Дата перерегестрации</td>
			<td>Дата исключения</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '135790';
			$host = 'localhost';
			$dbname= 'Library';

			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare("INSERT INTO \"Creation_new_reader\" VALUES (?,?,?,?,?)");
				$request->execute([$_POST['ID_reader'], $_POST['ID_room'], $_POST['Date_of_creation'],
									($_POST['Date_of_re-registration']) ? $_POST['Date_of_re-registration'] : null,
									($_POST['Date_of_exclusion']) ? $_POST['Date_of_exclusion'] : null]);
			
			} elseif (isset($_POST['Delete'])) {
				
				$request = $pdo->prepare("DELETE FROM \"Creation_new_reader\" WHERE \"ID_reader\" = ? AND \"ID_room\" = ?");
				$request->execute([$_POST['ID_reader'], $_POST['ID_room']]);
				
			} elseif (isset($_POST['Edit'])) {
				
				$reg = $_POST['Date_of_re-registration'];
				$params = array();
				$req = "UPDATE \"Creation_new_reader\" SET ";
				if (!empty($_POST['Date_of_creation'])) { 
					$req .= "\"Date_of_creation\"=? ,";
					array_push($params, "$_POST[Date_of_creation]");
				} if (!empty($_POST['Date_of_re-registration'])) {
					$req .= "\"Date_of_re-registration\"=? ,";
					array_push($params, "$reg");
				} if (!empty($_POST['Date_of_exclusion'])) {
					$req .= "\"Date_of_exclusion\"=? ,";
					array_push($params, "$_POST[Date_of_exclusion]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"ID_reader\"=? AND \"ID_room\"=?");
				array_push($params, "$_POST[ID_reader]", "$_POST[ID_room]");
				$request->execute($params); 
				
			}
			
			$stmt = $pdo->query('SELECT * FROM "Creation_new_reader"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_reader'] . "</td>";
			echo "<td>" . $row['ID_room'] . "</td>";
			echo "<td>" . $row['Date_of_creation'] . "</td>";
			echo "<td>" . $row['Date_of_re-registration'] . "</td>";
			echo "<td>" . $row['Date_of_exclusion'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
</html>