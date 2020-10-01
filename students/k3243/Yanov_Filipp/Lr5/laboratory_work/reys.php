<html>
<head>
	<meta charset="utf-8">
	<title>Рейс</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: LightBlue;
		background-image: url(http://www.irkut.com/upload/information_system_15/4/8/9/item_489/information_items_property_716.jpg);
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
	
	<h2>Рейс</h2>
	
	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>
	
	<form action="" method="post">
		<p><input type="number" name="nomer_reysa" required placeholder="Номер (обязательно)">
		<input type="submit" name="Delete" value="Удалить"></P>
		<P><input type="number" name="rasstoyanie_do_punkta_naznachenia" placeholder="Расстояние до пункта назначения">
		<input type="text" name="punkt_vyleta" placeholder="Пункт вылета">
		<input type="text" name="punkt_prileta" placeholder="Пункт прилёта">
		<input type="number" name="kod_tranzita" placeholder="Код транзита">
		<p><input type="submit" name="Add" value="Добавить">
			<input type="submit" name="Edit" value="Редактировать"></p>
	</form>
	
	<table align="center" bgcolor="white" frame="border" rules="all">
		<tr>
			<td>Номер рейса</td>
			<td>Расстояние до пункта назначения</td>
			<td>Пункт вылета</td>
			<td>Пункт прилёта</td>
			<td>Код транзита</td>
		</tr>

			<?php
			
			$dbuser = 'postgres';
			$dbpass = 'postgres';
			$host = 'localhost';
			$dbname= 'airport';
			
			$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			
			if (isset($_POST['Add'])){ 

				$request = $pdo->prepare("INSERT INTO airport.reys VALUES (?,?,?,?,?)");
				$request->execute([$_POST['nomer_reysa'], $_POST['rasstoyanie_do_punkta_naznachenia'], $_POST['punkt_vyleta'], $_POST['punkt_prileta'], ($_POST['kod_tranzita']) ? $_POST['kod_tranzita'] : null]);
			
			} elseif (isset($_POST['Delete'])) {
			
				$sql = "DELETE FROM airport.reys WHERE nomer_reysa = '$_POST[nomer_reysa]'";
				$request = $pdo->prepare($sql);
				$request->execute();

			} elseif (isset($_POST['Edit'])) {

				$params = array();
				$req = "UPDATE airport.reys SET ";
				if (!empty($_POST['rasstoyanie_do_punkta_naznachenia'])) { 
					$req .= "\"rasstoyanie_do_punkta_naznachenia\"=? ,";
					array_push($params, "$_POST[rasstoyanie_do_punkta_naznachenia]");
				} if (!empty($_POST['punkt_vyleta'])) {
					$req .= "\"punkt_vyleta\"=? ,";
					array_push($params, "$_POST[punkt_vyleta]");
				} if (!empty($_POST['punkt_prileta'])) {
					$req .= "\"punkt_prileta\"=? ,";
					array_push($params, "$_POST[punkt_prileta]");
				} if (!empty($_POST['kod_tranzita'])) {
					$req .= "\"kod_tranzita\"=? ,";
					array_push($params, "$_POST[kod_tranzita]");
				} 
				$req = substr($req, 0, -1);
				$request = $pdo->prepare($req . "WHERE \"nomer_reysa\"=?");
				array_push($params, "$_POST[nomer_reysa]");
				$request->execute($params); 
			}
			
			$stmt = $pdo->query('SELECT * FROM airport."reys"');
			while ($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['nomer_reysa'] . "</td>";
			echo "<td>" . $row['rasstoyanie_do_punkta_naznachenia'] . "</td>";
			echo "<td>" . $row['punkt_vyleta'] . "</td>";
			echo "<td>" . $row['punkt_prileta'] . "</td>";
			echo "<td>" . $row['kod_tranzita'] . "</td>";
			echo "</tr>";
			}
			?>
		
	</table>
  
</body>
