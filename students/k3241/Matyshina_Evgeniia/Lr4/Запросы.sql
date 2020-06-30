-- Получить id докторов с именем Кирилл Петров и образование BD по алфавиту по возрастанию. 
SELECT id_doctor FROM public."Doctors" 
WHERE "Doctors".full_name = 'Kirill Petrov' and "Doctors".education = 'BD'
ORDER BY full_name ASC;


-- Получить информацию о приеме, где состояние пациента normal ('N') или рекомендуется оставаться дома, по алфавиту по возрастанию состояния пациента. 
SELECT * FROM public."Priem" where patient_state='N' UNION
SELECT * FROM public."Priem" where recommendations='stay home' 
ORDER BY patient_state ASC;


-- Получить информацию о пациентах, которые были на приеме. 
SELECT * FROM public."Priem_cost"
INNER JOIN public."Priem"
ON "Priem_cost".id_priem = "Priem"."id_priemFK"
ORDER BY id_priem DESC;


-- Получить выборочно информацию о докторах с именем Sam или Артем, результат по алфавиту по возрастанию. 
SELECT UPPER(full_name), specialization, male_female, birthday FROM public."Doctors"
WHERE (POSITION('Sam' in full_name) = 1 or POSITION('Artem' in full_name) = 1)
ORDER BY UPPER(full_name) ASC;


-- Получить средний возраст пациентов и количество месяцев с даты установки диагноза. 
SELECT (ROUND(AVG(current_date - "Medical_records".birthday)/365))as age, ROUND(AVG(current_date - "Patient_diagnosis".date_diagnosis)/30) as month_since_diagnosis FROM public."Medical_records"
INNER JOIN public."Patient_diagnosis" 
ON "Medical_records".id_patient = "Patient_diagnosis"."id_patientFK";


-- Получить названия диагнозов, которыми уже болеют пациенты. 
SELECT title FROM public."Diagnosis"
WHERE EXISTS (SELECT "id_diagnosisFK" from public."Patient_diagnosis" WHERE "Diagnosis"."id_diagnosis" = "Patient_diagnosis"."id_diagnosisFK");


-- Получить ФИО пациентов, которых лечат врачи мужского пола. 
SELECT "Medical_records".full_name FROM public."Medical_records"
INNER JOIN public."Priem" ON "Medical_records".id_patient = "Priem"."id_patientFK"
INNER JOIN public."Doctors" ON "Doctors"."id_doctor" = "Priem"."id_doctorFK" WHERE"Doctors".male_female = 'male'
ORDER BY "Medical_records".full_name;


-- Получить ФИО докторов id расписания для которых больше 3. 
SELECT "Doctors".full_name as doctor, MAX(id_schedule)  FROM public."Medical_records"
INNER JOIN public."Priem" ON "Medical_records".id_patient = "Priem"."id_patientFK"
INNER JOIN public."Doctors" ON "Doctors"."id_doctor" = "Priem"."id_doctorFK" 
INNER JOIN public."Schedule" ON "Doctors".id_doctor = "Schedule"."id_doctorFK"
GROUP BY "Doctors".full_name
HAVING MAX(id_schedule) > 3 


-- Получить полное ФИО пациента с самой ранней датой приема. 
SELECT "Medical_records".full_name as patient  FROM public."Medical_records"
INNER JOIN public."Priem" ON "Medical_records".id_patient = "Priem"."id_patientFK"
ORDER BY "Priem".date_priem limit 1;


-- Получить название, стоимость приема и время приема, у которых с даты приема прошло больше двух месяцев. 
SELECT "Priem_cost".cost, "Priem_cost".title, "Priem".time_priem FROM public."Priem_cost"
INNER JOIN public."Priem" ON "Priem"."id_priemFK" = "Priem_cost".id_priem
WHERE ABS(CURRENT_DATE - "Priem".date_priem) > 60
ORDER BY title ASC;


-- Получить ФИО и пол врачей с специализацией Лор или образованием BD. 
SELECT full_name, male_female FROM public."Doctors"
WHERE specialization = ALL(SELECT specialization FROM public."Doctors" WHERE "Doctors".specialization = 'lor' ) or 
education = ALL(SELECT education FROM public."Doctors" WHERE education = 'BD')
ORDER BY full_name ASC