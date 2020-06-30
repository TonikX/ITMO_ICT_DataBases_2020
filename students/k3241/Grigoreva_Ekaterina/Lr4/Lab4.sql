-- Информация о собаках-участниках старше 9 лет, породы пудель, у которых оплачено участие
SELECT * FROM show."Dog_participant" 
WHERE ("Breed_name"='Pudel' AND "Participation_payment" is TRUE AND "Dog_age" < 9)
ORDER BY "Dog_name";


-- Вывод данных об имени хозяина и арене, на которой должна выступать каждая собака
SELECT "Dog_document_number", "Dog_name", "Dog_participant"."Breed_name", "Arena_number", "Owner"."Owner_name" 
FROM show."Dog_participant" 
INNER JOIN show."Breed" on show."Dog_participant"."Breed_name" = show."Breed"."Breed_name"
INNER JOIN show."Owner" on show."Dog_participant"."Owner_passport" = show."Owner"."Owner_passport"
ORDER BY "Dog_name";


-- Информация о собаках-участниках, которых оценивает эксперт их того же клуба
SELECT "Expert"."Expert_name", "Expert"."Club", "Dog_name", "Dog_document_number", "Breed"."Arena_number" 
FROM show."Dog_participant" 
INNER JOIN show."Breed" on show."Dog_participant"."Breed_name" = show."Breed"."Breed_name"
INNER JOIN show."Expert" on show."Breed"."Arena_number" = show."Expert"."Arena_number"
WHERE "Dog_participant"."Club" = "Expert"."Club"
ORDER BY "Expert_name";


-- Информация о собаках-участниках, которые входят в клуб Friend и их имя начинается на "S"
SELECT * FROM show."Dog_participant" WHERE "Dog_name" LIKE 'S%' 
UNION
SELECT * FROM show."Dog_participant" WHERE "Club"='Friend';


-- Вывод данных о собаках, допущенных к участию в выставке Fantom
SELECT "Dog_participant"."Dog_document_number", "Dog_name", "Show_name", "Result"
FROM show."Medical_check"
INNER JOIN show."Dog_participant" ON show."Dog_participant"."Dog_document_number" = show."Medical_check"."Dog_document_number"
INNER JOIN show."Show" ON show."Show"."ID_show"=show."Medical_check"."ID_show"
WHERE "Result"='Allowed' AND "Participation_payment" is TRUE AND "Show_name"='Fantom'
ORDER BY "Dog_name";


-- Информация о собаках-участниках, которые набрали больше 10 баллов на выставке
SELECT "Сompetition_protocol"."ID_of_contract", "Dog_name", SUM("Сompetition_protocol"."Score")
FROM show."Сompetition_protocol"
INNER JOIN show."Registration" ON show."Сompetition_protocol"."ID_of_contract" = show."Registration"."ID_of_contract"
INNER JOIN show."Dog_participant" ON show."Dog_participant"."Dog_document_number" = show."Registration"."Dog_document_number"
GROUP BY "Сompetition_protocol"."ID_of_contract", "Dog_name" HAVING SUM("Сompetition_protocol"."Score") > 10
ORDER BY "ID_of_contract";


-- Вывод данных о шоу, в которых может поучаствовать данная порода
SELECT "Show"."Show_name", "Date", "Location"
FROM show."Show" 
WHERE "ID_show" = ANY(
	SELECT "Registration"."ID_show" FROM show."Registration"
	WHERE "Arena_number" = ANY(
		SELECT "Breed"."Arena_number" FROM show."Breed" WHERE "Breed_name"='Pudel'))
GROUP BY "Show_name", "Date", "Location";


-- Информация о спонсорах шоу, в которых участвуют собаки, чьи клички начинаются на "В"
SELECT "Show"."Organisation_name"
FROM show."Show" 
WHERE "ID_show" = SOME(
	SELECT "Registration"."ID_show" FROM show."Registration"
	WHERE "Dog_document_number" = ANY(
		SELECT "Dog_participant"."Dog_document_number" 
		FROM show."Dog_participant" 
		WHERE "Dog_name" LIKE 'B%')
AND "Organisation_name" IS NOT NULL)
GROUP BY "Organisation_name";


-- Вывод данных о собаках, которые участвовали в выставках, проходивших в первой половине месяца
SELECT "Dog_name", "Breed_name", "Show_name", "Date"
FROM show."Dog_participant" 
INNER JOIN show."Registration" ON show."Registration"."Dog_document_number" = show."Dog_participant"."Dog_document_number"
INNER JOIN show."Show" ON show."Registration"."ID_show" = show."Show"."ID_show"
WHERE EXTRACT(DAY FROM "Date") > 15
ORDER BY "Dog_name";


-- Названия всех организаций: спонсоров и клубов
SELECT "Organisation_name" as "Name" FROM show."Sponsors" 
UNION
SELECT "Club" as "Name" FROM show."Expert" 
ORDER BY "Name";


-- Информация о собаках, принимавших участие в более, чем одной выставке
SELECT "Dog_name"
FROM show."Dog_participant"
WHERE "Dog_document_number" = ANY(
	SELECT "Registration"."Dog_document_number" 
	FROM show."Registration"
	GROUP BY "Registration"."Dog_document_number"
	HAVING COUNT("Dog_document_number") > 1);

