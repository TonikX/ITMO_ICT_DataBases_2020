<!DOCTYPE html>
<html>
<head>
	<title>Запрос под ключ</title>

	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/custom_query.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
	<script src="js/custom_query.js"></script>

</head>
<body>
<?php session_start(); 
if (isset($_POST['query'])) {
	$_SESSION['custom_query'] = $_POST['query'];
}
?>

<h1>Гостиничка</h1>
<h2>Запросик под ключ</h1>

<form action="custom_query.php" method="POST" id='query-form'>
	<textarea name="query" cols="100" rows="10" id="query-area"><?php  if (isset($_SESSION['custom_query'])) echo $_SESSION['custom_query']; ?></textarea>
	<input type="submit" class='input-submit' name="submit">
</form>


<?php

include 'php/helper.php';

if (isset($_POST['query'])) {
	echo '<h2>Результатик</h2>';
	echoQueryResultTable($_POST['query']);
}


?>

</body>
</html>