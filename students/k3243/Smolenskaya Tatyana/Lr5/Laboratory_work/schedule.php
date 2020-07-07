<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8" />
<title>График работы</title>
</head>
<body>

<style type="text/css">
	body {
		zoom: 200%;
		background-color: White;
		background-image: url(https://static.360tv.ru/media/images/articles/cover/e8a4d257-3ab8-4204-9ead-bcffab0bcd34/hospital-484848_1920.jpg);
        text-align:center;
        font-size: 14px;
        table-layout: fixed;
        opacity: 0.9;
		color: black;
	}
	table {
		opacity: 0.8;
		border-radius: 1px;
		border: 1px solid brown;
	}
	h2 {
		text-align:center;
		color: Black;
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
		background: brown; 
	}
	</style>
</head>
<body>
	
	<h2>График работы</h2>
	
	<div id="back">
		<form action="index.php">
			<button>На главную</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="id_schedule" required placeholder="id графика">
		<input type="number" name="id_doctor" required placeholder="id врача">
		<input type="number" name="id_cabinet" required placeholder="Номер кабинета">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="time" name="time_start" placeholder="Время начала">
		<input type="time" name="time_end" placeholder="Время конца">
		<input type="text" name="working_day" placeholder="Рабочий день"><P>
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="white" frame="border" rules="all">
		<tr>
			<td>id приёма</td>
			<td>id врача</td>
			<td>Номер кабинета</td>
			<td>Время начала</td>
			<td>Время конца</td>
			<td>Рабочий день</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '';
			$host = 'localhost';
			$dbname= 'hospital';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$sql = "INSERT INTO hospital.schedule (id_schedule, id_doctor, id_cabinet, time_start, time_end, working_day) VALUES ('$_POST[id_schedule]', '$_POST[id_doctor]', '$_POST[id_cabinet]', '$_POST[time_start]', '$_POST[time_end]', '$_POST[working_day]')";                                     
				$request = $pdo->prepare($sql);
				$request->execute();
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM hospital.schedule WHERE id_schedule = '$_POST[id_schedule]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$sql = "UPDATE hospital.schedule SET \"time_start\"='$_POST[time_start]', \"time_end\"='$_POST[time_end]', \"working_day\"='$_POST[working_day]' WHERE \"id_schedule\"='$_POST[id_schedule]' AND \"id_doctor\"='$_POST[id_doctor]' AND \"id_cabinet\"='$_POST[id_cabinet]'";
				$request = $pdo->prepare($sql);
				$request->execute();
			}
			$stmt = $pdo->query('SELECT * FROM hospital."schedule"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['id_schedule'] . "</td>";
			echo "<td>" . $row['id_doctor'] . "</td>";
			echo "<td>" . $row['id_cabinet'] . "</td>";
			echo "<td>" . $row['time_start'] . "</td>";
			echo "<td>" . $row['time_end'] . "</td>";
			echo "<td>" . $row['working_day'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
</table>
</body>