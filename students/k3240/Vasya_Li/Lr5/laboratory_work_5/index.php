  <!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Редактор БД "Луч"</title>
  <link rel="stylesheet" type="text/css" href="head.css" >
</head>
<body>
<div class="mainHead">
<form  method="get">
<select name="table" >
<?php
require('connection.php');
	$sql = "SELECT table_name  FROM information_schema.tables WHERE table_schema='public'";
	$sth = $pdo->prepare($sql);
    $sth->execute();
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);;
	 for($i=0; $i<count($data); $i++){ 
		echo '<option>  ';
		 echo  $data[$i]['table_name'];
		 echo  '</option>';
	 }
?>
<input class="mainButton" type="submit" value="выбрать">
</form>
</select>
</div>
<?php
	session_start();
	if(isset($_GET['table'])){
	$_SESSION["table"]= $_GET['table'];
	}
?>
<br/>
<div class="selectedTable">
	<a href="tables.php"><?php echo $_SESSION["table"]?></a><br/>
</div>
</body>
</html>