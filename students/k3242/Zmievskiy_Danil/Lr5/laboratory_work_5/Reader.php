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
	
	<h3>Читатели</h3>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	<form action="" method="post">
		<p><input type="number" name="ID_reader" required placeholder="ID (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="Name" placeholder="ФИО">
		<input type="number" name="Passport_number" placeholder="Номер паспорта">
		<input type="number" name="Reader_card_number" placeholder="Номер ч/б">
		<input type="date" name="Date_of_birth" placeholder="Дата рождения"></p>
		<P><input type="text" name="Address" placeholder="Адрес">
		<input type="tel" name="Phone_number" placeholder="Номер телефона">
		<input type="text" name="Education" placeholder="Образование">
		<input type="text" size="25" name="Academic_degree" placeholder="Научная степень (Есть/Нет)"></p>
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="#FFF8DC" frame="border" rules="all">
		<tr>
			<td>ID</td>
			<td>ФИО</td>
			<td>Номер паспорта</td>
			<td>Номер ч/б</td>
			<td>Дата рождения</td>
			<td>Адрес</td>
			<td>Номер телефона</td>
			<td>Образование</td>
			<td>Научная степень</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '135790';
			$host = 'localhost';
			$dbname= 'Library';

			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare("INSERT INTO \"Reader\" VALUES (?,?,?,?,?,?,?,?,?)");
				if ($_POST['Academic_degree'] == 'Есть') {
					$_POST['Academic_degree'] = 1;
				} else {
					$_POST['Academic_degree'] = 0;
				}
				$request->execute([$_POST['ID_reader'], $_POST['Name'], $_POST['Passport_number'], $_POST['Reader_card_number'], $_POST['Date_of_birth'], $_POST['Address'], $_POST['Phone_number'], $_POST['Education'], $_POST['Academic_degree']]);
			
			} elseif (isset($_POST['Delete'])) {
				
				$request = $pdo->prepare("DELETE FROM \"Reader\" WHERE \"ID_reader\" = ?");
				$request->execute([$_POST['ID_reader']]);
				
			} elseif (isset($_POST['Edit'])) {
					
				$params = array();
				$req = "UPDATE \"Reader\" SET ";
				if (!empty($_POST['Name'])) { 
					$req .= "\"Name\"=? ,";
					array_push($params, "$_POST[Name]");
				} if (!empty($_POST['Passport_number'])) {
					$req .= "\"Passport_number\"=? ,";
					array_push($params, "$_POST[Passport_number]");
				} if (!empty($_POST['Reader_card_number'])) {
					$req .= "\"Reader_card_number\"=? ,";
					array_push($params, "$_POST[Reader_card_number]");
				} if (!empty($_POST['Date_of_birth'])) {
					$req .= "\"Date_of_birth\"=? ,";
					array_push($params, "$_POST[Date_of_birth]");
				} if (!empty($_POST['Address'])) {
					$req .= "\"Address\"=? ,";
					array_push($params, "$_POST[Address]");
				} if (!empty($_POST['Phone_number'])) {
					$req .= "\"Phone_number\"=? ,";
					array_push($params, "$_POST[Phone_number]");
				} if (!empty($_POST['Education'])) {
					$req .= "\"Education\"=? ,";
					array_push($params, "$_POST[Education]");
				} if (!empty($_POST['Academic_degree'])) {
					if ($_POST['Academic_degree'] == 'Есть') {
					$_POST['Academic_degree'] = 1;
					} else {
					$_POST['Academic_degree'] = 0;
					}
					$req .= "\"Academic_degree\"=? ,";
					array_push($params, "$_POST[Academic_degree]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"ID_reader\"=?");
				array_push($params, "$_POST[ID_reader]");
				$request->execute($params); 
			}
			
			$stmt = $pdo->query('SELECT * FROM "Reader"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_reader'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['Passport_number'] . "</td>";
			echo "<td>" . $row['Reader_card_number'] . "</td>";
			echo "<td>" . $row['Date_of_birth'] . "</td>";
			echo "<td>" . $row['Address'] . "</td>";
			echo "<td>" . $row['Phone_number'] . "</td>";
			echo "<td>" . $row['Education'] . "</td>";
			echo ($row['Academic_degree']) ? "<td>Есть</td>" : "<td>Нет</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
</html>