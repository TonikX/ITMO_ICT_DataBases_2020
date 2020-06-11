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
	
	<h3>Выдача книги</h3>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="ID_reader" required placeholder="ID читателя(обязательно)">
		<input type="number" name="ID_instance" required placeholder="ID экземпляра(обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<p><table><tr><td><label>Дата выдачи</label>
						<td><label>Дата возврата</label></td></tr>
		<tr><td><input type="date" name="Date_of_receiving" placeholder="Дата выдачи"></td>
		<td><input type="date" name="Date_of_return" placeholder="Дата возврата"></td></tr></table>
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="#FFF8DC" frame="border" rules="all">
		<tr>
			<td>ID читателя</td>
			<td>ID экземпляра</td>
			<td>Дата выдачи</td>
			<td>Дата возврата</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '135790';
			$host = 'localhost';
			$dbname= 'Library';

			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare("INSERT INTO \"Getting_book\" VALUES (?,?,?,?)");
				$request->execute([$_POST['ID_reader'], $_POST['ID_instance'], $_POST['Date_of_receiving'], ($_POST['Date_of_return']) ? $_POST['Date_of_return'] : null]);
			
			} elseif (isset($_POST['Delete'])) {
				
				$request = $pdo->prepare("DELETE FROM \"Getting_book\" WHERE \"ID_reader\" = ? AND \"ID_instance\" = ?");
				$request->execute([$_POST['ID_reader'], $_POST['ID_instance']]);
				
			} elseif (isset($_POST['Edit'])) {
				 
				$params = array();
				$req = "UPDATE \"Getting_book\" SET ";
				if (!empty($_POST['Date_of_receiving'])) { 
					$req .= "\"Date_of_receiving\"=? ,";
					array_push($params, "$_POST[Date_of_receiving]");
				} if (!empty($_POST['Date_of_return'])) {
					$req .= "\"Date_of_return\"=? ,";
					array_push($params, "$_POST[Date_of_return]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"ID_reader\"=? AND \"ID_instance\"=?");
				array_push($params, "$_POST[ID_reader]", "$_POST[ID_instance]");
				$request->execute($params); 
			}
			
			$stmt = $pdo->query('SELECT * FROM "Getting_book"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_reader'] . "</td>";
			echo "<td>" . $row['ID_instance'] . "</td>";
			echo "<td>" . $row['Date_of_receiving'] . "</td>";
			echo "<td>" . $row['Date_of_return'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
</html>