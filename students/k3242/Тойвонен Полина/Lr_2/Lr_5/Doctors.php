<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "utf-8">
	<title>Doctors of our clinic</title>
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
            $sq = 'DELETE from public."doctors" where "id_doctor" = :id_doctor';
            $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_doctor' => $_POST["id_doctor"]));
            $data = $sth->fetchAll();
			if(count($data) > 0){
               	$status = "Запись удалена";
			}
			else{
                $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
            } 
        }  
        if (isset($_POST["find"])) {
            $sq = 'SELECT * from public."doctors" where "id_doctor" = :id_doctor';
            $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_doctor' => $_POST["id_doctor"]));
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
            if($_POST["id_doctor"] != ""){
                $sq = 'SELECT * from public."doctors" where "id_doctor" = :id_doctor';
                $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_doctor' => intval($_POST["id_doctor"])));
                $data = $sth->fetchAll();
            }
        if($_POST["id_doctor"] != "" && count($data) > 0){
            $sq = 'UPDATE public."doctors" SET "fio" = :fio, "date_of_birth" = :date_of_birth, "specialization" = :specialization, "gender" = :gender, "time_working_in_clinics" = :time_working_in_clinics, "information_about_the_employment_contract" = :information_about_the_employment_contract where "id_doctor" = :id_doctor';
           	$sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':id_doctor' => $_POST["id_doctor"],':fio' => $_POST["fio"],':date_of_birth' => $_POST["date_of_birth"],':specialization' => $_POST["specialization"], ':gender' => $_POST["gender"], ':time_working_in_clinics' => $_POST["time_working_in_clinics"], ':information_about_the_employment_contract' => $_POST["information_about_the_employment_contract"]));
           	$data = $sth->fetchAll();
            print_r ($sth->errorInfo()[2]);
            $status = "Запись изменена";
            $data = null;

        }else  {
			$status = "Что-то пошло не так. Введите id";
		}
	}   

	if (isset($_POST["add"])){
        $sq = 'INSERT INTO public."doctors"("id_doctor, "fio", "date_of_birth", "specialization", "gender", "time_working_in_clinic", "information_about_the_employment_contract") VALUES (:id_doctor, :fio, :date_of_birth, :specialization, :gender, :time_working_in_clinics, :information_about_the_employment_contract)';
        $sth = $pdo->prepare($sq, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array('id_doctor' => $_POST["id_doctor"], ':fio' => $_POST["fio"],':date_of_birth' => $_POST["date_of_birth"],':specialization' => $_POST["specialization"], ':gender' => $_POST["gender"], ':time_working_in_clinics' => $_POST["time_working_in_clinics"], ':information_about_the_employment_contract' => $_POST["information_about_the_employment_contract"] ));
        $data = $sth->fetchAll();
        print_r ($sth->errorInfo()[2]);
        $status = "Запись добавлена";
        $data = null;
    } 
}   
?>




	<h1>Doctors of our clinic<h1>
<form action="" method="post">
	<input name="id_doctor" placeholder="ID ..." value="<?php echo '' ?>"></br>
	<button type="submit" name="find">Find</button>
	<button type="submit" name="delete">Delete</button>

</form>
<?php echo $status ?>
</br>
<form action="" method="post">
	<input name="id_doctor" size="40" placeholder="ID ..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_doctor']?>"> <-ID</br>
	<input name="fio" size="40" placeholder="FIO..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['fio']?>"> <-FIO</br>
	<input name="date_of_birth" size="40" placeholder="Date of birth..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['date_of_birth']?>"> <-Date of birth</br>
	<input name="specialization" size="40" placeholder="Specialization..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['specialization']?>"> <-Specialization</br>
	<input name="gender" size="40" placeholder="Gender..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['gender']?>"> <-Gender</br>
	<input name="time_working_in_clinics" size="40" placeholder="Time working in clinic..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['time_working_in_clinics']?>"> <-Time working in clinic</br>
	<input name="information_about_the_employment_contract" size="40" placeholder="Employment..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['information_about_the_employment_contract']?>"> <-Employment</br>
	<button type="sumbit" name="add">Add</button>
	<button type="submit" name="edit">Edit</button>
</form>
</body>
</html>
