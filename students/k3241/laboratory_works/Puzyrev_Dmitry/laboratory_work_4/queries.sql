-- 1. Имена клиентов, проживавших в номере с RoomID = 1, начиная с 4 декабря 2019 года:
SELECT "Accomodation"."StartDate", "Accomodation"."EndDate", "Customer"."FirstName"
FROM "Accomodation" 
INNER JOIN "Customer" ON "Accomodation"."CustomerID" = "Customer"."CustomerID"
WHERE "Accomodation"."StartDate" >= '2019-12-04'
AND "Accomodation"."RoomID" = 1

-- 2. Количество клиентов, прибывших из Москвы:
SELECT COUNT(*) FROM "Customer"
WHERE "Customer"."City" = 'Москва'

-- 3. Кто из служащих убирал номер клиента с CustomerID = 1 в понедельник:
SELECT "Servant"."ServantID", "Servant"."FirstName"
FROM "Accomodation"
INNER JOIN "Room" ON "Accomodation"."RoomID" = "Room"."RoomID"
INNER JOIN "CleaningSchedule" ON "Room"."FloorID" = "CleaningSchedule"."FloorID"
INNER JOIN "Servant" ON "CleaningSchedule"."ServantID" = "Servant"."ServantID"
WHERE "CustomerID" = 1
AND "Weekday" = 1

-- 4. Количество свободных номеров в гостинице:
SELECT COUNT("RoomID") FROM "Room"
WHERE "RoomID" = ANY(
	SELECT "RoomID" FROM "Room"
	INTERSECT
	SELECT "RoomID" FROM "Accomodation"
	WHERE "EndDate" IS NULL
)

-- 5. Клиенты с указанием их городов, которые жили в то же время, что и клиент с CustomerID = 1:
SELECT "Customer"."CustomerID","Customer"."FirstName", "Customer"."City" FROM "Accomodation"
INNER JOIN "Customer" ON "Accomodation"."CustomerID" = "Customer"."CustomerID"
WHERE ("StartDate" BETWEEN (SELECT "StartDate" FROM "Accomodation" WHERE "CustomerID" = 1)
		AND (SELECT "EndDate" FROM "Accomodation" WHERE "CustomerID" = 1))
OR ("EndDate" BETWEEN (SELECT "StartDate" FROM "Accomodation" WHERE "CustomerID" = 1)
		AND (SELECT "EndDate" FROM "Accomodation" WHERE "CustomerID" = 1))
EXCEPT
SELECT "Customer"."CustomerID","Customer"."FirstName", "Customer"."City"
FROM "Customer" WHERE "CustomerID" = 1

-- 6. Число клиентов за период с декабря 2019 по февраль 2020 в каждом номере:
SELECT "RoomID", COUNT("CustomerID") FROM "Accomodation"
WHERE "StartDate" BETWEEN '2019-12-1' AND '2020-02-29'
GROUP BY "RoomID"

-- 7. Клиенты, имена которых начинаются на «А», в алфавитном порядке:
SELECT "CustomerID", "FirstName", "MiddleName", "LastName", "City"
FROM "Customer"
WHERE "FirstName" LIKE 'А%'

-- 8. Дни недели, в которые производится уборка больше чем двумя сотрудниками:
SELECT "Weekday", COUNT("ServantID")
FROM "CleaningSchedule"
GROUP BY "Weekday"
HAVING COUNT("ServantID") > 2

-- 9. Весь обслуживающий персонал, включая как администраторов, так и уборщиков:
SELECT "FirstName", "MiddleName" FROM "Servant"
UNION
SELECT "FirstName", "MiddleName" FROM "Administrator"

-- 10. Клиенты в порядке их выселения (от недавних к старым), при этом, если EndDate = NULL (еще не выселился), то будем сравнивать дату заселения:
SELECT "CustomerID", "StartDate", "EndDate"
FROM "Accomodation"
ORDER BY
(CASE
WHEN "EndDate" IS NULL THEN "StartDate"
ELSE "EndDate"
END) DESC