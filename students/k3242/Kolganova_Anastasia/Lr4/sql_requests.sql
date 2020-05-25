--Получить местоположение клубов, в которых числятся участники
SELECT "Participant_id", "Name", "Club_place" 
FROM public. "Dog" 
	INNER JOIN public. "Club" 
		ON "Dog_club_name" = "Club_name" 
ORDER BY "Club_place";

--Получить 1d и имя собак участников клуба YellowPigs или PurplePanda в алфавитном лорядке 
SELECT "Participant_id", "Name" 
FROM public."Dog" 
	WHERE "Dog_club_name" = 'YellowPigs' 
		OR "Dog_club_name" = 'PurplePanda' 
ORDER BY "Name" ASC;

--Получить данные о выставке, которая проходит Москве и спонсируется UniKot
SELECT * 
FROM public."Exhibition" 
	WHERE "Exhibition_place" = 'Moscow' 
		AND "Exhibition_sponsor_name" = 'UniKot';
	
--Получить имена собак прошедших медосмотр и набравших более 50 баллов за все испытания в порядке убывания
SELECT "Participant_id", "Name", "Total_dog_score" 
FROM public."Dog"
	WHERE "Medical_results" = 'Passed' 
		AND "Total_dog_score" > 50 
ORDER BY "Total_dog_score" DESC;

--Получить время, прошедшее с даты последней привики каждого участника
SELECT "Participant_id", "Name", age("Last_inoculation") 
FROM public."Dog";

--Получить время, прошедшее с даты последней выставки от недавно прошедшей к самой давней
SELECT "Exhibition_name", "Exhibition_place", age("Exhibition_date") 
FROM public."Exhibition" 
ORDER BY age("Exhibition_date");

--Исправить ошибки регистра в данных ФИО владельца
SELECT INITCAP("Owner_name") 
FROM public."Owner";

--Выводит имена владельцев, у чьих собак неверно заполнены паспортные данные
SELECT "Owner_name" 
FROM public."Owner" 
	WHERE "Owner_id" IN 
		(SELECT "Owner_pass_id" FROM public."Dog" 
		 	WHERE "Participant_pass_id" < 1000000);
			
--Выводит суммарное количество баллов выставленных каждым экспертом
SELECT "Participant_dog_id", SUM("Total_score_ring") AS Final_expert_score 
FROM public."Ring" 
GROUP BY "Participant_dog_id" 
ORDER BY Final_expert_score DESC;

--Выводит список выставок в которых участвовали собаки
SELECT "Exhibition_name" 
FROM public."Exhibition" 
	INNER JOIN public."Dog" 
		ON "Exhibition_id" = "Dog_exhibition_id" 
GROUP BY "Exhibition_name";
