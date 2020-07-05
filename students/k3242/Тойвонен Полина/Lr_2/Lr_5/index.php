<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Main page</title>
	<style type= "text/css">
	body {
		background: #9bc5c9;
		background-attachment: fixed;
		background-repeat: repeat-x;
		color: #171717;
		font-family: 'Roboto', sans-serif;
		font-size: 20px;
		text-rendering: optimizeLegibility; 
	}
	p {
		float: left;
		font-size: 1.5em;
	}
	p a {
		text-decoration: none;
		text-transform: uppercase;
		color: #171717;
		letter-spacing: 5px; 
		padding-left: 30px;
	}
	ul {
		float: right;
		list-style: none;
	}
	li {
		display: inline-block;
		margin-left: 30px;
		font-size: 1.5em;
	}
	li a {
		text-decoration: none;
		text-transform: uppercase;
		color: #171717;
		letter-spacing: 5px;
	}
	nav {
		background: #d3e5e7;
		height: 70px;
		padding: 35px;
	}

	</style>
</head>

<body>
	<header>
		<nav>
			<p><a href="index.php">Med clinic</a></p>

			<ul>

				<li><a href="Doctors.php">Doctors</a></li>
				<li><a href="Pacients.php">Pacients</a></li>
				<li><a href="Medical services.php">Services</a></li>
				<li><a href="Cabinet.php">Cabinets</a></li>
				<li><a href="Doctors work schedule.php">Doctors work schedule</a></li>

			</ul>
		</nav>
		<div>
			<h1>Main page</h1>
		</div>
		<?php

		$dbuser = 'postgres';
		$dbpass = 'PastSimple10';
		$host = 'localhost';
		$dbname = 'Med_clinic';

		$pdo = new PDO("pgsql:host = $host; dbname=$dbname", $dbuser, $dbpass);


		echo '</br></br>1. Вывод id и ФИО всех врачей, которые учились в Медико-социальном институте, по возрастанию id:</br>';
		$stmt = $pdo->query('SELECT "id_doctor", "fio" FROM public."doctors" WHERE "doctors".education = \'Saint-Petersburg Medico-Social Institute\' ORDER BY "id_doctor"');
		while ($row = $stmt->fetch()) {
			echo '</p></p>ID doctor-</p>', $row['id_doctor'];
			echo '</p></p>FIO-</p>', $row['fio'];
		}
	

		echo '</br></br>2.Вывод информции об оплаченных приемах, где id услуги 3:</br>';
		$stmt = $pdo->query('SELECT * FROM public."appointments" WHERE payment = \'yes\' and id_service = 3');
		while ($row = $stmt->fetch()) {
			echo '</p></p>ID appointment-</p>', $row['id_appointment'];
			echo '</p></p>ID doctor-</p>', $row['id_doctor'];
			echo '</p></p>ID pacient-</p>', $row['id_pacient']; 
			echo '</p></p>ID service-</p>', $row['id_service'];
			echo '</p></p>Date and time-</p>', $row['date_and_time'];
			echo '</p></p>Current state-</p>', $row['current_state'];
			echo '</p></p>Diagnosis-</p>', $row['diagnosis'];
			echo '</p></p>Recommendations-</p>', $row['doctors_recommendation'];
			echo '</p></p>Payment-</p>', $row['payment'];
		}


		echo '</br></br>3.Вывод возраста всех врачей:</br>';
		$stmt = $pdo->query('SELECT id_doctor, fio, age(current_date, "doctors"."date_of_birth") FROM public."doctors"');
		while ($row = $stmt->fetch()) {
			echo '</p></p>ID doctor-</p>', $row['id_doctor'];
			echo '</p></p>FIO-</p>', $row['fio'];
			echo '</p></p>Age-</p>', $row['age'];
		}


		echo '</br></br>4. Вывод информации о пациентах, которые были на приеме 4 августа в час дня: </br>';
		$stmt = $pdo->query('SELECT * FROM public."med_card" WHERE id_pacient = ANY ( SELECT id_pacient FROM public."appointments" WHERE date_and_time = \'04.08.2019 13.00 \')');
		while ($row = $stmt->fetch()) {
			echo '</p></p>ID card-</p>', $row['id_card'];
			echo '</p></p>ID pacient-</p>', $row['id_pacient'];
			echo '</p></p>ID appointment-</p>', $row['id_appointment'];
			echo '</p></p>The history of diseases-</p>', $row['the_history_of_diseases'];
		}



		echo '</br></br>5. Количество неоплаченных приёмов: </br>';
		$stmt = $pdo->query('SELECT COUNT(*) FROM public."appointments" WHERE (payment = \'no\')');
		while ($row = $stmt->fetch()) {
			echo $row['count'];
		}

		?>
	</header>
</body>
</html>
