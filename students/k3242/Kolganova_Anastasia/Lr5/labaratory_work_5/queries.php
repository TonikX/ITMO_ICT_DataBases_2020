<?php
	header("Content-Type: text/plain; charset=utf-8");
	$dbuser = 'postgres';
	$dbpass = '2001335';
	$host = 'localhost';
	$dbname='Dog_Exhibition';
	
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	$st1 = 'Получить время, прошедшее с даты последней привики каждого участника';
	$query1 = 'SELECT "Participant_id", "Name", age("Last_inoculation") 
				FROM public."Dog";';
	
	$st2 = 'Получить местоположение клубов, в которых числятся участники';
	$query2 = 'SELECT "Participant_id", "Name", "Club_place" 
				FROM public. "Dog" 
				INNER JOIN public. "Club" 
				ON "Dog_club_name" = "Club_name" 
				ORDER BY "Club_place";';
	
	$st3 = 'Вывести суммарное количество баллов выставленных каждым экспертом';
	$query3 = 'SELECT "Participant_dog_id", SUM("Total_score_ring") AS Final_expert_score 
				FROM public."Ring" 
				GROUP BY "Participant_dog_id" 
				ORDER BY Final_expert_score DESC';
	
	$st4 = 'Выводит список выставок в которых участвовали собаки';
	$query4 = 'SELECT "Exhibition_name" 
				FROM public."Exhibition" 
				INNER JOIN public."Dog" 
				ON "Exhibition_id" = "Dog_exhibition_id" 
				GROUP BY "Exhibition_name";';
	
	$st5 = 'Получить время, прошедшее с даты последней выставки от недавно прошедшей к самой давней';
	$query5 = 'SELECT "Exhibition_name", "Exhibition_place", age("Exhibition_date") 
				FROM public."Exhibition" 
				ORDER BY age("Exhibition_date");';
	
	$queries = array($query1, $query2, $query3, $query4, $query5);
	$strs = array($st1, $st2, $st3, $st4, $st5);
	
	for($i=0; $i<5; $i++) {
		$result = pg_query($db, $queries[$i]);
		$NumFields = pg_num_fields($result);
		echo $strs[$i], "\n";
		
		while ($row = pg_fetch_assoc($result)) {
			foreach ($row as $data) {
				echo $data, ' ';
			}
			echo "\n";
		}
		echo "\n";
		echo "\n";
	}
	
	
	pg_close($db);
	
?>