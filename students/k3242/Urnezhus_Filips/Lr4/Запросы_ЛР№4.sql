-- Получить ИД врачей со специализацией Эндокринолог или с истечением контракта 31 декабря 2022 года.
SELECT id_doctor FROM lab3."Doctors"
WHERE "Doctors".doctor_specialization = 'endocrinologist' or doctor_contract =
'2022/12/31'
ORDER BY doctor_full_name ASC;


-- Получить имена врачей со специализацией Педиатр или рабочим временем с 12 до 18 часов.
SELECT doctor_full_name, doctor_birthday FROM lab3."Doctors"
WHERE doctor_specialization = ALL(SELECT doctor_specialization FROM
lab3."Doctors" WHERE doctor_specialization = 'pediatrician' ) or
doctor_working_time = ALL(SELECT doctor_working_time FROM lab3."Doctors"
WHERE doctor_working_time = '12:00 - 18:00')
ORDER BY doctor_full_name ASC;


-- Получить средний возраст всех врачей.
SELECT avg(age(current_date, "Doctors"."doctor_birthday")) FROM lab3."Doctors";


--  Получить количество услуг с ценой больше 2000 руб.
SELECT COUNT(*) FROM lab3."Reception_cost"
GROUP BY reception_price HAVING reception_price >'2000';


-- Получить названия диагнозов капсом, которыми уже болеют пациенты.
SELECT UPPER (diagnosis_name) FROM lab3."Diagnosis"
WHERE EXISTS (SELECT "id_diagnosis" from lab3."Diag.Patient" WHERE
"Diagnosis"."id_diagnosis" = "Diag.Patient"."id_diagnosis");


-- Получить средний возраст пациентов и докторов.
SELECT (ROUND(AVG(current_date - "Med.Card".birthday)/365))as age,
ROUND(AVG(current_date - "Doctors".doctor_birthday)/365) as doctor_age FROM
lab3."Med.Card", lab3."Doctors";


-- Получить специализацию определенных врачей, результат по дате рождения по возрастанию.
SELECT doctor_full_name, doctor_specialization, doctor_birthday FROM
lab3."Doctors"
WHERE (POSITION('Mudite' in doctor_full_name) = 1 or POSITION('Jelena' in
doctor_full_name) = 1)
ORDER BY doctor_birthday ASC;


-- Получить ФИО пациентов, которых лечит определенный врач.
SELECT "Med.Card".full_name, birthday, contacts FROM lab3."Med.Card"
INNER JOIN lab3."Reception" ON "Med.Card".id_patient = "Reception"."id_patient"
INNER JOIN lab3."Doctors" ON "Doctors"."id_doctor" = "Reception"."id_doctor"
WHERE "Doctors".doctor_full_name = 'Andris Briedis'
ORDER BY "Med.Card".full_name;


-- Получить имена, дату рождения и контакты пациентов, кто был записан к доктору 30 мая.
SELECT * FROM lab3."Med.Card"
WHERE id_patient = ANY ( SELECT id_patient FROM lab3."Reception" WHERE
reception_date = '2020/05/30')
ORDER BY "Med.Card".full_name;


-- Получить возраст пациента и перевернутого ФИО.
SELECT reverse(full_name), age(current_date, "Med.Card"."birthday") FROM
lab3."Med.Card"
WHERE "Med.Card".id_patient = '1';


-- Получить данные об оказания услуг и их цены для пациентов. (Указан ИД пациента)
SELECT id_patient, reception_name, "Reception".reception_price FROM
lab3."Reception_cost"
INNER JOIN lab3."Reception"
ON "Reception_cost".id_reception = "Reception"."id_reception";