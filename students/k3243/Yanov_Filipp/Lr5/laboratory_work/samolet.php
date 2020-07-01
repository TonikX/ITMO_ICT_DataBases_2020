<html>
<head>
	<meta charset="utf-8">
	<title>Самолёт</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: LightBlue;
		background-image: url(https://img4.goodfon.ru/original/2560x1652/4/df/samolet-passazhirskii-v-nebe-letit-oblaka-zarevo.jpg);
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
	
	<h2>Самолёт</h2>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="text" name="pozyvnoi" required placeholder="Позывной (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="text" name="tip" placeholder="Тип">
		<input type="number" name="nomer_modeli" placeholder="Номер модели">
		<input type="number" name="chislo_mest" placeholder="Число мест"><P>
		<P><input type="number" name="skorost_poleta" placeholder="Скорость полёта">
		<input type="text" name="aviacompany" placeholder="Авиакомпания">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="lightblue" frame="border" rules="all">
		<tr>
			<td>Позывной</td>
			<td>Тип</td>
			<td>Номер модели</td>
			<td>Число мест</td>
			<td>Скорость полёта</td>
			<td>Авиакомпания</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = 'postgres';
			$host = 'localhost';
			$dbname= 'airport';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare('INSERT INTO airport."samolet" VALUES (?,?,?,?,?,?)');
				$request->execute([$_POST['pozyvnoi'], $_POST['tip'], $_POST['nomer_modeli'], $_POST['chislo_mest'], $_POST['skorost_poleta'], $_POST['aviacompany']]);
				
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM airport.samolet WHERE pozyvnoi = '$_POST[pozyvnoi]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {
					
				$params = array();
				$req = "UPDATE airport.samolet SET ";
				if (!empty($_POST['tip'])) { 
					$req .= "\"tip\"=? ,";
					array_push($params, "$_POST[tip]");
				} if (!empty($_POST['nomer_modeli'])) {
					$req .= "\"nomer_modeli\"=? ,";
					array_push($params, "$_POST[nomer_modeli]");
				} if (!empty($_POST['chislo_mest'])) {
					$req .= "\"chislo_mest\"=? ,";
					array_push($params, "$_POST[chislo_mest]");
				} if (!empty($_POST['skorost_poleta'])) {
					$req .= "\"skorost_poleta\"=? ,";
					array_push($params, "$_POST[skorost_poleta]");
				} if (!empty($_POST['aviacompany'])) {
					$req .= "\"aviacompany\"=? ,";
					array_push($params, "$_POST[aviacompany]");
				} 
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"pozyvnoi\"=?");
				array_push($params, "$_POST[pozyvnoi]");
				$request->execute($params); 
			}
			
			$stmt = $pdo->query('SELECT * FROM airport."samolet"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['pozyvnoi'] . "</td>";
			echo "<td>" . $row['tip'] . "</td>";
			echo "<td>" . $row['nomer_modeli'] . "</td>";
			echo "<td>" . $row['chislo_mest'] . "</td>";
			echo "<td>" . $row['skorost_poleta'] . "</td>";
			echo "<td>" . $row['aviacompany'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
