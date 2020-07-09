<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8" />
<title>Пациент</title>
</head>
<body>

<style type="text/css">
	body {
		zoom: 200%;
		background-color: White;
		background-image: url(https://ulpressa.ru/wp-content/uploads/old/7-%E2%80%94-%D0%BA%D0%BE%D0%BF%D0%B8%D1%8F-356.jpg);
        text-align:center;
        font-size: 14px;
        table-layout: fixed;
        opacity: 0.9;
		color: black;
	}
	table {
		opacity: 0.8;
		border-radius: 1px;
		border: 1px solid green;
	}
	h2 {
		text-align:center;
		color: black;
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}
	button {
		color: White; 
		background: lightgreen; 
		padding: 5px; 
		border-radius: 5px;
		border: 2px solid blue;
	} 
	button:hover { 
		background: green; 
	}
	</style>
</head>
<body>
	
	<h2>Пациент</h2>
	
	<div id="back">
		<form action="index.php">
			<button>На главную</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="id_patient" required placeholder="id">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="fio_patient" placeholder="ФИО пациента">
		<input type="date" name="birthday_date_patient" placeholder="Дата рождения пациента">
		<input type="text" name="phone_patient" placeholder="Телефон пациента">
		<input type="text" name="passport_patient" placeholder="Паспортные данные">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
<table>	
	<table align="center" bgcolor="lightgreen" frame="border" rules="all">
		<tr>
			<td>id</td>
			<td>ФИО пациента</td>
			<td>Дата рождения пациента</td>
			<td>Телефон пациента</td>
			<td>Паспортные данные</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '';
			$host = 'localhost';
			$dbname= 'hospital';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$sql = "INSERT INTO hospital.patient (id_patient, fio_patient, birthday_date_patient, phone_patient, passport_patient) VALUES ('$_POST[id_patient]', '$_POST[fio_patient]', '$_POST[birthday_date_patient]', '$_POST[phone_patient]', '$_POST[passport_patient]')";                                     
				$request = $pdo->prepare($sql);
				$request->execute();
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM hospital.patient WHERE id_patient = '$_POST[id_patient]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$sql = "UPDATE hospital.patient SET \"fio_patient\"='$_POST[fio_patient]', \"birthday_date_patient\"='$_POST[birthday_date_patient]', \"phone_patient\"='$_POST[phone_patient]', \"passport_patient\"='$_POST[passport_patient]' WHERE \"id_patient\"='$_POST[id_patient]'";
				$request = $pdo->prepare($sql);
				$request->execute();
			}
			$stmt = $pdo->query('SELECT * FROM hospital."patient"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['id_patient'] . "</td>";
			echo "<td>" . $row['fio_patient'] . "</td>";
			echo "<td>" . $row['birthday_date_patient'] . "</td>";
			echo "<td>" . $row['phone_patient'] . "</td>";
			echo "<td>" . $row['passport_patient'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
<table>
</body>