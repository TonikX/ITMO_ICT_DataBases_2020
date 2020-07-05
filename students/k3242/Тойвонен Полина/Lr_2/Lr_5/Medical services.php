<DOCTYPE html>
<html lang="en">
<head>
	<meta chatset = "utf-8">
	<title>Medical services</title>
	<style type="text/css">
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

	</header>
<?php
	$data = null;
	$status = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
       	$dbuser = 'postgres';
       	$dbpassword = 'PastSimple10';
        $host = 'localhost';		
        $dbname = 'Med_clinic';     

		$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );

		if (isset($_POST["delete"])) {
            $sq = 'DELETE from public."medical_services" where "id_service" = :id_service';
            $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_service' => $_POST["id_service"]));
            $data = $sth->fetchAll();
			if(count($data) > 0){
               	$status = "Запись удалена";
			}
			else{
                $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
           	} 
       	} 
       	if (isset($_POST["find"])) {
            $sq = 'SELECT * from public."medical_services" where "id_service" = :id_service';
            $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_service' => $_POST["id_service"]));
            $data = $sth->fetchAll();
			print_r ($sth->errorInfo()[2]);
            if(count($data) > 0){
                $status = "Запись найдена";
            }
			else{
               	$status = "Запись не найдена";
            }
        }
		if (isset($_POST["edit"])) {
            if($_POST["id_service"] != ""){
                $sq = 'SELECT * from public."medical_services" where "id_service" = :id_service';
                $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_service' => intval($_POST["id_service"])));
                $data = $sth->fetchAll();
            }
        if($_POST["id_service"] != "" && count($data) > 0){
            $sq = 'UPDATE public."medical_services" SET "service_cost" = :service_cost, "the_name_of_the_service" = :the_name_of_the_service where "id_service" = :id_service';
           	$sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_service' => $_POST["id_service"],':service_cost' => $_POST["service_cost"],':the_name_of_the_service' => $_POST["the_name_of_the_service"]));
           	$data = $sth->fetchAll();
            print_r ($sth->errorInfo()[2]);
            	$status = "Запись изменена";
            	$data = null;

        	}else  {
				$status = "Что-то пошло не так. Введите id";
			}	
		}   

		if (isset($_POST["add"])){
        	$sq = 'INSERT INTO public."medical_services"("id_service", "service_cost", "the_name_of_the_service") VALUES (:id_service, :service_cost, :the_name_of_the_service)';
        	$sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        	$sth->execute(array(':id_service' => $_POST["id_service"], ':service_cost' => $_POST["service_cost"],':the_name_of_the_service' => $_POST["the_name_of_the_service"]));
       	 	$data = $sth->fetchAll();
        	print_r ($sth->errorInfo()[2]);
        	$status = "Запись добавлена";
        	$data = null;
        }
	}   
?>

	<h1>Services</h1>

<form action="" method="post">
	<input name="id_service" placeholder="ID ..." value="<?php echo '' ?>"></br>
	<button type="submit" name="find">Find</button>
	<button type="submit" name="delete">Delete</button>
</form>
<?php echo $status ?>
</br>
<form action="" method="post">
	<input name="id_service" size="40" placeholder="ID ..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_service']?>"> <-ID</br>
	<input name="service_cost" size="40" placeholder="Service cost..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['service_cost']?>"> <-FIO</br>
	<input name="the_name_of_the_service" size="40" placeholder="Service's name..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['the_name_of_the_service']?>"> <-Service's name</br>
	<button type="sumbit" name="add">Add</button>
	<button type="submit" name="edit">Edit</button>
</form>
</body>
</html>
