<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div align="left"><a href='index.php'>Main</a></div>
		<div align="left"><a href='dog_insert.php'>Add data to Dog</a></div>
		<div align="left"><a href='dog_delete.php'>Delete data from Dog</a></div>
		<hr>
		<h3>Изменить собаку участника</h3>
		<ul>
			<form name="change" action="dog_change.php" method="POST" >
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
				<ul><input type="submit" name="Change" /></ul>
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
	if (isset($_POST["Change"])) {
            $infoA = "update $DogTable set \"Name\"='$_POST[Name]', \"Type\"='$_POST[Type]', \"Age\"='$_POST[Age]', \"Class\"='$_POST[Class]', \"Last_inoculation\"='$_POST[Last_inoculation]', \"Medical_results\"='$_POST[Medical_results]', \"Total_dog_score\"='$_POST[Total_dog_score]', \"Participant_pass_id\"='$_POST[Participant_pass_id]', \"Dog_club_name\"='$_POST[Dog_club_name]', \"Dog_exhibition_id\"='$_POST[Dog_exhibition_id]', \"Dog_exhibition_name\"='$_POST[Dog_exhibition_name]', \"Owner_pass_id\"='$_POST[Owner_pass_id]' where \"Participant_id\"='$_POST[Participant_id]'";
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