<?php

header("Content-Type: text/html; charset=utf-8");

$tables = [
	'Cabinet' => 'id_cabinet',
	'Class' => 'id_class',
	'Discipline' => 'id_discipline',
	'Journal' => 'id_journal',
	'Schedule' => 'id_schedule',
	'Student' => 'id_student',
	'Subject' => 'id_subject',
	'Teacher' => 'id_teacher',
];

try {
	$host = "localhost";
	$dbname = "itmo";
	$dbuser = "postgres";
	$dbpass = "811712Andrey";

	$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
}
catch(PDOException $e) {
		echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (isset($_GET['table'])) {
		$table = $_GET['table'];
	} else {
		$table = 'Cabinet';
	}

	if (isset($_GET['id_title'])) {
		$id_title = $_GET['id_title'];
	} else {
		$id_title = 'id_cabinet';
	}

	if (isset($_GET['delete_id'])) {
		$id = $_GET['delete_id'];

		$sql = 'DELETE FROM public."'.strtolower($table).'" WHERE "'.$id_title.'" = '.$id;
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
			$sql = "SELECT * FROM public.".strtolower($table)." WHERE ".$id_title." = ".$id;
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
		case 'Cabinet':
			$floor = isset($data['floor']) ? $data['floor'] : null;
			if (!$floor) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET floor = :floor WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':floor' => $floor,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'Class':
			$id_teacher = isset($data['id_teacher']) ? $data['id_teacher'] : null;
			$name = isset($data['name']) ? $data['name'] : null;
			$begining_education = isset($data['begining_education']) ? $data['begining_education'] : null;
			$end_education = isset($data['end_education']) ? $data['end_education'] : null;
		
			if (!$id_teacher || !$name || !$begining_education || !$end_education) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET id_teacher = :id_teacher, name = :name,
                begining_education = :begining_education, end_education = :end_education WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_teacher' => $id_teacher,
					':name' => $name,
					':begining_education' => $begining_education,
					':end_education' => $end_education,
					':id' => $id,
				));
				return True;
			}
			break;
	
		case 'Discipline':
			$id_teacher = isset($data['id_teacher']) ? $data['id_teacher'] : null;
			$id_subject = isset($data['id_subject']) ? $data['id_subject'] : null;
			$type = isset($data['type']) ? $data['type'] : null;
		
			if (!$id_teacher || !$id_subject || !$type) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET id_teacher = :id_teacher, id_subject = :id_subject,
                type = :type WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_teacher' => $id_teacher,
					':id_subject' => $id_subject,
					':type' => $type,
					':id' => $id,
				));
				return True;
			}
			break;

		case 'Journal':
			$id_class = isset($data['id_class']) ? $data['id_class'] : null;
			$id_discipline = isset($data['id_discipline']) ? $data['id_discipline'] : null;
			$mark = isset($data['mark']) ? $data['mark'] : null;
			$quarter = isset($data['quarter']) ? $data['quarter'] : null;
		
			if (!$id_class || !$id_discipline || !$mark || !$quarter) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET id_class = :id_class, id_discipline = :id_discipline,
                mark = :mark, quarter = :quarter WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_class' => $id_class,
					':id_discipline' => $id_discipline,
					':mark' => $mark,
					':quarter' => $quarter,
					':id' => $id
				));
				return True;
			}
			break;

		case 'Schedule':
			$id_class = isset($data['id_class']) ? $data['id_class'] : null;
			$id_cabinet = isset($data['id_cabinet']) ? $data['id_cabinet'] : null;
			$id_discipline = isset($data['id_discipline']) ? $data['id_discipline'] : null;
			$date = isset($data['date']) ? $data['date'] : null;
			$order_class = isset($data['order_class']) ? $data['order_class'] : null;
		
			if (!$id_class || !$id_cabinet || !$id_discipline || !$date || !$order_class) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET id_class = :id_class, id_cabinet = :id_cabinet,
                id_discipline = :id_discipline, date = :date, order_class = :order_class WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_class' => $id_class,
					':id_cabinet' => $id_cabinet,
					':id_discipline' => $id_discipline,
					':date' => $date,
					':order_class' => $order_class,
					':id' => $id
				));
				return True;
			}
			break;

		case 'Student':
			$id_class = isset($data['id_class']) ? $data['id_class'] : null;
			$first_name = isset($data['first_name']) ? $data['first_name'] : null;
			$last_name = isset($data['last_name']) ? $data['last_name'] : null;
			$sex = isset($data['sex']) ? $data['sex'] : null;
		
			if (!$id_class || !$first_name || !$last_name || !$sex) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET id_class = :id_class, first_name = :first_name,
                last_name = :last_name, sex = :sex WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_class' => $id_class,
					':first_name' => $first_name,
					':last_name' => $last_name,
					':sex' => $sex,
					':id' => $id
				));
				return True;
			}
			break;

		case 'Subject':
			$name = isset($data['name']) ? $data['name'] : null;
		
			if (!$name) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET name = :name WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':name' => $name,
					':id' => $id
				));
				return True;
			}
			break;

		case 'Teacher':
			$id_cabinet = isset($data['id_cabinet']) ? $data['id_cabinet'] : null;
			$id_subject = isset($data['id_subject']) ? $data['id_subject'] : null;
			$first_name = isset($data['first_name']) ? $data['first_name'] : null;
			$last_name = isset($data['last_name']) ? $data['last_name'] : null;
		
			if (!$id_cabinet || !$id_subject || !$first_name || !$last_name) {
				return False;
			} else {
				$sql = "UPDATE public.".strtolower($table)." SET name = :name WHERE ".$id_title." = :id";
        		$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_cabinet' => $id_cabinet,
					':id_subject' => $id_subject,
					':first_name' => $first_name,
					':last_name' => $last_name,
					':id' => $id
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
		case 'Cabinet':
			$id_cabinet = isset($data['id_cabinet']) ? $data['id_cabinet'] : null;
			$floor = isset($data['floor']) ? $data['floor'] : null;

			if (!$id_cabinet || !$floor) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_cabinet, floor) VALUES (:id_cabinet, :floor)";				
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_cabinet' => $id_cabinet,
					':floor' => $floor,
				));
				return True;
			}
			break;

		case 'Class':
			$id_class = isset($data['id_class']) ? $data['id_class'] : null;
			$id_teacher = isset($data['id_teacher']) ? $data['id_teacher'] : null;
			$name = isset($data['name']) ? $data['name'] : null;
			$begining_education = isset($data['begining_education']) ? $data['begining_education'] : null;
			$end_education = isset($data['end_education']) ? $data['begining_education'] : null;

			if (!$id_class || !$id_teacher || !$name || !$begining_education || !$end_education) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_class, id_teacher, name, begining_education, end_education) VALUES (:id_class, :id_teacher, :name, :begining_education, :end_education)";
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_class' => $id_class,
					':id_teacher' => $id_teacher,
					':name' => $name,
					':begining_education' => $begining_education,
					':end_education' => $end_education,
				));
				return True;
			}
			break;

		case 'Discipline':
			$id_discipline = isset($data['id_discipline']) ? $data['id_discipline'] : null;
			$id_teacher = isset($data['id_teacher']) ? $data['id_teacher'] : null;
			$id_subject = isset($data['id_subject']) ? $data['id_subject'] : null;
			$type = isset($data['type']) ? $data['type'] : null;

			if (!$id_discipline || !$id_teacher || !$id_subject || !$type) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_discipline, id_teacher, id_subject, type) VALUES (:id_discipline, :id_teacher, :id_subject, :type)";
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_discipline' => $id_discipline,
					':id_teacher' => $id_teacher,
					':id_subject' => $id_subject,
					':type' => $type,
				));
				return True;
			}
			break;

		case 'Journal':
			$id_journal = isset($data['id_journal']) ? $data['id_journal'] : null;
			$id_class = isset($data['id_class']) ? $data['id_class'] : null;
			$id_discipline = isset($data['id_discipline']) ? $data['id_discipline'] : null;
			$mark = isset($data['mark']) ? $data['mark'] : null;
			$quarter = isset($data['quarter']) ? $data['quarter'] : null;

			if (!$id_journal || !$id_class || !$id_discipline || !$mark || !$quarter) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_journal, id_class, id_discipline, mark, quarter) VALUES (:id_journal, :id_class, :id_discipline, :mark, :quarter)";
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_journal' => $id_journal,
					':id_class' => $id_class,
					':id_discipline' => $id_discipline,
					':mark' => $mark,
					':quarter' => $quarter,
				));
				return True;
			}
			break;

		case 'Schedule':
			$id_schedule = isset($data['id_schedule']) ? $data['id_schedule'] : null;
			$id_class = isset($data['id_class']) ? $data['id_class'] : null;
			$id_cabinet = isset($data['id_cabinet']) ? $data['id_cabinet'] : null;
			$id_discipline = isset($data['id_discipline']) ? $data['id_discipline'] : null;
			$date = isset($data['date']) ? $data['date'] : null;
			$order_class = isset($data['order_class']) ? $data['order_class'] : null;

			if (!$id_schedule || !$id_class || !$id_cabinet || !$id_discipline || !$date || !$order_class) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_schedule, id_class, id_cabinet, id_discipline, date, order_class) VALUES (:id_schedule, :id_class, :id_cabinet, :id_discipline, :date, :order_class)";
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_schedule' => $id_schedule,
					':id_class' => $id_class,
					':id_cabinet' => $id_cabinet,
					':id_discipline' => $id_discipline,
					':date' => $date,
					':order_class' => $order_class,
				));
				return True;
			}
			break;

		case 'Student':
			$id_student = isset($data['id_student']) ? $data['id_student'] : null;
			$id_class = isset($data['id_class']) ? $data['id_class'] : null;
			$first_name = isset($data['first_name']) ? $data['first_name'] : null;
			$last_name = isset($data['last_name']) ? $data['last_name'] : null;
			$sex = isset($data['sex']) ? $data['sex'] : null;

			if (!$id_student || !$id_class || !$first_name || !$last_name || !$sex) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_student, id_class, first_name, last_name, sex) VALUES (:id_student, :id_class, :first_name, :last_name, :sex)";
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_student' => $id_student,
					':id_class' => $id_class,
					':first_name' => $first_name,
					':last_name' => $last_name,
					':sex' => $sex,
				));
				return True;
			}
			break;

		case 'Subject':
			$id_subject = isset($data['id_subject']) ? $data['id_subject'] : null;
			$name = isset($data['name']) ? $data['name'] : null;

			if (!$id_subject || !$name) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_subject, name) VALUES (:id_subject, :name)";
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_subject' => $id_subject,
					':name' => $name,
				));
				return True;
			}
			break;

		case 'Teacher':
			$id_teacher = isset($data['id_teacher']) ? $data['id_teacher'] : null;
			$id_cabinet = isset($data['id_cabinet']) ? $data['id_cabinet'] : null;
			$id_subject = isset($data['id_subject']) ? $data['id_subject'] : null;
			$first_name = isset($data['first_name']) ? $data['first_name'] : null;
			$last_name = isset($data['last_name']) ? $data['last_name'] : null;

			if (!$id_teacher || !$id_cabinet || !$id_subject || !$first_name || !$last_name) {
				return False;
			} else {
				$sql = "INSERT INTO public.".strtolower($table)." (id_teacher, id_cabinet, id_subject, first_name, last_name) VALUES (:id_teacher, :id_cabinet, :id_subject, :first_name, :last_name)";
				$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute(array(
					':id_teacher' => $id_teacher,
					':id_cabinet' => $id_cabinet,
					':id_subject' => $id_subject,
					':first_name' => $first_name,
					':last_name' => $last_name,
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
		case 'Cabinet':
			return ['floor'];
			break;
		case 'Class':
			return ['id_teacher', 'name', 'begining_education', 'end_education'];
			break;
		case 'Discipline':
			return ['id_teacher', 'id_subject', 'type'];
			break;
		case 'Journal':
			return ['id_class', 'id_discipline', 'mark', 'quarter'];
			break;
		case 'Schedule':
			return ['id_class', 'id_cabinet', 'id_discipline', 'date', 'order_class'];
			break;
		case 'Student':
			return ['id_class', 'first_name', 'last_name', 'sex'];
			break;
		case 'Subject':
			return ['name'];
			break;
		case 'Teacher':
			return ['id_cabinet', 'id_subject', 'first_name', 'last_name'];
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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/style.css">

		<title>School Admin</title>
	</head>
	<body class="main"> 

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">School Admin</a>
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

						echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"query_list.php\">Query</a></li>";

					?>
					
				</ul>
			</div>

			
		</nav>
		<br><br>

		<?php
			// Details action

			if (isset($_GET['info_id'])) {
				$id = $_GET['info_id'];

				$sql = "SELECT * from public.".strtolower($table)." WHERE ".$id_title." = ".$id;
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
										<a href="index.php?table=$table&id_title=$id_title" class="btn btn-secondary" data-dismiss="modal">Закрыть</a>
									</div>
								</div>
							</div>
						</div>
					</div>
HTML;
			}
		?>
		<?php
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
											<span aria-hidden="true	">&times;</span>
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
											<button type="submit" class="btn btn-success">Добавить</button>
											<a href="index.php?table=$table&id_title=$id_title" class="btn btn-secondary" data-dismiss="modal">Закрыть</a>
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
			// Edit action

			if (isset($_GET['edit_id'])) {
				$id = $_GET['edit_id'];

				$sql = "SELECT * from public.".strtolower($table)." WHERE ".$id_title." = ".$id;
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
											<button type="submit" class="btn btn-primary">Сохранить</button>
											<a href="index.php?table=$table&id_title=$id_title" class="btn btn-secondary" data-dismiss="modal">Закрыть</a>
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
				<div class="ml-auto mr-3" style="margin-bottom: 12px">
					<?php
					echo ("<a href=\"index.php?table=$table&id_title=$id_title&add=add\" class=\"btn btn-success\" type=\"submit\">Добавить</a>")
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<table class="table table-hover table-dark">
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
										$sql = "SELECT * from public.".strtolower($table)." ORDER BY $id_title";
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

												echo <<<TABLE
																<td>
																	<a href="index.php?table=$table&info_id=$room_id&id_title=$id_title" class="btn btn-secondary btn-sm">Подробнее</a>
																	<a href="index.php?table=$table&edit_id=$room_id&id_title=$id_title" class="btn btn-primary btn-sm">Изменить</a>
																	<a href="index.php?table=$table&delete_id=$room_id&id_title=$id_title" class="btn btn-danger btn-sm">Удалить</a>
																</td>
															</tr>
TABLE;
											};
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