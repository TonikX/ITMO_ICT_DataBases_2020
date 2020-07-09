-- 1) имена адмимнистраторов и клиентов отчество которых совпадает

SELECT "Administrator"."FirstName", "Customer"."FirstName" 
FROM public."Administrator", public."Customer" 
WHERE "Customer"."SecondName" = "Administrator"."SecondName";

--2) работники, у которых в имени есть частица "на"

SELECT "workerID", "FirstName", "LastName"
FROM "Workers"
WHERE "FirstName" LIKE '%на%'
ORDER BY "workerID"

--3) День недели, когда на одном этаже убирается мимнимум 2 работника

SELECT "Weekday", COUNT("WorkerID")
FROM "Timetable"
GROUP BY "Weekday"
HAVING COUNT("WorkerID") >= 2

--4) Количество работников в гостинице, которые работают на протяжении всего месяца

SELECT COUNT("Workers"."WorkerID") FROM "Workers"
WHERE "WorkerID" = ANY(
	SELECT "WorkerID" FROM "Workers"
	INTERSECT
	SELECT "WorkerID" FROM "Logs"
	Where "Date" IS NOT Null
)

--5)Число работников убиравших этажи за период с 10 апреля 2020 по 20 апреля 2020:

SELECT "FloorID", COUNT("WorkersID") FROM "Logs"
WHERE "Date" BETWEEN '2020-04-10' AND '2020-04-20'
GROUP BY "floorID"

--6) Весь персонал гостиницы

SELECT "FirstName" AS "Имя", "SecondName" AS "Отчество", "LastName" AS "Фамилия" FROM "Workers"
UNION
SELECT "FirstName", "SecondName", "LastName" FROM "Administrator"

--7)число типов номеров, ежедневная стоимость которых составляет от 100 до 400 рублей за один номер

SELECT "RoomID", COUNT("TypeID") FROM "Room"
WHERE "DailyPrice" BETWEEN '100' AND '400'
GROUP BY "RoomID"

--8) Кто из работников убирал номер клиента с CustomerID = 7 во вторник:

SELECT "Workers"."WorkerID", "Workers"."FirstName",  "Workers"."LastName"
FROM "Contract"
INNER JOIN "Room" ON "Contract"."RoomID" = "Room"."RoomID"
INNER JOIN "Timetable" ON "Room"."FloorID" = "Timetable"."FloorID"
INNER JOIN "Workers" ON "Timetable"."WorkerID" = "Workers"."WorkerID"
WHERE "CustomerID" = 7
AND "Weekday" = 2

-- 9) Имена работников, убиравших этаж с FloorID = 2, начиная с 15 апреля 2020 года:

SELECT "Logs"."Date", "Workers"."FirstName"
FROM "Logs" 
INNER JOIN "Workers" ON "Logs"."WorkerID" = "Workers"."WorkerID"
WHERE "Logs"."Date" >= '2020-04-15'
AND "Logs"."FloorID" = 2
 
--10) Количество клиентов, прибывших из Астаны:

SELECT COUNT(*) FROM "Customer"
WHERE "Customer"."City" = 'Астана'

--11) Количество клиентов, прибывших 2000-02-12:

SELECT COUNT(*) FROM "Customer"
WHERE "Customer"."Date" = '2000-02-12'
