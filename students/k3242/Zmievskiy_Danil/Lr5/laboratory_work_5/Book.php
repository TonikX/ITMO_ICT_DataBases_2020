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
	
	<h3>Книги</h3>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="ID_book" required placeholder="ID (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="Name" placeholder="Название">
		<input type="text" name="Author" placeholder="Автор">
		<input type="text" name="Publishing_house" placeholder="Издательство">
		<input type="date" name="Year_of_publishing" placeholder="Дата публикации"></p>
		<P><input type="text" name="Section" placeholder="Секция">
		<input type="number" name="Cipher" placeholder="Шифр"></p>
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="#FFF8DC" frame="border" rules="all">
		<tr>
			<td>ID</td>
			<td>Название</td>
			<td>Автор</td>
			<td>Издательство</td>
			<td>Дата публикации</td>
			<td>Секция</td>
			<td>Шифр</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '135790';
			$host = 'localhost';
			$dbname= 'Library';

			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare("INSERT INTO \"Book\" VALUES (?,?,?,?,?,?,?)");
				$request->execute([$_POST['ID_book'], $_POST['Name'], $_POST['Author'], $_POST['Publishing_house'], $_POST['Year_of_publishing'], $_POST['Section'], $_POST['Cipher']]);
			
			} elseif (isset($_POST['Delete'])) {
				
				$request = $pdo->prepare("DELETE FROM \"Book\" WHERE \"ID_book\" = '$_POST[ID_book]'");
				$request->execute();
				
			} elseif (isset($_POST['Edit'])) {
					
				$params = array();
				$req = "UPDATE \"Book\" SET ";
				if (!empty($_POST['Name'])) { 
					$req .= "\"Name\"=? ,";
					array_push($params, "$_POST[Name]");
				} if (!empty($_POST['Author'])) {
					$req .= "\"Author\"=? ,";
					array_push($params, "$_POST[Author]");
				} if (!empty($_POST['Publishing_house'])) {
					$req .= "\"Publishing_house\"=? ,";
					array_push($params, "$_POST[Publishing_house]");
				} if (!empty($_POST['Year_of_publishing'])) {
					$req .= "\"Year_of_publishing\"=? ,";
					array_push($params, "$_POST[Year_of_publishing]");
				} if (!empty($_POST['Section'])) {
					$req .= "\"Section\"=? ,";
					array_push($params, "$_POST[Section]");
				} if (!empty($_POST['Cipher'])) {
					$req .= "\"Cipher\"=? ,";
					array_push($params, "$_POST[Cipher]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"ID_book\"=?");
				array_push($params, "$_POST[ID_book]");
				$request->execute($params); 
			}
			
			$stmt = $pdo->query('SELECT * FROM "Book"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['ID_book'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['Author'] . "</td>";
			echo "<td>" . $row['Publishing_house'] . "</td>";
			echo "<td>" . $row['Year_of_publishing'] . "</td>";
			echo "<td>" . $row['Section'] . "</td>";
			echo "<td>" . $row['Cipher'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
</html>