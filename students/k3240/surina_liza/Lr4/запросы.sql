--01.çàïðîñ îòîáðàæàþùèé èìåíà ñëóæàùèõ, ðàáîòàþùèõ ïî âòîðíèêàì è îòñîðòèðîâàííûõ ïî ÔÈÎ
SELECT DISTINCT service.full_name
FROM hotel.timetable, hotel.service
WHERE timetable.weekday = 'tuesday' AND service.id_service = timetable.id_service ORDER BY full_name

--02.çàïðîñ âûâîäèò êîä è öåíó íîìåðà, ñòîèìîñòü êîòîðûõ ïðåâûøàåò 20000ð. è îòñîðòèðîâàííûõ ïî öåíå
ELECT DISTINCT number.number_code, type.price
FROM hotel.number, hotel.type
WHERE type.price > 20000 AND number.type_number = type.type_number ORDER BY price

--03.çàïðîñ ïîêàçûâàåò êîë-âî êëèåíòîâ ïðèáûâøèõ èç Ìîñêâû â 2020
SELECT COUNT(DISTINCT(full_name)) 
FROM hotel.client, hotel.reserv
WHERE city = 'Moscow' AND Right(reserv.input, 4) = '2020'

--04.çàïðîñ âûâîäèò ID ñëóæàùèõ, êîòîðûå ðàáîòàþò íà 12 ýòàæå, íî ïðè ýòîì íå ðàáîòàþò â âîñêðåñåíüå
SELECT timetable.id_service 
FROM hotel.timetable, hotel.number
WHERE number.floor = 12
AND timetable.number_code = number.number_code
AND NOT EXISTS ( 
SELECT timetable.id_service
FROM hotel.timetable, hotel.number
WHERE weekday='sunday')

--05.ïîêàçûâàåò ÔÈÎ è íîìåð â îòåëå
SELECT client.full_name, reserv.code_number
FROM hotel.reserv INNER JOIN hotel.client
ON client.id_client = reserv.id_client

--06.ñ÷èòàåò ñóììó ïîëó÷åííóþ ñ íîìåðîâ íà 3 è 4 ýòàæå
SELECT SUM(total) AS SUM_floor
FROM hotel.report, hotel.number
WHERE report.number_code = number.number_code AND (floor = 4 OR floor = 3)

--07.âûâîäèò öåíó è íîìåð, ó êîòîðûõ îáùàÿ öåíà áîëüøå öåíû âñåõ íîìåðîâ è îòñîðòèðîâàííûõ ïî öåíå 
SELECT DISTINCT number_code, total
FROM hotel.report, hotel.type
WHERE total > ALL(
SELECT price
FROM hotel.type) ORDER BY total

--08.âûâîäèò âñåõ êëèåíòîâ ïî èìåíè Ðèòà èç Ìîñêâû, ñîðòèðîâêà ïî èìåíè
SELECT full_name, city
FROM hotel.client
WHERE (full_name LIKE 'Rita%') AND city = 'Moscow'
 
--09.âûâîäèò êîë-âî ëþäåé âûñåëèâøèõñÿ â èþíå 2020 ãîäà
SELECT COUNT(DISTINCT(full_name))
FROM hotel.client, hotel.reserv
WHERE client.id_client = reserv.id_client
AND left(reserv.output, 5) LIKE '%.06' AND right(reserv.output, 4) = '2020'

--10.âûâîäèò ID ðåãèñòðàöèè, ÔÈÎ êëèåíòîâ íå èç Ìîñêâû, èõ ïàñïîðòíûå äàííûå
SELECT code_reservation, full_name AS name, passport_number AS passport
FROM hotel.client INNER JOIN hotel.reserv 
ON client.id_client = reserv.id_client 
WHERE city != 'Moscow' ORDER BY name
