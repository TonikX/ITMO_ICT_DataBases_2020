<?php 

function echoQueryResultTable($query)
{
	
	$db = pg_connect("host=localhost dbname=Lab password=123456 user=postgres");

	$result = pg_query($query);
	if ($result) {
		$n_rows = pg_num_rows($result);
		$n_cols = pg_num_fields($result);

		echo "<table border=1 class='result-table'>";
		
		// выводим заголовок
		echo '<tr>';
		for ($j=0; $j < $n_cols; $j++) { 
			echo '<th>' . pg_field_name($result, $j) . '</th>';
		}
		echo '</tr>';

		// выводим данные
		for ($i=0; $i < $n_rows; $i++) {
			echo "<tr>";
			for ($j=0; $j < $n_cols; $j++) { 
				echo "<td>" . pg_fetch_result($result, $i, $j) . "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	};
	pg_close($db);

}


function echoEditTable($table)
{
	$db = pg_connect("host=localhost dbname=Lab password=123456 user=postgres");

	$result = pg_query('select * from ' . $table);
	if ($result) {
		$n_rows = pg_num_rows($result);
		$n_cols = pg_num_fields($result);

		echo "<table border=1 class='edit-table'>";
		
		// выводим заголовок
		echo '<tr>';
		for ($j=0; $j < $n_cols; $j++) { 
			echo '<th>' . pg_field_name($result, $j) . '</th>';
		}
		echo '</tr>';

		echo '<tr>';
		echo "<form action='edit.php' method='POST'>";
		
		for ($j=0; $j < $n_cols; $j++) { 
			echo "<td><input type='text' name='" . pg_field_name($result, $j) ."'></td>";
		}

		echo "<input type='text' name='edit_table' value=" . $table . " hidden='true'>";
		echo "<td><input type='submit' name='add' value='Добавить' class='edit-table--add'></td>";
		echo "</form>";
		echo '</tr>';

		// выводим данные
		for ($i=0; $i < $n_rows; $i++) {
			echo "<tr>";
			echo "<form action='edit.php' method='POST'>";
			for ($j=0; $j < $n_cols; $j++) { 
				echo "<td> <input type='text' name='" . pg_field_name($result, $j) ."' placeholder='" . pg_field_name($result, $j) . "' value='" . pg_fetch_result($result, $i, $j) ."'> </td>";
			}
 
			echo "<input type='text' name='edit_table' value=" . $table . " hidden='true'>";
			echo "<td><input type='submit' name='save' value='Сохранить' class='edit-table--save'></td>";
			echo "<td><input type='submit' name='delete' value='Удалить' class='edit-table--delete'></td>";
			
			echo "</form>";
			echo "</tr>";
		}
		echo "</table>";
	};
	pg_close($db);
}

 ?>
