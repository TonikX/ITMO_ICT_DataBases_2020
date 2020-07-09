<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8" />
<title>Прейскурант</title>
</head>
<body>

<style type="text/css">
	body {
		zoom: 200%;
		background-color: White;
		background-image: url(https://sorokainfo.com/_nw/143/71750339.jpg);
        text-align:center;
        font-size: 14px;
        table-layout: fixed;
        opacity: 0.9;
		color: White;
	}
	table {
		opacity: 1;
		border-radius: 1px;
		border: 1px solid blue;
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
		color: White; 
		background: lightblue; 
		padding: 5px; 
		border-radius: 5px;
		border: 2px solid blue;
	} 
	button:hover { 
		background: blue; 
	}
	</style>
</head>
<body>
	
	<h2>Прейскурант</h2>
	
	<div id="back">
		<form action="index.php">
			<button>На главную</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="id_service" required placeholder="id">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="name_service" placeholder="Название">
		<input type="number" name="price_service" placeholder="Стоимость">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="LightBlue" frame="border" rules="all">
		<tr>
			<td>Код</td>
			<td>Название</td>
			<td>Стоимость</td>
		</tr>


			<?php
			
			$dbuser = 'postgres';
			$dbpass = '';
			$host = 'localhost';
			$dbname= 'hospital';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$sql = "INSERT INTO hospital.pricelist (id_service, name_service, price_service) VALUES ('$_POST[id_service]', '$_POST[name_service]', '$_POST[price_service]')";
				$request = $pdo->prepare($sql);
				$request->execute();
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM hospital.pricelist WHERE id_service = '$_POST[id_service]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$sql = "UPDATE hospital.pricelist SET \"name_service\"='$_POST[name_service]', \"price_service\"='$_POST[price_service]' WHERE \"id_service\"='$_POST[id_service]'";
				$request = $pdo->prepare($sql);
				$request->execute();
			}
			$stmt = $pdo->query('SELECT * FROM hospital."pricelist"');
				while ($row = $stmt->fetch()) {
					echo "<tr>";
					echo "<td>" . $row['id_service'] . "</td>";
					echo "<td>" . $row['name_service'] . "</td>";
					echo "<td>" . $row['price_service'] . "</td>";
					echo "</tr>";
				}
			?>
		
	</table>
</table>
<body>