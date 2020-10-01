<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8" />
<title>Приём</title>
</head>
<body>

<style type="text/css">
	body {
		zoom: 200%;
		background-color: White;
		background-image: url(https://cdn.galleries.smcloud.net/t/galleries/gf-sHEK-zKRE-HbtT_erytroplazja-queyrata-to-nowotwor-blon-sluzowych-1920x1080-nocrop.jpg);
        text-align:center;
        font-size: 14px;
        table-layout: fixed;
        opacity: 0.9;
		color: black;
	}
	table {
		opacity: 0.8;
		border-radius: 1px;
		border: 1px solid blue
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
		background: blue; 
	}
	</style>
</head>
<body>
	
	<h2>Приём</h2>
	
	<div id="back">
		<form action="index.php">
			<button>На главную</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="id_meet" required placeholder="id приёма">
		<input type="number" name="id_patient" required placeholder="id пациента">
		<input type="number" name="id_service" required placeholder="id услуги">
		<input type="number" name="id_doctor" required placeholder="id врача">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="date" name="date_meet" placeholder="Дата приёма">
		<input type="time" name="time_meet" placeholder="Время приёма">
		<input type="text" name="current_state" placeholder="Текушее состояние"><P>
		<P><input type="bool" name="payment_state" placeholder="Статус оплаты">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="lightblue" frame="border" rules="all">
		<tr>
			<td>id приёма</td>
			<td>id пациента</td>
			<td>id услуги</td>
			<td>id врача</td>
			<td>Дата приёма</td>
			<td>Время приёма</td>
			<td>Текушее состояние</td>
			<td>Статус оплаты</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '';
			$host = 'localhost';
			$dbname= 'hospital';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$sql = "INSERT INTO hospital.meet (id_meet, id_patient, id_service, id_doctor, date_meet, time_meet, current_state, payment_state) VALUES ('$_POST[id_meet]', '$_POST[id_patient]', '$_POST[id_service]', '$_POST[id_doctor]', '$_POST[date_meet]', '$_POST[time_meet]', '$_POST[current_state]', '$_POST[payment_state]')";                                     
				$request = $pdo->prepare($sql);
				$request->execute();
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM hospital.meet WHERE id_meet = '$_POST[id_meet]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$sql = "UPDATE hospital.meet SET \"date_meet\"='$_POST[date_meet]', \"time_meet\"='$_POST[time_meet]', \"current_state\"='$_POST[current_state]', \"payment_state\"='$_POST[payment_state]' WHERE \"id_meet\"='$_POST[id_meet]' AND \"id_patient\"='$_POST[id_patient]' AND \"id_service\"='$_POST[id_service]' AND \"id_doctor\"='$_POST[id_doctor]'";
				$request = $pdo->prepare($sql);
				$request->execute();
			}
			$stmt = $pdo->query('SELECT * FROM hospital."meet"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['id_meet'] . "</td>";
			echo "<td>" . $row['id_patient'] . "</td>";
			echo "<td>" . $row['id_service'] . "</td>";
			echo "<td>" . $row['id_doctor'] . "</td>";
			echo "<td>" . $row['date_meet'] . "</td>";
			echo "<td>" . $row['time_meet'] . "</td>";
			echo "<td>" . $row['current_state'] . "</td>";
			echo "<td>" . $row['payment_state'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
<table>
</body>