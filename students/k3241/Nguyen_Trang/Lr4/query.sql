SELECT first_name, last_name, discipline_name, assessment FROM discipline
INNER JOIN lecturer ON discipline.discipline_id = lecturer.discipline_id
ORDER BY lecturer.first_name;


SELECT * FROM discipline
WHERE discipline_name != 'Foreign Language' AND assessment = 'Exam';


SELECT group_name, discipline_name, first_name, last_name, address, time FROM time_table 
INNER JOIN lecturer ON lecturer.lecturer_id = time_table.lecturer_id
INNER JOIN discipline ON discipline.discipline_id = time_table.discipline_id
WHERE time_table.time <= '2020-06-01';


UPDATE time_table SET address = 'Birzhevaya Liniya, 14'
WHERE address = 'Kronverkskiy Prospekt, 49';


SELECT discipline_name, CONCAT(lecturer.first_name, ' ', lecturer.last_name) from lecturer
INNER JOIN discipline ON discipline.discipline_id = lecturer.discipline_id;


SELECT group_name, address, time FROM time_table
WHERE group_name IN(
SELECT group_name FROM public.group
WHERE group_name != 'K3244');


SELECT 
	COUNT(*) AS total_student,
	MAX(point) AS highest_grade,
	MIN(point) AS lowest_grade,
	ROUND(AVG(point), 1) AS avg_grade
FROM grade;


SELECT student_id, ROUND(AVG(point), 2) AS avg_point FROM public.grade
GROUP BY student_id
HAVING AVG(point) >= 91;



SELECT manager_name FROM manager
WHERE EXISTS
(SELECT * FROM manager WHERE manager_id IS NOT NULL);


SELECT first_name, last_name FROM lecturer
WHERE lecturer_id = ANY (SELECT lecturer_id FROM office WHERE address IS NOT NULL);


SELECT group_name, discipline_id, sumary_report FROM public.group
WHERE discipline_id = ALL (SELECT discipline_id FROM discipline WHERE discipline_name = 'Maths');


SELECT first_name, last_name FROM lecturer
WHERE lecturer_id = SOME (SELECT lecturer_id FROM students WHERE first_name != 'Andrey')


SELECT group_name, first_name, last_name FROM public.group natural join students where discipline_id > 2 UNION
SELECT group_name, first_name, last_name FROM public.group natural join students where discipline_id = 1;


SELECT group_name, student_id FROM public.group NATURAL JOIN students WHERE first_name = 'Sergey' INTERSECT
SELECT group_name, student_id FROM public.group NATURAL JOIN students WHERE first_name = 'Ekaterina';


SELECT group_name, student_id, last_name FROM public.group NATURAL JOIN students WHERE first_name = 'Sergey' EXCEPT
SELECT group_name, student_id, last_name FROM public.group NATURAL JOIN students WHERE first_name = 'Ekaterina';

