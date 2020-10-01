<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div align="left"><a href='index.php'>Main</a></div>
		<div align="left"><a href='dog_change.php'>Change data in Dog</a></div>
		<div align="left"><a href='dog_delete.php'>Delete data from Dog</a></div>
		<hr>
		<h3>Добавить собаку участника</h3>
		<ul>
			<form name="insert" action="dog_insert.php" method="POST" >
				<ul>ID собаки:</ul><ul><input type="int" name="Participant_id"/></ul>
				<ul>Название собаки:</ul><ul><input type="text" name="Name"/></ul>
				<ul>Тип собаки:</ul><ul><input type="text" name="Type"/></ul>
				<ul>Возраст собаки:</ul><ul><input type="int" name="Age"/></ul>
				<ul>Классность собаки:</ul><ul><input type="text" name="Class"/></ul>
				<ul>Дата последней привики:</ul><ul><input type="date" name="Last_inoculation"/></ul>
				<ul>Результат медицинской проверки:</ul><ul><input type="text" name="Medical_results"/></ul>
				<ul>Колличество баллов:</ul><ul><input type="int" name="Total_dog_score"/></ul>
				<ul>Номер паспорта собаки:</ul><ul><input type="int" name="Participant_pass_id"/></ul>
				<ul>Название клуба:</ul><ul><input type="text" name="Dog_club_name"/></ul>
				<ul>ID выставки:</ul><ul><input type="int" name="Dog_exhibition_id"/></ul>
				<ul>Название выставки:</ul><ul><input type="text" name="Dog_exhibition_name"/></ul>
				<ul>Номер паспорта владельца:</ul><ul><input type="int" name="Owner_pass_id"/></ul>
				<ul><input type="submit" name="Add" /></ul>
			</form>
		</ul>
		<hr>
	</body>
</html>


<?php
echo "<br/>";
$dbuser = 'postgres';
$dbpass = '2001335';
$host = 'localhost';
$dbname='Dog_Exhibition';
$DogTable = '"public"."Dog"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["Add"])) {
            $infoA = "insert into $DogTable values ('$_POST[Participant_id]', '$_POST[Name]', '$_POST[Type]', '$_POST[Age]', '$_POST[Class]', '$_POST[Last_inoculation]', '$_POST[Medical_results]', '$_POST[Total_dog_score]', '$_POST[Participant_pass_id]', '$_POST[Dog_club_name]', '$_POST[Dog_exhibition_id]', '$_POST[Dog_exhibition_name]', '$_POST[Owner_pass_id]')";
            $result = pg_query($db, $infoA);
			$result = pg_fetch_all($result);
			pg_close($db);
         }
}

$dbuser = 'postgres';
$dbpass = '2001335';
$host = 'localhost';
$dbname='Dog_Exhibition';
$DogTable = '"public"."Dog"';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
$info = "select * from $DogTable";
$result = pg_query($db, $info);
$result = pg_fetch_all($result);
foreach ($result as $value) {
	echo "----------------------<br/>";
	foreach ($value as $key => $value) {
		echo "|  $key = $value <br/>";
	}
}; echo" ----------------------<br/>";
?>