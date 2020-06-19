--
--1.Список абитуриентов подавших документы на заданную специальность (Finance специальность в данном случае):
--
SELECT "Enrollee"."Name", "Specialty"."Name", "Specialty"."Basis"
FROM "Students"."Enrollee"
INNER JOIN "Students"."Request"
ON "Enrollee"."ID_Enrollee" = "Request"."ID_Enrollee"
INNER JOIN "Students"."Specialty"
ON "Specialty"."ID_Specialty" = "Request"."ID_Specialty"
WHERE "Specialty"."Name" = 'Finance'

--
--2.Количество абитуриентов, подавших заявления на каждую специальность по каждой форме обучения на контракт:
--
SELECT "Specialty"."Name", "Request"."Form", COUNT("Request"."ID_Enrollee")
FROM "Students"."Request"
INNER JOIN "Students"."Specialty"
ON "Request"."ID_Specialty" = "Specialty"."ID_Specialty"
INNER JOIN "Students"."Form"
ON "Request"."Form" = "Form"."Type"
WHERE "Specialty"."Basis" = 'Contract'
GROUP BY "Specialty"."Name", "Request"."Form"

--
--3.Кол-во абитуриентов на базе 9 и 11 классов, поступающих на бюджет (с сортировкой):
--
SELECT "Enrollee"."Base", COUNT("Enrollee"."Base")
FROM "Students"."Enrollee"
INNER JOIN "Students"."Request"
ON "Enrollee"."ID_Enrollee" = "Request"."ID_Enrollee"
INNER JOIN "Students"."Specialty"
ON "Specialty"."ID_Specialty" = "Request"."ID_Specialty"
WHERE "Specialty"."Basis" = 'Budget'
GROUP BY "Enrollee"."Base"
ORDER BY "Enrollee"."Base"

--
--4.Общее кол-во поданных заявлений 
--
SELECT "Request"."Date" AS date, COUNT("Request"."Date")
FROM "Students"."Request"
GROUP BY date
ORDER BY date

--
--5.Конкурс на каждую специальность по каждой форме обучения на бюджет:
--
SELECT "Specialty"."Name" AS specialty, ROUND(CAST(COUNT("Request"."ID_Enrollee") AS NUMERIC) / CAST("Specialty"."Number_of_places" AS NUMERIC), 2) AS competition
FROM "Students"."Request"
INNER JOIN "Students"."Specialty"
ON "Request"."ID_Specialty" = "Specialty"."ID_Specialty"
WHERE "Specialty"."Basis" = 'Budget'
GROUP BY "Specialty"."Name", "Specialty"."Number_of_places"

--
--6.Выдать кол-во заявлений поданных в период с 2018-07-13 по 2018-07-16 (предикат BETWEEN):
--
SELECT COUNT("Request"."Date"), "Request"."Date" 
FROM "Students"."Request"
WHERE "Request"."Date" BETWEEN '2018-07-13' AND '2018-07-16'
GROUP BY "Request"."Date"

--
--7.Вывод таблицы среднего балла по каждой специальности на базе 11 классов (использование HAVING):
--
SELECT "Specialty"."Name", ROUND(AVG("Request"."Rating"), 2)
FROM "Students"."Request"
INNER JOIN "Students"."Specialty"
ON "Request"."ID_Specialty" = "Specialty"."ID_Specialty"
INNER JOIN "Students"."Enrollee"
ON "Request"."ID_Enrollee" = "Enrollee"."ID_Enrollee"
GROUP BY "Specialty"."Name", "Enrollee"."Base"
HAVING "Enrollee"."Base" = '11'

--
--8.Вывод таблицы факультетов без специальностей:
--
SELECT "Faculty"."ID_Faculty", "Faculty"."Name", "Specialty"."Name" FROM "Students"."Faculty"
LEFT JOIN "Students"."Specialty"
ON "Faculty"."ID_Faculty" = "Specialty"."ID_Faculty"
WHERE "Specialty"."ID_Specialty" IS NULL

--
--9.Вывод кросстаблицы количества абитуриентов, подавших заявления на каждую специальность на контракт и бюджет:
--
CREATE EXTENSION IF NOT EXISTS TABLEFUNC;
SELECT * 
FROM CROSSTAB2('
	SELECT "Specialty"."Name" AS Specialty, "Specialty"."Basis", COUNT("Request"."ID_Enrollee")::TEXT
	FROM "Students"."Request"
	INNER JOIN "Students"."Specialty"
	ON "Request"."ID_Specialty" = "Specialty"."ID_Specialty"
	GROUP BY "Specialty"."Name", "Specialty"."Basis"
	ORDER BY "Specialty"."Name", "Specialty"."Basis"
	')
	AS ct (Specialty , Budget , Contract);

--
--10.Кол-во принятых заявлений по дням недели с сортировкой по убыванию:
--
SELECT TO_CHAR("Request"."Date", 'Day') as weekday, COUNT(TO_CHAR("Request"."Date", 'Day')) as capacity
FROM "Students"."Request"
GROUP BY weekday
ORDER BY capacity DESC

--
--11.Вывод имен и рейтинга абитуриентов на базе 11-х классов, где рейтинг абитуриентов выше, чем у абитуриента ('Danil'):
--
SELECT "Enrollee"."Name", "Request"."Rating"
FROM "Students"."Enrollee"
INNER JOIN "Students"."Request"
ON "Enrollee"."ID_Enrollee" = "Request"."ID_Enrollee"
WHERE "Enrollee"."Base" = '11' AND "Request"."Rating" >
(SELECT "Request"."Rating"
FROM "Students"."Enrollee"
INNER JOIN "Students"."Request"
ON "Enrollee"."ID_Enrollee" = "Request"."ID_Enrollee"
WHERE "Enrollee"."Name" = 'Danil')

--
--12.Вывод перевернутых имен абиуриентов (стороковая функция):
--
SELECT REVERSE("Enrollee"."Name")
FROM "Students"."Enrollee"