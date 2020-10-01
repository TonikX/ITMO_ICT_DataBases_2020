<DOCTYPE html>
<html lang="en">
<head>
	<meta chatset = "utf-8">
	<title>Doctors work schedule</title>
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
            $sq = 'DELETE from public."doctors_work_schedule" where "id_schedule" = :id_schedule';
            $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_schedule' => $_POST["id_schedule"]));
            $data = $sth->fetchAll();
			if(count($data) > 0){
               	$status = "Запись удалена";
			}
			else{
                $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
           	} 
       	} 
       	if (isset($_POST["find"])) {
            $sq = 'SELECT * from public."doctors_work_schedule" where "id_schedule" = :id_schedule';
            $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_schedule' => $_POST["id_schedule"]));
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
            if($_POST["id_schedule"] != ""){
                $sq = 'SELECT * from public."doctors_work_schedule" where "id_schedule" = :id_schedule';
                $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_schedule' => intval($_POST["id_schedule"])));
                $data = $sth->fetchAll();
            }
        if($_POST["id_schedule"] != "" && count($data) > 0){
            $sq = 'UPDATE public."doctors_work_schedule" SET "start_of_work_time" = :start_of_work_time, "end_of_work_time" = :end_of_work_time, "weekday" = :weekday, "id_doctor" = :id_doctor, "id_cabinet" = :id_cabinet where "id_schedule" = :id_schedule';
           	$sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_schedule' => $_POST["id_schedule"],':start_of_work_time' => $_POST["start_of_work_time"],':end_of_work_time' => $_POST["end_of_work_time"],':weekday' =>$_POST["weekday"], ':id_doctor' => $_POST["id_doctor"], ':id_cabinet' => $_POST["id_cabinet"]));
           	$data = $sth->fetchAll();
            print_r ($sth->errorInfo()[2]);
            	$status = "Запись изменена";
            	$data = null;

        	}else  {
				$status = "Что-то пошло не так. Введите id";
			}	
		}   

		if (isset($_POST["add"])){
        	$sq = 'INSERT INTO public."doctors_work_schedule"("id_schedule", start_of_work_time", "end_of_work_time", "weekday", "id_doctor", "id_cabinet") VALUES (:id_schedule, :start_of_work_time, :end_of_work_time, :weekday, :id_doctor, :id_cabinet)';
        	$sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        	$sth->execute(array(':id_schedule' => $_POST["id_schedule"], ':start_of_work_time' => $_POST["start_of_work_time"],':end_of_work_time' => $_POST["end_of_work_time"], ':weekday' => $_POST["weekday"], ':id_doctor' => $_POST["id_doctor"], ':id_cabinet' => $_POST["id_cabinet"]));
       	 	$data = $sth->fetchAll();
        	print_r ($sth->errorInfo()[2]);
        	$status = "Запись добавлена";
        	$data = null;
        }
	}   
?>

	<h1>Doctors work schedule</h1>

<form action="" method="post">
	<input name="id_schedule" placeholder="ID ..." value="<?php echo '' ?>"></br>
	<button type="submit" name="delete">Delete</button>
</form>
<?php echo $status ?>
</br>
<form action="" method="post">
	<input name="id_schedule" size="40" placeholder="ID ..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_schedule']?>"> <-ID</br>
	<input name="start_of_work_time" size="40" placeholder="Start of work time..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['start_of_work_time']?>"> <-Start of work time</br>
	<input name="end_of_work_time" size="40" placeholder="ENd of work time..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['end_of_work_time']?>"> <-End of work time</br>
	<input name="weekday" size="40" placeholder="Weekday..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['weekday']?>"> <-Weekdays</br>
	<input name="id_doctor" size="40" placeholder="ID ..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_doctor']?>"> <-ID doctor</br>
	<input name="id_cabinet" size="40" placeholder="ID ..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_cabinet']?>"> <-ID cabinet</br>
	<button type="sumbit" name="add">Add</button>
	<button type="submit" name="edit">Edit</button>
</form>
</body>
</html>
