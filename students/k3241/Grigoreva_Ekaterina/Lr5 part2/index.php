<?php
	header("Content-Type: text/plain; charset=utf-8");
	
//	echo 123;

	$dbuser = 'postgres';
	$dbpass = '89214483826';
	$host = 'localhost';
	$dbname= 'Dog_show';

	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	
	$st1 = 'Информация о собаках, принимавших участие в более, чем одной выставке';
	$query1 = 'SELECT "Dog_name"
		FROM show."Dog_participant"
		WHERE "Dog_document_number" = ANY(
			SELECT "Registration"."Dog_document_number" 
			FROM show."Registration"
			GROUP BY "Registration"."Dog_document_number"
			HAVING COUNT("Dog_document_number") > 1)';
	
	$st2 = 'Информация о собаках-участниках, которых оценивает эксперт их того же клуба';
	$query2 = 'SELECT "Expert"."Expert_name", "Expert"."Club", "Dog_name", "Dog_document_number", "Breed"."Arena_number" 
		FROM show."Dog_participant" 
		INNER JOIN show."Breed" on show."Dog_participant"."Breed_name" = show."Breed"."Breed_name"
		INNER JOIN show."Expert" on show."Breed"."Arena_number" = show."Expert"."Arena_number"
		WHERE "Dog_participant"."Club" = "Expert"."Club"
		ORDER BY "Expert_name"';
		
	$st3 = 'Информация о собаках-участниках, которые набрали больше 10 баллов на выставке';
	$query3 = 'SELECT "Сompetition_protocol"."ID_of_contract", "Dog_name", SUM("Сompetition_protocol"."Score")
		FROM show."Сompetition_protocol"
		INNER JOIN show."Registration" ON show."Сompetition_protocol"."ID_of_contract" = show."Registration"."ID_of_contract"
		INNER JOIN show."Dog_participant" ON show."Dog_participant"."Dog_document_number" = show."Registration"."Dog_document_number"
		GROUP BY "Сompetition_protocol"."ID_of_contract", "Dog_name" HAVING SUM("Сompetition_protocol"."Score") > 10
		ORDER BY "ID_of_contract"';

	$st4 = 'Названия всех организаций: спонсоров и клубов';
	$query4 = 'SELECT "Organisation_name" as "Name" FROM show."Sponsors" 
		UNION
		SELECT "Club" as "Name" FROM show."Expert" 
		ORDER BY "Name"';
	
	$st5 = 'Вывод данных о собаках, которые участвовали в выставках, проходивших в первой половине месяца';
	$query5 = 'SELECT "Dog_name", "Breed_name", "Show_name", "Date"
		FROM show."Dog_participant" 
		INNER JOIN show."Registration" ON show."Registration"."Dog_document_number" = show."Dog_participant"."Dog_document_number"
		INNER JOIN show."Show" ON show."Registration"."ID_show" = show."Show"."ID_show"
		WHERE EXTRACT(DAY FROM "Date") > 15
		ORDER BY "Dog_name"';
	
	$queries = array($query1, $query2, $query3, $query4, $query5);
	$strs = array($st1, $st2, $st3, $st4, $st5);
	
	for($i=0; $i<5; $i++) {
		$result = pg_query($db, $queries[$i]);
		$NumFields = pg_num_fields($result);
		echo $strs[$i], "\n";
		
		while ($row = pg_fetch_assoc($result)) {
//			print_r($row);
			foreach ($row as $data) {
				echo $data, ' ';
			}
			echo "\n";
		}
		echo "\n";
		echo "\n";
		
		echo $NumFields, "\n";
	}
	
	
	pg_close($db);
	
?>