<?php

header("Content-Type: text/html; charset=utf-8");

$tables = [
	'Room' => 'RoomID',
	'RoomType' => 'TypeID',
	'Accomodation' => 'AccomodationID',
	'Administrator' => 'AdministratorID',
	'CleaningLogs' => 'LogID',
	'CleaningSchedule' => 'ScheduleID',
	'Customer' => 'CustomerID',
	'Floor' => 'FloorID',
	'Servant' => 'ServantID',
];

try {
	$dbuser = 'postgres';
	$dbpass = '3712';
	$host = 'localhost';
	$dbname = 'postgres';
	$dbport = '5432';

	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
}
catch(PDOException $e) {
		echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (isset($_GET['table'])) {
		$table = $_GET['table'];
	} else {
		$table = 'Room';
	}

	if (isset($_GET['id_title'])) {
		$id_title = $_GET['id_title'];
	} else {
		$id_title = 'RoomID';
	}

	if (isset($_GET['delete_id'])) {
		$id = $_GET['delete_id'];

		$sql = 'DELETE FROM public."'.$table.'" WHERE "'.$id_title.'" = '.$id;
		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();

		header("Refresh:0; url=index.php?table=$table&id_title=$id_title");
	}
}

// User sent form with updated object
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST["table"]) && isset($_POST["id"]) && isset($_POST["id_title"])) {
			$table = $_POST['table'];
			$id = $_POST['id'];
			$id_title = $_POST['id_title'];
			$exist = False;

			$sql = 'SELECT * FROM public."'.$table.'" WHERE "'.$id_title.'" = '.$id;
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute();
			$value = $sth->fetchAll();
			if(count($value) > 0){
				 $exist = True;
			}

			if ($exist) {
				UpdateObject($pdo, $table, $id, $id_title, $_POST);
				header("Refresh:0; url=index.php?table=$table&id_title=$id_title");
			}
		}
}

// User sent form with new object
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST["table"]) && isset($_POST["id_title"])) {
			$table = $_POST['table'];
			$id_title = $_POST['id_title'];

			AddObject($pdo, $table, $_POST);
			header("Refresh:0; url=index.php?table=$table&id_title=$id_title");
		}
}

function UpdateObject($pdo, $table, $id, $id_title, $data) {
	switch ($table) {
		case 'Room':
			$floor_id = isset($data['FloorID']) ? $data['FloorID'] : null;
			$daily_price = isset($data['DailyPrice']) ? $data['DailyPrice'] : null;
			$room_type_id = isset($data['RoomTypeID']) ? $data['RoomTypeID'] : null;

			if (!$floor_id || !$daily_price || !$room_type_id) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "FloorID" = :floor_id, "DailyPrice"= :daily_price, 
                "RoomTypeID" = :room_type_id WHERE "'.$id_title.'" = :id';
        $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':floor_id' => $floor_id,
					':daily_price' => $daily_price,
					':room_type_id' => $room_type_id,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'RoomType':
			$capacity = isset($data['Capacity']) ? $data['Capacity'] : null;

			if (!$capacity) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "Capacity" = :capacity WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':capacity' => $capacity,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'Accomodation':
			$start_date = isset($data['StartDate']) ? $data['StartDate'] : null;
			$end_date = isset($data['EndDate']) ? $data['EndDate'] : null;
			$administrator_id = isset($data['AdministratorID']) ? $data['AdministratorID'] : null;
			$customer_id = isset($data['CustomerID']) ? $data['CustomerID'] : null;
			$room_id = isset($data['RoomID']) ? $data['RoomID'] : null;

			if (!$start_date || !$administrator_id || !$customer_id || !$room_id) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "StartDate" = :start_date, "EndDate" = :end_date, "AdministratorID" = :administrator_id, "CustomerID" = :customer_id, "RoomID" = :room_id WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':start_date' => $start_date,
					':end_date' => $end_date,
					':administrator_id' => $administrator_id,
					':customer_id' => $customer_id,
					':room_id' => $room_id,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'Administrator':
			$first_name = isset($data['FirstName']) ? $data['FirstName'] : null;
			$middle_name = isset($data['MiddleName']) ? $data['MiddleName'] : null;
			$last_name = isset($data['LastName']) ? $data['LastName'] : null;

			if (!$first_name || !$middle_name || !$last_name) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "FirstName" = :first_name, "MiddleName"= :middle_name, "LastName" = :last_name WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':first_name' => $first_name,
					':middle_name' => $middle_name,
					':last_name' => $last_name,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'CleaningLogs':
			$date = isset($data['Date']) ? $data['Date'] : null;
			$floor_id = isset($data['FloorID']) ? $data['FloorID'] : null;
			$servant_id = isset($data['ServantID']) ? $data['ServantID'] : null;

			if (!$date || !$floor_id || !$servant_id) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "Date" = :date, "FloorID"= :floor_id, "ServantID" = :servant_id WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':date' => $date,
					':floor_id' => $floor_id,
					':servant_id' => $servant_id,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'CleaningSchedule':
			$weekday = isset($data['Weekday']) ? $data['Weekday'] : null;
			$floor_id = isset($data['FloorID']) ? $data['FloorID'] : null;
			$servant_id = isset($data['ServantID']) ? $data['ServantID'] : null;

			if (!$weekday || !$floor_id || !$servant_id) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "Weekday" = :weekday, "FloorID"= :floor_id, "ServantID" = :servant_id WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':weekday' => $weekday,
					':floor_id' => $floor_id,
					':servant_id' => $servant_id,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'Customer':
			$first_name = isset($data['FirstName']) ? $data['FirstName'] : null;
			$middle_name = isset($data['MiddleName']) ? $data['MiddleName'] : null;
			$last_name = isset($data['LastName']) ? $data['LastName'] : null;
			$passport_number = isset($data['PassportNumber']) ? $data['PassportNumber'] : null;
			$city = isset($data['City']) ? $data['City'] : null;

			if (!$first_name || !$middle_name || !$last_name || !$passport_number || !$city) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "FirstName" = :first_name, "MiddleName"= :middle_name, "LastName" = :last_name, "PassportNumber" = :passport_number, "City" = :city WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':first_name' => $first_name,
					':middle_name' => $middle_name,
					':last_name' => $last_name,
					':passport_number' => $passport_number,
					':city' => $city,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'Floor':
			$floor_number = isset($data['FloorNumber']) ? $data['FloorNumber'] : null;

			if (!$floor_number) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "FloorNumber" = :floor_number WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':floor_number' => $floor_number,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'Servant':
			$first_name = isset($data['FirstName']) ? $data['FirstName'] : null;
			$middle_name = isset($data['MiddleName']) ? $data['MiddleName'] : null;
			$last_name = isset($data['LastName']) ? $data['LastName'] : null;

			if (!$first_name || !$middle_name || !$last_name) {
				return False;
			} else {
				$sql = 'UPDATE public."'.$table.'" SET "FirstName" = :first_name, "MiddleName"= :middle_name, "LastName" = :last_name WHERE "'.$id_title.'" = :id';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':first_name' => $first_name,
					':middle_name' => $middle_name,
					':last_name' => $last_name,
					':id' => $id,
				));
				return True;
			}
			break;
		
		default:
			return False;
			break;
	}

	$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute();
}

function AddObject($pdo, $table, $data) {
	switch ($table) {
		case 'Room':
			$room_id = isset($data['RoomID']) ? $data['RoomID'] : null;
			$floor_id = isset($data['FloorID']) ? $data['FloorID'] : null;
			$daily_price = isset($data['DailyPrice']) ? $data['DailyPrice'] : null;
			$room_type_id = isset($data['RoomTypeID']) ? $data['RoomTypeID'] : null;

			if (!$room_id || !$floor_id || !$daily_price || !$room_type_id) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("RoomID", "FloorID", "DailyPrice", "RoomTypeID") VALUES (:room_id, :floor_id, :daily_price, :room_type_id)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':floor_id' => $floor_id,
					':daily_price' => $daily_price,
					':room_type_id' => $room_type_id,
					':room_id' => $room_id,
				));
				return True;
			}
			break;

		case 'RoomType':
			$room_type_id = isset($data['TypeID']) ? $data['TypeID'] : null;
			$capacity = isset($data['Capacity']) ? $data['Capacity'] : null;

			if (!$room_type_id || !$capacity) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("TypeID", "Capacity") VALUES (:room_type_id, :capacity)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':capacity' => $capacity,
					':room_type_id' => $room_type_id,
				));
				return True;
			}
			break;

		case 'Accomodation':
			$accomodation_id = isset($data['AccomodationID']) ? $data['AccomodationID'] : null;
			$start_date = isset($data['StartDate']) ? $data['StartDate'] : null;
			$end_date = isset($data['EndDate']) ? $data['EndDate'] : null;
			$administrator_id = isset($data['AdministratorID']) ? $data['AdministratorID'] : null;
			$customer_id = isset($data['CustomerID']) ? $data['CustomerID'] : null;
			$room_id = isset($data['RoomID']) ? $data['RoomID'] : null;

			if (!$accomodation_id || !$start_date || !$administrator_id || !$customer_id || !$room_id) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("AccomodationID", "StartDate", "EndDate", "AdministratorID", "CustomerID", "RoomID") VALUES (:accomodation_id, :start_date, :end_date, :administrator_id, :customer_id, :room_id)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':start_date' => $start_date,
					':end_date' => $end_date,
					':administrator_id' => $administrator_id,
					':customer_id' => $customer_id,
					':room_id' => $room_id,
					':accomodation_id' => $accomodation_id,
				));
				return True;
			}
			break;

		case 'Administrator':
			$administrator_id = isset($data['AdministratorID']) ? $data['AdministratorID'] : null;
			$first_name = isset($data['FirstName']) ? $data['FirstName'] : null;
			$middle_name = isset($data['MiddleName']) ? $data['MiddleName'] : null;
			$last_name = isset($data['LastName']) ? $data['LastName'] : null;

			if (!$administrator_id || !$first_name || !$middle_name || !$last_name) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("AdministratorID", "FirstName", "MiddleName", "LastName") VALUES (:administrator_id, :first_name, :middle_name, :last_name)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':first_name' => $first_name,
					':middle_name' => $middle_name,
					':last_name' => $last_name,
					':administrator_id' => $administrator_id,
				));
				return True;
			}
			break;

		case 'CleaningLogs':
			$log_id = isset($data['LogID']) ? $data['LogID'] : null;
			$date = isset($data['Date']) ? $data['Date'] : null;
			$floor_id = isset($data['FloorID']) ? $data['FloorID'] : null;
			$servant_id = isset($data['ServantID']) ? $data['ServantID'] : null;

			if (!$log_id || !$date || !$floor_id || !$servant_id) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("LogID", "Date", "FloorID", "ServantID") VALUES (:log_id, :date, :floor_id, :servant_id)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':date' => $date,
					':floor_id' => $floor_id,
					':servant_id' => $servant_id,
					':servant_id' => $servant_id,
				));
				return True;
			}
			break;

		case 'CleaningSchedule':
			$schedule_id = isset($data['ScheduleID']) ? $data['ScheduleID'] : null;
			$weekday = isset($data['Weekday']) ? $data['Weekday'] : null;
			$floor_id = isset($data['FloorID']) ? $data['FloorID'] : null;
			$servant_id = isset($data['ServantID']) ? $data['ServantID'] : null;

			if (!$schedule_id || !$weekday || !$floor_id || !$servant_id) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("ScheduleID", "Weekday", "FloorID", "ServantID") VALUES (:schedule_id, :weekday, :floor_id, :servant_id)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':weekday' => $weekday,
					':floor_id' => $floor_id,
					':servant_id' => $servant_id,
					':schedule_id' => $schedule_id,
				));
				return True;
			}
			break;

		case 'Customer':
			$customer_id = isset($data['CustomerID']) ? $data['CustomerID'] : null;
			$first_name = isset($data['FirstName']) ? $data['FirstName'] : null;
			$middle_name = isset($data['MiddleName']) ? $data['MiddleName'] : null;
			$last_name = isset($data['LastName']) ? $data['LastName'] : null;
			$passport_number = isset($data['PassportNumber']) ? $data['PassportNumber'] : null;
			$city = isset($data['City']) ? $data['City'] : null;

			if (!$customer_id || !$first_name || !$middle_name || !$last_name || !$passport_number || !$city) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("CustomerID", "FirstName", "MiddleName", "LastName", "PassportNumber", "City") VALUES (:customer_id, :first_name, :middle_name, :last_name, :passport_number, :city)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':first_name' => $first_name,
					':middle_name' => $middle_name,
					':last_name' => $last_name,
					':passport_number' => $passport_number,
					':city' => $city,
					':customer_id' => $customer_id,
				));
				return True;
			}
			break;

		case 'Floor':
			$floor_id = isset($data['FloorID']) ? $data['FloorID'] : null;
			$floor_number = isset($data['FloorNumber']) ? $data['FloorNumber'] : null;

			if (!$floor_id || !$floor_number) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("FloorID", "FloorNumber") VALUES (:floor_id, :floor_number)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':floor_number' => $floor_number,
					':floor_id' => $floor_id,
				));
				return True;
			}
			break;

		case 'Servant':
			$servant_id = isset($data['ServantID']) ? $data['ServantID'] : null;
			$first_name = isset($data['FirstName']) ? $data['FirstName'] : null;
			$middle_name = isset($data['MiddleName']) ? $data['MiddleName'] : null;
			$last_name = isset($data['LastName']) ? $data['LastName'] : null;

			if (!$servant_id || !$first_name || !$middle_name || !$last_name) {
				return False;
			} else {
				$sql = 'INSERT INTO public."'.$table.'" ("ServantID", "FirstName", "MiddleName", "LastName") VALUES (:servant_id, :first_name, :middle_name, :last_name)';
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':first_name' => $first_name,
					':middle_name' => $middle_name,
					':last_name' => $last_name,
					':servant_id' => $servant_id,
				));
				return True;
			}
			break;
		
		default:
			return False;
			break;
	}

	$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute();
}

function GetFields($table) {
	switch ($table) {
		case 'Room':
			return ['FloorID', 'DailyPrice', 'RoomTypeID'];
			break;
		case 'RoomType':
			return ['Capacity'];
			break;
		case 'Accomodation':
			return ['StartDate', 'EndDate', 'AdministratorID', 'CustomerID', 'RoomID'];
			break;
		case 'Administrator':
			return ['FirstName', 'MiddleName', 'LastName'];
			break;
		case 'CleaningLogs':
			return ['Date', 'FloorID', 'ServantID'];
			break;
		case 'CleaningSchedule':
			return ['Weekday', 'FloorID', 'ServantID'];
			break;
		case 'Customer':
			return ['PassportNumber', 'FirstName', 'MiddleName', 'LastName', 'City'];
			break;
		case 'Floor':
			return ['FloorNumber'];
			break;
		case 'Servant':
			return ['FirstName', 'MiddleName', 'LastName'];
			break;
			
		default:
			return False;
			break;
	}
}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">

		<title>Hotel Management</title>
	</head>
	<body>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Hotel Management</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav mr-auto">

					<?php

						foreach ($tables as $key => $value) {
							if ($key == $table) {
								echo "<li class=\"nav-item active\"><a class=\"nav-link\">$key <span class=\"sr-only\">(current)</span></a></li>";
							} else {
								echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?table=$key&id_title=$value\">$key</a></li>";
							}
						}

					?>

				</ul>
			</div>

			<div class="my-2 my-lg-0">
				<?php
				 echo ("<a href=\"index.php?table=$table&id_title=$id_title&add=add\" class=\"btn btn-success my-2 my-sm-0\" type=\"submit\">+ Add</a>")
				?>
			</form>
		</nav>

		<br><br>
		
		<?php
			// Details action

			if (isset($_GET['info_id'])) {
				$id = $_GET['info_id'];

				$sql = 'SELECT * from public."'.$table.'" WHERE "'.$id_title.'" = '.$id;
				$sth = $pdo->query($sql);
				$data = $sth->fetchObject();

				echo <<<HTML
					<div class="modal-container">
						<div class="modal">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">$table</h5>
										<a href="index.php?table=$table&id_title=$id_title" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</a>
									</div>
									<div class="modal-body">
				HTML;

				foreach ($data as $key => $value) {
					echo "<h6><b>$key</b></h6><p>$value</p>";
				}

				echo <<<HTML
									</div>
									<div class="modal-footer">
										<a href="index.php?table=$table&id_title=$id_title" class="btn btn-secondary" data-dismiss="modal">Close</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				HTML;
			}
		?>

		<?php
			// Edit action

			if (isset($_GET['edit_id'])) {
				$id = $_GET['edit_id'];

				$sql = 'SELECT * from public."'.$table.'" WHERE "'.$id_title.'" = '.$id;
				$sth = $pdo->query($sql);
				$data = $sth->fetchObject();

				echo <<<HTML
					<div class="modal-container">
						<div class="modal">
							<div class="modal-dialog" role="document">
								<form method="POST">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">$table</h5>
											<a href="index.php?table=$table&id_title=$id_title" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</a>
										</div>
										<div class="modal-body">
				HTML;

				echo <<<HTML
										<input type="hidden" name="table" value="$table">
										<input type="hidden" name="id" value="$id">
										<input type="hidden" name="id_title" value="$id_title">
					HTML;

				foreach ($data as $key => $value) {
					if ($key == $id_title) {
						echo <<<HTML
										<fieldset>
									    <div class="form-group">
												<label><b>$key</b></label>
													<input type="text" readonly="" class="form-control" name="$key" value="$value">
											</div>
										</fieldset>
							HTML;
					} else {
						echo <<<HTML
										<fieldset>
											<div class="form-group">
												<label><b>$key</b></label>
													<input type="text" class="form-control" name="$key" value="$value">
											</div>
										</fieldset>
							HTML;
					}
				}

				echo <<<HTML
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save changes</button>
											<a href="index.php?table=$table&id_title=$id_title" class="btn btn-secondary" data-dismiss="modal">Close</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				HTML;
			}
		?>

		<?php
			// Add action

			if (isset($_GET['add'])) {

				$fields = GetFields($table);

				echo <<<HTML
					<div class="modal-container">
						<div class="modal">
							<div class="modal-dialog" role="document">
								<form method="POST">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">$table</h5>
											<a href="index.php?table=$table&id_title=$id_title" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</a>
										</div>
										<div class="modal-body">
				HTML;

				echo <<<HTML
									<input type="hidden" name="table" value="$table">
									<input type="hidden" name="id_title" value="$id_title">

									<fieldset>
										<div class="form-group">
											<label><b>$id_title</b></label>
												<input type="text" class="form-control" name="$id_title">
										</div>
									</fieldset>
					HTML;

				foreach ($fields as $field) {
					echo <<<HTML
									<fieldset>
										<div class="form-group">
											<label><b>$field</b></label>
												<input type="text" class="form-control" name="$field">
										</div>
									</fieldset>
						HTML;
				}

				echo <<<HTML
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-success">Add object</button>
											<a href="index.php?table=$table&id_title=$id_title" class="btn btn-secondary" data-dismiss="modal">Close</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				HTML;
			}
		?>


		<div class="container">
			<div class="row">
				<div class="col-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<?php

									echo "<th scope=\"col\">$id_title</th>";

									$fields = GetFields($table);
									$fields = array_slice($fields, 0, 3);

									foreach ($fields as $field) {
										echo "<th scope=\"col\">$field</th>";
									}

								?>

								<th scope="col">Actions</th>
							</tr>
						</thead>
						<tbody>

							<?php
									$sql = 'SELECT * from public."'.$table.'" ORDER BY "'.$id_title.'"';
									$sth = $pdo->query($sql);
									$data = $sth->fetchAll();

									$fields = GetFields($table);
									$fields = array_slice($fields, 0, 4);

									for ($i = 0; $i < count($data); $i++) {
											$room_id = $data[$i][$id_title];
											$param1 = count($fields) >= 1 ? $data[$i][$fields[0]] : null;
											$param2 = count($fields) >= 2 ? $data[$i][$fields[1]] : null;
											$param3 = count($fields) >= 3 ? $data[$i][$fields[2]] : null;

											echo ("<tr><th scope=\"row\">$room_id</th>");

											if (count($fields) >= 1) {
												echo "<td>$param1</td>";
											}

											if (count($fields) >= 2) {
												echo "<td>$param2</td>";
											}

											if (count($fields) >= 3) {
												echo "<td>$param3</td>";
											}

											echo <<<HTML
															<td>
																<a href="index.php?table=$table&info_id=$room_id&id_title=$id_title" class="btn btn-secondary btn-sm">Info</a>
																<a href="index.php?table=$table&edit_id=$room_id&id_title=$id_title" class="btn btn-primary btn-sm">Edit</a>
																<a href="index.php?table=$table&delete_id=$room_id&id_title=$id_title" class="btn btn-danger btn-sm">Delete</a>
															</td>
														</tr>
													HTML;
									}
							?>
						</tbody>
					</table> 
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>