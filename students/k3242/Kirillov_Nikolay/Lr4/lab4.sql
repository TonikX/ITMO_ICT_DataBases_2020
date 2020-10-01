/* Запрос 1 Вывод названия дисциплины, учитывая дату, номер урока и класс */
SELECT name_subject FROM school.timetable 
INNER JOIN school.subject ON subject.id_subject = timetable.id_subject 
INNER JOIN school.class ON class.id_class = timetable.id_class 
WHERE date_ = '2020-06-29' AND number_class = '2A' AND lesson_number = 1; 

/* Запрос 2 Вывод имен, оценок, четверти, в которой была получена оценка, 
дисциплины, по которой была получена оценка и тип этой дисциплины (при наличии) учеников,
с сортировкой по имени ученика */
SELECT quarter, name_pupil, grade, name_subject, type_subject FROM school.journale
INNER JOIN school.subject ON subject.id_subject = journale.id_subject
INNER JOIN school.pupil ON pupil.id_pupil = journale.id_pupil
ORDER BY name_pupil

/* Запрос 3 Вывод имен учителей, ведущих физику у заданных классов */
SELECT name_teacher FROM school.teacher 
INNER JOIN school.class ON class.id_teacher = teacher.id_teacher 
INNER JOIN school.subject ON subject.id_teacher = teacher.id_teacher 
WHERE number_class = '8A' OR number_class = '8B' OR number_class = '8V' OR number_class = '8G' AND name_subject = 'Physics'

/* Запрос 4 Вывод имен учеников, у которых 5 по физике за первую четверть */
SELECT name_pupil FROM school.pupil
INNER JOIN school.journale ON journale.id_pupil = pupil.id_pupil
INNER JOIN school.subject ON subject.id_subject = journale.id_subject
WHERE grade = 5 AND name_subject = 'Physics' AND quarter = 1

/* Запрос 5 Вывод средней оценки по физике в школе */
SELECT AVG(grade) FROM school.journale 
INNER JOIN school.subject ON subject.id_subject = journale.id_subject 
WHERE name_subject = 'Physics'

/* Запрос 6 Вывод номеров кабинетов, находящихся выше первого этажа */
SELECT number_office FROM school.office
GROUP by floor_number, id_office HAVING floor_number > 1

/* Запрос 7 Вывод имен учеников, которые учились в школе в 2020 году */
SELECT name_pupil FROM school.pupil 
INNER JOIN school.class ON class.id_teacher = pupil.id_teacher 
INNER JOIN school.timetable ON timetable.id_class = class.id_class
WHERE EXTRACT(YEAR FROM date_) = 2020

/* Запрос 8 Вывод имен учеников, у которых двойка по физике */
SELECT name_pupil FROM school.pupil 
WHERE id_pupil IN (SELECT id_pupil FROM school.journale 
				   WHERE grade = '2' AND id_subject IN (SELECT id_subject FROM school.subject 
														WHERE name_subject = 'Physics'))

/* Запрос 9 Вывод всех людей, которые числятся в школе */
SELECT name_pupil FROM school.pupil
UNION
SELECT name_teacher FROM school.teacher

/* апрос 10 Сколько восьмиклассников учится в школе */
SELECT COUNT(id_pupil) FROM school.pupil INNER JOIN school.class ON class.id_class = pupil.id_class
WHERE number_class LIKE '8%'
