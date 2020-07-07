<html>
<head>
	<meta charset="utf-8">
	<title>Экипаж</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: LightBlue;
		background-image: url(https://avatars.mds.yandex.net/get-pdb/27625/b67ef8bf-9cf7-474f-aec5-9d931e7c0c57/s1200?webp=false);
		background-repeat: round;
        text-align:center;
        font-size: 14px;
        table-layout: fixed;
        opacity: 0.7;
	}
	h2 {
		text-align:center;
		color: Yellow;
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
	
	<h2>Экипаж</h2>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="kod_ekipazha" required placeholder="Код (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="nazvanie" placeholder="Название">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="white" frame="border" rules="all">
		<tr>
			<td>Код</td>
			<td>Название</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = 'postgres';
			$host = 'localhost';
			$dbname= 'airport';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare('INSERT INTO airport."ekipazh" VALUES (?,?)');
				$request->execute([$_POST['kod_ekipazha'], $_POST['nazvanie']]);
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM airport.ekipazh WHERE kod_ekipazha = '$_POST[kod_ekipazha]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$params = array();
				$req = "UPDATE airport.ekipazh SET ";
				if (!empty($_POST['nazvanie'])) { 
					$req .= "\"nazvanie\"=? ,";
					array_push($params, "$_POST[nazvanie]");
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"kod_ekipazha\"=?");
				array_push($params, "$_POST[kod_ekipazha]");
				$request->execute($params); 
			}
			}
			$stmt = $pdo->query('SELECT * FROM airport."ekipazh"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['kod_ekipazha'] . "</td>";
			echo "<td>" . $row['nazvanie'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
	
</body>
</html>
