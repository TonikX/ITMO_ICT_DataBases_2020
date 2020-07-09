<!DOCTYPE html>
<html>

	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>

	<body>

		<?php
			session_start();
			if ($_GET['table_name'])
				$table_name = $_GET['table_name'];
			else
				header("Location: /part2/");

			$message = '';
			$dbuser = 'postgres';
			$dbpass = 'qwerty';
			$host = 'localhost';
			$dbname = 'airport_system';

			try {

				$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);

				$sql = 'SELECT * FROM public."'.$table_name.'" WHERE TRUE';

				if($_SERVER['REQUEST_METHOD'] == 'POST') {
					if (isset($_POST["find"])) {
						foreach ($_SESSION['columns'] as $value) {
							if ($_POST[$value])
								$sql .= ' AND "'.$value.'"=\''.$_POST[$value].'\'';
						}
					} else if (isset($_POST["delete"])) {
						$pre_sql = 'DELETE FROM public."'.$table_name.'" WHERE TRUE';
						foreach ($_SESSION['columns'] as $value) {
							if ($_POST[$value])
								$pre_sql .= ' AND "'.$value.'"=\''.$_POST[$value].'\'';
						}
						$pre_sql .= ';';
						$pre_result = $db->prepare($pre_sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
						$pre_result->execute();
						$message = 'Row deleted';
					} else if (isset($_POST["edit"])) {
						if ($_POST[$_SESSION['columns'][0]]) {
							$pre_pre_sql = 'SELECT * FROM public."'.$table_name.'" WHERE "'.$_SESSION['columns'][0].'"=\''.$_POST[$_SESSION['columns'][0]].'\';';
							$pre_pre_result = $db->prepare($pre_pre_sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
							$pre_pre_result->execute();
							$row = $pre_pre_result->fetch(PDO::FETCH_ASSOC);
							if ($row) {
								$pre_sql = 'UPDATE public."'.$table_name.'" SET "'.$_SESSION['columns'][1].'"=\''.$_POST[$_SESSION['columns'][1]].'\'';
								if (count($_SESSION['columns']) > 2)
									foreach (array_slice($_SESSION['columns'], 2) as $value) {
										$pre_sql .= ', "'.$value.'"=\''.$_POST[$value].'\'';
									}
								$pre_sql .= ' WHERE "'.$_SESSION['columns'][0].'"=\''.$_POST[$_SESSION['columns'][0]].'\';';
								// echo $pre_sql;
								$pre_result = $db->prepare($pre_sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
								$pre_result->execute();
								$message = 'Row updated';
							} else 
								$message = 'There are no rows with this ID';
						} else {
							$pre_sql = 'INSERT INTO public."'.$table_name.'"("'.$_SESSION['columns'][1].'"';
							if (count($_SESSION['columns']) > 2)
								foreach (array_slice($_SESSION['columns'], 2) as $value) {
									$pre_sql .= ', "'.$value.'"';
								}

							$pre_sql .= ') VALUES (\''.$_POST[$_SESSION['columns'][1]].'\'';
							if (count($_SESSION['columns']) > 2)
								foreach (array_slice($_SESSION['columns'], 2) as $value) {
									$pre_sql .= ', \''.$_POST[$value].'\'';
								}
							$pre_sql .= ');';
							$pre_result = $db->prepare($pre_sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
							$pre_result->execute();
							$message = 'Row added';
						}
					}
				}

				$sql .= ';';
				
				$result = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$result->execute();
				$row = $result->fetch(PDO::FETCH_ASSOC);
				if ($row) {
					$columns = array_keys($row);
					$_SESSION['columns'] = $columns;

					echo '<table> <tr> ';

					foreach ($columns as $value) {
						echo '<th>', $value, '</th>';
					}
					echo '</tr> ';
					
					$count = 0;
					do {
						echo '<tr>';
						foreach ($row as $data) {
							echo '<td>', $data, '</td>';
						}
						echo '</tr> ';
						$count++;
					} while ($row = $result->fetch(PDO::FETCH_ASSOC) and $count < 10);
					echo " </table><br>";
				}

				$db = null;
			} catch (PDOException $e) {
				echo "Error : ".$e->getMessage()."<br/>";
				die();
			}
				
				if ($message) {
					echo $message, '<br><br>';
				}
				echo '<form action="" method="post">';
				foreach ($_SESSION['columns'] as $value) {
					echo '<input name="'.$value.'" placeholder="'.$value.'..." value=""></br>';
				}
				echo '<button type="submit" name="find">Найти</button>
					<button type="submit" name="delete">Удалить</button>
				</form><br>';

				echo '<form action="" method="post">';
				foreach ($_SESSION['columns'] as $value) {
					echo '<input name="'.$value.'" placeholder="'.$value.'..." value=""></br>';
				}
				echo '<button type="submit" name="edit">Добавить/Редактировать</button>
					</form>';

			
		?>
		<br>
		<form action="/part2" method="get">
			<button type="submit" name="return">На главную</button>
		</form>
		
	</body>
</html>