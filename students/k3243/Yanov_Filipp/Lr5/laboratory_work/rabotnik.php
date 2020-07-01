<html>
<head>
	<meta charset="utf-8">
	<title>Работник</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: LightBlue;
		background-image: url(http://theflightreviews.com/wp-content/uploads/2016/02/1-23.jpg);
		background-repeat: round;
        text-align:center;
        font-size: 14px;
        table-layout: fixed;
        opacity: 0.7;
	}
	h2 {
		text-align:center;
		color: White;
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}
	button {
		background: LightBlue;
	}
	</style>
</head>
<body>
	
	<h2>Работник</h2>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="kod_rabotnika" required placeholder="Код (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="fio" placeholder="ФИО">
		<input type="number" name="vozrast" placeholder="Возраст">
		<input type="text" name="uroven_obrazovania" placeholder="Уровень образования"><P>
		<P><input type="number" name="stazh_raboty" placeholder="Стаж работы">
		<input type="text" name="pasportnye_dannnye" placeholder="Паспортные данные">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="yellow" frame="border" rules="all">
		<tr>
			<td>Код</td>
			<td>ФИО</td>
			<td>Возраст</td>
			<td>Уровень образования</td>
			<td>Стаж работы</td>
			<td>Паспортные данные</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = 'postgres';
			$host = 'localhost';
			$dbname= 'airport';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare('INSERT INTO airport."rabotnik" VALUES (?,?,?,?,?,?)');
				$request->execute([$_POST['kod_rabotnika'], $_POST['fio'], $_POST['uroven_obrazovania'], $_POST['vozrast'], $_POST['stazh_raboty'], $_POST['pasportnye_dannnye']]);
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM airport.rabotnik WHERE kod_rabotnika = '$_POST[kod_rabotnika]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$params = array();
				$req = "UPDATE airport.rabotnik SET ";
				if (!empty($_POST['fio'])) { 
					$req .= "\"fio\"=? ,";
					array_push($params, "$_POST[fio]");
				} if (!empty($_POST['vozrast'])) {
					$req .= "\"vozrast\"=? ,";
					array_push($params, "$_POST[vozrast]");
				} if (!empty($_POST['uroven_obrazovania'])) {
					$req .= "\"uroven_obrazovania\"=? ,";
					array_push($params, "$_POST[uroven_obrazovania]");
				} if (!empty($_POST['stazh_raboty'])) {
					$req .= "\"stazh_raboty\"=? ,";
					array_push($params, "$_POST[stazh_raboty]");
				} if (!empty($_POST['pasportnye_dannye'])) {
					$req .= "\"pasportnye_dannye\"=? ,";
					array_push($params, "$_POST[pasportnye_dannnye]");
				} 
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"kod_rabotnika\"=?");
				array_push($params, "$_POST[kod_rabotnika]");
				$request->execute($params); 
			}
			
			$stmt = $pdo->query('SELECT * FROM airport."rabotnik"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['kod_rabotnika'] . "</td>";
			echo "<td>" . $row['fio'] . "</td>";
			echo "<td>" . $row['vozrast'] . "</td>";
			echo "<td>" . $row['uroven_obrazovania'] . "</td>";
			echo "<td>" . $row['stazh_raboty'] . "</td>";
			echo "<td>" . $row['pasportnye_dannye'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
