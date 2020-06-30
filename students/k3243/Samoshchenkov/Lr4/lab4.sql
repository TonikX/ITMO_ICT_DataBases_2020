--- Вывести все идентификаторы медицинских карточек, значение которых больше двух и не равно четырём:
SELECT "Clinic"."Medical_book".ID_med_book FROM "Clinic"."Medical_book" 
WHERE "Clinic"."Medical_book".ID_med_book > 1 AND "Clinic"."Medical_book".ID_med_book != 4

--- Вывести всех пациетов, исключая тех, чей пол является мужским:
SELECT "Clinic"."Patient".Patient_name FROM "Clinic"."Patient"
WHERE "Clinic"."Patient".ID_patient IN (SELECT "Clinic"."Patient".ID_patient FROM "Clinic"."Patient" 
EXCEPT (SELECT "Clinic"."Patient".ID_patient FROM "Clinic"."Patient"
WHERE "Clinic"."Patient".Patient_sex = 'male'))
--- Вывести врачей-гинекологов и их года рождения:
SELECT "Clinic"."Doctor".Doctor_Name, "Clinic"."Doctor".Doctor_Date_of_birth FROM "Clinic"."Doctor" 
WHERE "Clinic"."Doctor".Specialization = ALL(SELECT "Clinic"."Doctor".Specialization FROM "Clinic"."Doctor" 
WHERE "Clinic"."Doctor".Specialization = 'Gynecologist' )

---Вывести количество пациентов
SELECT COUNT(*) FROM "Clinic"."Patient"

--- Вывести идентификаторы, имена и даты рождения врачей, чьи имена начинаются на «М»:
SELECT "Clinic"."Doctor".ID_Doctor, "Clinic"."Doctor".Doctor_Name,"Clinic"."Doctor".Doctor_Date_of_birth FROM "Clinic"."Doctor" 
WHERE "Clinic"."Doctor".Doctor_Name LIKE 'M%'
ORDER BY ID_Doctor ASC;

--- Вывести время и день недели приёма в кабинете с идентификатором «1»
SELECT "Clinic"."Reception".Reception_Date_Time FROM "Clinic"."Reception" 
INNER JOIN "Clinic"."Room" ON "Clinic"."Reception".ID_reception = "Clinic"."Room".ID_room
WHERE "Clinic"."Room".ID_room = 1
GROUP BY "Clinic"."Reception".Reception_Date_Time

--- Вывести идентификаторы и цены на услуги, стоящие дороже 900
SELECT "Clinic"."Pricelist".ID_price, "Clinic"."Pricelist".Service_price FROM "Clinic"."Pricelist" 
GROUP BY "Clinic"."Pricelist".ID_price
HAVING "Clinic"."Pricelist".Service_price > 900
--- Вывести всю информацию из медицинской карты с наивысшим номером приёма:
SELECT DISTINCT "Clinic"."Medical_book".* 
FROM "Clinic"."Medical_book" 
WHERE NOT "Clinic"."Medical_book".Receptions < SOME (SELECT "Clinic"."Medical_book".Receptions FROM "Clinic"."Medical_book")

--- Исправить ошибки регистра в ФИО владельцев медицинских карт:
SELECT INITCAP("Clinic"."Medical_book".Owner_name) FROM "Clinic"."Medical_book"

--- Вывести ФИО пациентов из таблицы пациентов и их же ФИО из медицинских карточек:
SELECT "Clinic"."Patient".Patient_name, "Clinic"."Patient".ID_patient, 'patient' FROM "Clinic"."Patient"
UNION SELECT "Clinic"."Medical_book".Owner_name, "Clinic"."Medical_book".FK_ID_patient, 'the same patient' FROM "Clinic"."Medical_book"
ORDER BY ID_patient

--- Вывести пациентов и их диагнозы:
SELECT "Clinic"."Medical_book".Owner_name, "Clinic"."Medical_book".FK_ID_Diagnose, "Clinic"."Diagnoses".Diagnose_name FROM "Clinic"."Medical_book"
INNER JOIN "Clinic"."Diagnoses" ON "Clinic"."Medical_book".FK_ID_Diagnose = "Clinic"."Diagnoses".ID_Diagnose
ORDER BY FK_ID_Diagnose
--- Вывести номер кабинета, в котором принимали Анну Ахматову:
SELECT "Clinic"."Room".Room_num FROM "Clinic"."Room" 
WHERE "Clinic"."Room".ID_Room = ANY (SELECT "Clinic"."Reception".FK_ID_Room FROM "Clinic"."Reception" 
WHERE "Clinic"."Reception".FK_ID_med_book = (SELECT "Clinic"."Medical_book".ID_med_book FROM "Clinic"."Medical_book" 
WHERE "Clinic"."Medical_book".Owner_name = 'Ann Ahmatova'))

--- Вывести суммарный доход со всех уже оплаченных приёмов:
SELECT SUM("Clinic"."Payment".Summ) AS Income FROM "Clinic"."Payment" 
WHERE Status = 1

--- Вывести ФИО и специальность врача, к которому обращалась Анна Ахматова:
SELECT "Clinic"."Doctor".Doctor_name, "Clinic"."Doctor".Specialization FROM "Clinic"."Doctor"
INNER JOIN "Clinic"."Reception" ON "Clinic"."Doctor".ID_Doctor = "Clinic"."Reception".FK_ID_Doctor
INNER JOIN "Clinic"."Medical_book" ON "Clinic"."Reception".FK_ID_med_book = "Clinic"."Medical_book".ID_med_book
WHERE "Clinic"."Medical_book".Owner_name = 'Ann Ahmatova'

--- Вывести время и день недели работы нарколога:
SELECT "Clinic"."Schedule".Working_time, "Clinic"."Schedule".Day_of_week FROM "Clinic"."Schedule"
JOIN "Clinic"."Doctor" ON "Clinic"."Schedule".FK_ID_Doctor = "Clinic"."Doctor".ID_doctor
WHERE "Clinic"."Doctor".Specialization = 'Narcologist'
