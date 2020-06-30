<?php

$dbuser = 'postgres';
$dbpass = '135790';
$host = 'localhost';
$dbname= 'Library';

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);

$qstn = '1) Книги, закрепленные за определенным читателем с ID = 6: ';
$req = 'SELECT DISTINCT "Name"
		FROM "Book", "Book_instance"
		WHERE "Book"."ID_book" = "Book_instance"."ID_book"
		AND "ID_instance" IN (SELECT "ID_instance" FROM "Getting_book" WHERE
		"ID_reader" = 6)
		ORDER BY "Name"';
$stmt = $pdo->query($req);
while ($row = $stmt->fetch()) {
	echo $qstn, $row['Name'] . "<br />";
}

$qstn = '2) Читатели, которые взяли книгу более месяца тому назад: ';
$req = 'SELECT "Name"
		FROM "Reader"
		INNER JOIN "Getting_book"
		ON "Reader"."ID_reader" = "Getting_book"."ID_reader"
		WHERE CURRENT_DATE - "Date_of_receiving" > 31
		ORDER BY "Name"';
$stmt = $pdo->query($req);
echo $qstn . "<br />";
while ($row = $stmt->fetch()) {
	echo $row['Name'] . "<br />";
}

$qstn = '3) Читатели, у которых количество экземпляров книг в библиотеке более 10: ';
$req = 'SELECT "Reader"."Name"
		FROM "Reader"
		INNER JOIN "Getting_book"
		ON "Reader"."ID_reader" = "Getting_book"."ID_reader"
		INNER JOIN "Book_instance"
		ON "Getting_book"."ID_instance" = "Book_instance"."ID_instance"
		INNER JOIN "Book"
		ON "Book_instance"."ID_book" = "Book"."ID_book"
		WHERE "Book"."ID_book" = ANY (SELECT "ID_book" FROM
		"Number_of_instances_in_r/r" WHERE "Number_of_instances" > 10)
		ORDER BY "Name"';
$stmt = $pdo->query($req);
echo $qstn . "<br />";
while ($row = $stmt->fetch()) {
	echo $row['Name'] . "<br />";
}

$qstn = '4) Читателей младше 30 лет: ';
$req = 'SELECT COUNT("ID_reader")
		FROM "Reader"
		WHERE EXTRACT(YEAR FROM AGE(CURRENT_DATE, "Date_of_birth")) < 30';
$stmt = $pdo->query($req);
echo $qstn;
while ($row = $stmt->fetch()) {
	echo $row['count'] . "<br />";
}

$qstn = '5) Список читателей, которые закреплены за залом с номером 3: ';
$req = 'SELECT "Name"
		FROM "Reader"
		INNER JOIN "Creation_new_reader"
		ON "Reader"."ID_reader" = "Creation_new_reader"."ID_reader"
		WHERE "ID_room" = ANY (SELECT "ID_room" FROM "Reading_room"
		WHERE "Number" = 3)
		ORDER BY "Name"';
$stmt = $pdo->query($req);
echo $qstn . "<br />";
while ($row = $stmt->fetch()) {
	echo $row['Name'] . "<br />";
}

?>