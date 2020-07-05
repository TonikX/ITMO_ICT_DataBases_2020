-- Показать ФИО пациентов и даты приёма пациентов с сортировкой по дате приёма:

SELECT fio_patient, date_meet FROM hospital.patient, hospital.meet WHERE patient.id_patient=meet.id_patient ORDER BY date_meet

-- Показать ФИО докторов, их специальность, начало и конец работы с сортировкой по специальности врача в порядке возрастания:

SELECT fio_doctor, specialty, time_start, time_end FROM hospital.doctor, hospital.schedule WHERE doctor.id_doctor=schedule.id_doctor ORDER BY specialty ASC;

-- Показать ФИО пациентов, их даты установки диагноза и статус оплаты с сортировкой по дате установки диагноза в порядке убывания:

SELECT fio_patient, date_disease, payment_state FROM hospital.patient, hospital.med_card, hospital.meet WHERE patient.id_patient=med_card.id_patient AND patient.id_patient=meet.id_patient ORDER BY date_disease DESC

-- Показать название услуги, стоимость услуги, дату приёма, время приёма и ФИО доктора с сортировкой по стоимости услуги в порядке возрастания:

SELECT name_service, price_service, date_meet, time_meet, fio_doctor FROM hospital.pricelist, hospital.meet, hospital.doctor WHERE pricelist.id_service=meet.id_service AND meet.id_doctor=doctor.id_doctor ORDER BY price_service ASC

-- Показать названия услуг, их стоимость, ФИО пациентов и статус оплаты, где стоимость услуги равна больше 1000, а статус оплаты равен true:

SELECT name_service, price_service, fio_patient, payment_state FROM hospital.pricelist, hospital.patient, hospital.meet WHERE patient.id_patient=meet.id_patient AND pricelist.id_service=meet.id_service AND price_service > 1000 AND payment_state=true

-- Показать ФИО пациентов с названием диагноза «Коронавирус» и статусом заболевания «Обнаружено»:

SELECT fio_patient, name_disease, status_disease FROM hospital.patient, hospital.disease, hospital.med_card WHERE patient.id_patient=med_card.id_patient AND disease.id_disease=med_card.id_disease AND disease.name_disease='Coronavirus' AND med_card.status_disease='Обнаружено'

-- Показать ФИО врачей мужского пола со специальностью «Главный врач»:

SELECT fio_doctor, gender, specialty FROM hospital.doctor WHERE gender='Мужской' AND specialty='Главный врач'

-- Показать ФИО пациентов со статусом приёма «Вылечено» и датой приёма не ранее 2020-01-01:

SELECT fio_patient, current_state FROM hospital.patient, hospital.meet WHERE current_state='Вылечено' AND date_meet>DATE('2020-01-01') AND patient.id_patient=meet.id_patient

-- Показать ФИО пациентов и дату их рождения, если дата рождения меньше 1970-01-01:

SELECT fio_patient, birthday_date_patient FROM hospital.patient
WHERE patient.birthday_date_patient<DATE('1970-01-01')

-- Показать ФИО пациентов с датой приёма 2020-05-16:

SELECT fio_patient, date_meet FROM hospital.patient, hospital.meet WHERE patient.id_patient=meet.id_patient AND date_meet=DATE('2020-05-16')

-- Показать длину ФИО пациентов в символах:

SELECT fio_patient, LENGTH("fio_patient") FROM hospital.patient

-- Привести строку в верхний регистр:

SELECT name_disease, UPPER("name_disease") FROM hospital.disease

-- Показать ФИО пациентов с таким кодом пациента из медкарты, когда код болезни равен 2:

SELECT fio_patient FROM hospital.patient WHERE patient.id_patient IN (SELECT med_card.id_patient FROM hospital.med_card WHERE med_card.id_disease=2)

-- Показать фамилию доктора с таким кодом доктора, когда код пациента равен 14:

SELECT fio_doctor FROM hospital.doctor WHERE doctor.id_doctor IN (SELECT meet.id_doctor FROM hospital.meet WHERE id_patient=14)

-- Посчитать количество пациентов с определённым кодом диагноза и сгруппировать по коду диагноза:

SELECT id_disease, COUNT(id_patient) FROM hospital.med_card
GROUP BY id_disease

-- Показать максимальную стоимость из прейскуранта:

SELECT max(price_service) FROM hospital.pricelist

-- Посчитать количество докторов с временем работы в клинике равном «26 years», сгруппированных по времени работы в клинике:

SELECT work_time_in_clinic, COUNT(fio_doctor) FROM hospital.doctor
GROUP BY work_time_in_clinic HAVING work_time_in_clinic='26 years'

-- Показать названия услуг с минимальной ценой больше 1000, сгруппированных по названию услуги:

SELECT name_service, MIN(price_service) AS Minimum
FROM hospital.pricelist GROUP BY name_service
HAVING MIN(price_service)>1000

-- Показать коды пациентов, которых принимал доктор с кодом доктора равному 11 и у которых статус оплаты равен true:

SELECT id_patient FROM hospital."meet"
WHERE id_doctor = 11 AND
EXISTS (SELECT * FROM hospital."meet" WHERE payment_state = true)

-- Показать название диагноза, дату установки диагноза с кодом диагноза равному 2 и датой установки диагноза не ранее 2020-04-01:

SELECT name_disease, date_disease FROM hospital.disease, hospital.med_card 
WHERE disease.id_disease=2 AND disease.id_disease=med_card.id_disease
AND EXISTS (SELECT * FROM hospital.med_card WHERE date_disease>DATE('2020-04-01'))