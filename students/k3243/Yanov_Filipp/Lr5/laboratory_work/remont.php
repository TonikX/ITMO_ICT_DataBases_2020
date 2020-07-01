<html>
<head>
	<meta charset="utf-8">
	<title>Ремонт</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: LightBlue;
		background-image: url(https://finobzor.ru/uploads/posts/2016-11/org_bofn139.jpg);
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
	
	<h2>Ремонт</h2>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="kod_remonta" required placeholder="Код (обязательно)">
		<input type="text" name="pozyvnoi" placeholder="Позывной (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="polomka" placeholder="Поломка">
		<input type="submit" name="Add" value="Добавить">
		<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="Orange" frame="border" rules="all">
		<tr>
			<td>Код ремонта</td>
			<td>Позывной</td>
			<td>Поломка</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = 'postgres';
			$host = 'localhost';
			$dbname= 'airport';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare("INSERT INTO airport.remont VALUES (?,?,?)");
				$request->execute([$_POST['kod_remonta'], $_POST['pozyvnoi'], $_POST['polomka']]);
			
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM airport.remont WHERE kod_remonta = '$_POST[kod_remonta]' AND pozyvnoi = '$_POST[pozyvnoi]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {

				$params = array();
				$req = "UPDATE airport.remont SET ";
				if (!empty($_POST['polomka'])) { 
					$req .= "\"polomka\"=? ,";
					array_push($params, "$_POST[polomka]");
				}
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"kod_remonta\"=? AND \"pozyvnoi\"=?");
				array_push($params, "$_POST[kod_remonta]", "$_POST[pozyvnoi]");
				$request->execute($params); 
				
			}
			
			$stmt = $pdo->query('SELECT * FROM airport."remont"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['kod_remonta'] . "</td>";
			echo "<td>" . $row['pozyvnoi'] . "</td>";
			echo "<td>" . $row['polomka'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
