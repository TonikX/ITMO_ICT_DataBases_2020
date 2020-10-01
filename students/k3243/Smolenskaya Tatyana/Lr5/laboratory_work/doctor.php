<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8" />
<title>Врач</title>
</head>
<body>

<style type="text/css">
	body {
		zoom: 200%;
		background-color: White;
		background-image: url(https://avatars.mds.yandex.net/get-zen_doc/27036/pub_5bcdb8ae8789e500a91b0821_5bcdbbd9cb915300a9d9b3c8/scale_1200);
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
	
	<h2>Врач</h2>
	
	<div id="back">
		<form action="index.php">
			<button>На главную</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="id_doctor" required placeholder="id">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="fio_doctor" placeholder="ФИО врача">
		<input type="text" name="specialty" placeholder="Специальность">
		<input type="text" name="education" placeholder="Образование"><P>
		<P><input type="text" name="gender" placeholder="Пол">
		<input type="date" name="birthday_date_doctor" placeholder="Дата рождения врача">
		<input type="text" name="contract" placeholder="Контракт">
		<input type="text" name="work_time_in_clinic" placeholder="Время работы в клинике">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="lightblue" frame="border" rules="all">
		<tr>
			<td>id</td>
			<td>ФИО врача</td>
			<td>Специальность</td>
			<td>Образование</td>
			<td>Пол</td>
			<td>Д.р. врача</td>
			<td>Контракт</td>
			<td>Стаж работы</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = '';
			$host = 'localhost';
			$dbname= 'hospital';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$sql = "INSERT INTO hospital.doctor (id_doctor, fio_doctor, specialty, education, gender, birthday_date_doctor, contract, work_time_in_clinic) VALUES ('$_POST[id_doctor]', '$_POST[fio_doctor]', '$_POST[specialty]', '$_POST[education]', '$_POST[gender]', '$_POST[birthday_date_doctor]', '$_POST[contract]', '$_POST[work_time_in_clinic]')";                                     
				$request = $pdo->prepare($sql);
				$request->execute();
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM hospital.doctor WHERE id_doctor = '$_POST[id_doctor]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$sql = "UPDATE hospital.doctor SET \"fio_doctor\"='$_POST[fio_doctor]', \"specialty\"='$_POST[specialty]', \"education\"='$_POST[education]', \"gender\"='$_POST[gender]', \"birthday_date_doctor\"='$_POST[birthday_date_doctor]', \"contract\"='$_POST[contract]', \"work_time_in_clinic\"='$_POST[work_time_in_clinic]' WHERE \"id_doctor\"='$_POST[id_doctor]'";
				$request = $pdo->prepare($sql);
				$request->execute();
			}
			$stmt = $pdo->query('SELECT * FROM hospital."doctor"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['id_doctor'] . "</td>";
			echo "<td>" . $row['fio_doctor'] . "</td>";
			echo "<td>" . $row['specialty'] . "</td>";
			echo "<td>" . $row['education'] . "</td>";
			echo "<td>" . $row['gender'] . "</td>";
			echo "<td>" . $row['birthday_date_doctor'] . "</td>";
			echo "<td>" . $row['contract'] . "</td>";
			echo "<td>" . $row['work_time_in_clinic'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
<table>
</body>