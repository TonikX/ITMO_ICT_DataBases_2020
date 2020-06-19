-- Какой предмет будет на 3 уроке в заданном классе 20 апреля 2020 года ?
SELECT sbj."name" from public."Schedule" sch
JOIN public."Discipline" dis ON dis."id_Discipline" = sch."id_Discipline"
JOIN public."Subject" sbj ON sbj."id_Subject" = dis."id_Subject"
WHERE order_class = '3' AND date = '2020-04-20'

-- Какие ученики прошли тест по английскому языку на уровень "INTERMEDIATE"?
SELECT "first_name", "last_name", "id_Class" from public."Student"
WHERE "id_Student" in (SELECT "id_Student" FROM public."Student"
					   EXCEPT (SELECT "id_Student" from public."Journal" jrn WHERE jrn."id_Discipline" != 5 ))

-- Вывести имена и оценки учеников всех классов школы
select cl."id_Class", cl."id_Teacher", cl."begining_education", cl."end_education", st."first_name", st."last_name", jr."mark", sub."name"
from public."Class" cl 
join public."Student" st ON st."id_Class" = cl."id_Class"
join public."Journal" jr ON st."id_Class" = cl."id_Class"
join public."Discipline" dis on jr."id_Discipline" = dis."id_Discipline"
join public."Subject" sub on dis."id_Subject" = sub."id_Subject"
order by cl."id_Class".

-- Преподавателю Василисе Акифьевой директор назначил личный кабинет "11".
UPDATE public."Teacher"
SET "id_Cabinet" = '11'
WHERE first_name = 'Василиса' and last_name = 'Акифьева'

-- Расписание на заданный день для указанного класса?
SELECT sch."date", sch."order_class", sch."id_Class", sub."name"
FROM public."Schedule" sch
INNER JOIN public."Discipline" dis on dis."id_Discipline" = sch."id_Discipline"
INNER JOIN public."Subject" sub on sub."id_Subject" = dis."id_Subject"
WHERE sch."id_Class" = 3 and sch.date = '2020-04-20'

-- Кто преподает английский язык уровня "INTERMEDIATE"?
SELECT "first_name", "last_name" 
FROM public."Teacher"
WHERE "id_Teacher" = ANY (SELECT "id_Teacher"
					      FROM public."Discipline"
					      WHERE "id_Subject" = 
						        (SELECT "id_Subject" from public."Subject"
						         WHERE name = 'Английский язык')
						  AND "type" = 'INTERMEDIATE')

-- Сколько учеников учатся в 3 классе? 
SELECT COUNT(*) number_of_students
FROM public."Student"
WHERE "id_Class" = '3'

-- Имена учителей, у которых личные кабинеты находятся на 1 этаже.
SELECT first_name, last_name
FROM public."Teacher" tch
JOIN public."Cabinet" cab ON cab."id_Cabinet" = tch."id_Cabinet"
WHERE cab."floor" = '1'

-- У каких классов будут выпускные в 2025 году ?
SELECT "name" FROM public."Class"
WHERE "end_education" BETWEEN '2025-01-01' AND '2025-12-31'

-- Номера кабинетов, которые находятся выше 1 этажа.
SELECT "id_Cabinet", "floor" from public."Cabinet"
GROUP by "floor", "id_Cabinet" HAVING "floor" > 1

-- Вывести информации о именах, классе, оценки студентов, за 1 четверть.
SELECT std."first_name", std."last_name", cls."name", jrn."mark" 
FROM public."Student" std
JOIN public."Journal" jrn ON std."id_Student" = jrn."id_Student"
JOIN public."Class" cls ON std."id_Class" = cls."id_Class"
WHERE jrn."quarter" = '1'