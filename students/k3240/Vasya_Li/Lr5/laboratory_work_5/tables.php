 
<html lang="en">
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href="head.css" >
 <title>закзачики</title>
</head>

<?php
	session_start();
	$data = null;
	$status = "";
	require  ('functions.php');
	require('connection.php');
	$Table = $_SESSION["table"];
	$inputField = allRec($Table);
	if(isset($_POST["find"])) {
		$sql = 'SELECT * FROM '. $Table. ' WHERE '. $inputField[0]. ' = ?';
        $data = find($sql,$_POST[$inputField[0]],$status);
	}
	elseif(isset($_POST["insert"])){
		$sql = 'INSERT INTO '. $Table. ' ("'. $inputField[0] .'"';
		$values = ' VALUES(?';
		$arrVal[0] = $_POST[$inputField[0]];
		for($i=1; $i <count($inputField); $i++){
			$sql .= ',"'.$inputField[$i].'"' ;
			$values .= ", ?";
			$arrVal[$i] = $_POST[$inputField[$i]];
		}
		$values .= ")";
		$sql .= ')'. $values;
		insert($sql,$arrVal, $status );
	}
	elseif(isset($_POST["edit"])) {
		//$sql = 'UPDATE customer SET "name"= ?, "mail" = ? where "phone" = ?';
		$sql = 'UPDATE '. $Table .' SET '. $inputField[1] ;
		$arrVal[0] = $_POST[$inputField[1]];
		$arrVal[1] = $_POST[$inputField[2]];
		for($i=2; $i <count($inputField); $i++){
			$sql .= ' = ?, '.$inputField[$i];
			$arrVal[$i-1] = $_POST[$inputField[$i]];
		}
		$arrVal[count($arrVal)] = $_POST[$inputField[0]];
		$sql .= " = ? WHERE ". $inputField[0]. " = ?"; 
		edit($_POST[$inputField[0]],$sql,$arrVal, $status );
	}
	elseif(isset($_POST["delete"])) {
		$sql = 'DELETE FROM '. $Table. ' WHERE '. $inputField[0]. '= ?';
		delete($sql,[$_POST[$inputField[0]]], $status);
	}
?>
<div class ="head">
	<div class="left"> 
		<a href="index.php">
			<div class="arrow arrow-left"></div> 
		</a>
	</div>
	<div class="right">
	<form action="" method="post">
		<input 	name="<?php echo $inputField[0];?>" type="text" placeholder="<?php echo $inputField[0]?>">
		<button type="submit" name="find">Поиск</button>
		<button type="submit" name="delete">Удаление</button>
	</form>
	</div>
</div>
</br>

<?php
	for($i=0; $i<count($inputField); $i++){
		echo $inputField[$i]."</br>";
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $data) echo $data[0][$inputField[$i]];
		echo "</br>";;
	}
?>
<div class="results">
<?php echo $status ?>
	<form action="" method="post">
	<?php
		for($i=0; $i<count($inputField); $i++){
			echo $inputField[$i]."</br>";
			echo "<input name='$inputField[$i]' size='30' >";
			echo "</br>";
		}
	?>
	<button type="submit" name="insert">Добавление</button>
	<button type="submit" name="edit">Редактирование</button>
	</form>	
</div>
<?php
		echo allRecord($Table);
	
?>
</html>

