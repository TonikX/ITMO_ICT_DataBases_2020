<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Priem</title>
</head>


<?php

$data = null;
$status = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dbuser = 'postgres';		$dbpassword = 'XHUSF2rS';		$host = 'localhost';		$dbname = 'clinics';     
		
		$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );
			
			if (isset($_POST["delete"])) {
                $sql = 'DELETE from public."Priem" where "id_priem" = :id_priem';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_priem' => $_POST["id_priem"]));
                $data = $sth->fetchAll();
				if(count($data) > 0){
                	$status = "Запись удалена";
				}
				else{
                $status = "Поля других таблиц зависимы от данного, удалите сначала там:)";
                }            
				}
           	if (isset($_POST["find"])) {
                $sql = 'SELECT * from public."Priem" where "id_priem" = :id_priem';
                $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id_priem' => $_POST["id_priem"]));
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
                if($_POST["id_priem"] != ""){
                   $sql = 'SELECT * from public."Priem" where "id_priem" = :id_priem';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_priem' => intval($_POST["id_priem"])));
                    $data = $sth->fetchAll();
                }
                if($_POST["id_priem"] != "" && count($data) > 0){
                    $sql = 'UPDATE public."Priem" SET "id_doctor" = :id_doctor, "id_patient" = :id_patient, "date_priem" = :date_priem, "time_priem" = :time_priem, "patient_state" = :patient_state, "recommendations" = :recommendations where "id_priem" = :id_priem';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_priem' => $_POST["id_priem"],':id_patient' => $_POST["id_patient"], ':id_doctor' => $_POST["id_doctor"], ':date_priem' => $_POST["date_priem"],':time_priem' => $_POST["time_priem"],':patient_state' => $_POST["patient_state"], ':recommendations' => $_POST["recommendations"]));

                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись изменена";
                    $data = null;

                }else{
					$status = "Упс, что-то пошло не так... введите id";
					}
		   	}
				if (isset($_POST["add"])){
                    $sql = 'INSERT INTO public."Priem"("id_patient", "id_doctor", "date_priem", "time_priem", "patient_state", "recommendations") VALUES (:id_patient, :id_doctor, :date_priem, :time_priem, :patient_stat, :recommendation)';
                    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute(array(':id_priem' => $_POST["id_priem"],':id_patient' => $_POST["id_patient"], ':id_doctor' => $_POST["id_doctor"], ':date_priem' => $_POST["date_priem"],':time_priem' => $_POST["time_priem"],':patient_state' => $_POST["patient_state"], ':recommendations' => $_POST["recommendations"]));
                    $data = $sth->fetchAll();
                    print_r ($sth->errorInfo()[2]);
                    $status = "Запись добавлена";
                    $data = null;
                }
			
}
?>



<body>
<form action="" method="post">
    <input name="id_priem" placeholder="id приема..." value="<?php echo '' ?>"></br>
    <button type="submit" name="find">Найти </button>
	<button type="submit" name="delete">Удалить</button>


</form>
<?php echo $status ?>
</br>
<form action="" method="post">
    <input name="id_priem" size="40" placeholder="id приема..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_priem']?>"> <-id приема</br>
	<input name="id_patient" size="40" placeholder="id пациента..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_patient']?>"> <-id пациента</br>
    <input name="id_doctor" size="40" placeholder="id доктора..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['id_doctor']?>"> <-id доктора</br>
    <input name="date_priem" size="40" placeholder="Дата приема..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['date_priem']?>"> <-Дата приема</br>
    <input name="time_priem" size="40" placeholder="Время приема..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['time_priem']?>"> <-Время приема</br>
	<input name="patient_state"" size="40" placeholder="Состояние пациента..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['patient_state']?>"> <-Состояние пациента</br>
	<input name="recommendations" size="40" placeholder="Рекомендации..." value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0]['recommendations']?>"> <-Описание </br>
    <button type="submit" name="add">Добавить</button>
	<button type="submit" name="edit">Редактировать</button>
</form>
</body>
</html>




 

