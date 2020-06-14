--Вывод id и ФИО всех врачей, которые учились в Медико-социальном институте, по возрастанию id--
SELECT id_doctor, fio FROM public."doctors" 
WHERE "doctors".education = 'Saint_-Petersburg Medico-Social Institute'
ORDER BY id_doctor;

--Вывод информции об оплаченных приемах, где id услуги 3--
SELECT * FROM public."appointments" 
WHERE payment = 'yes' and id_service = 3;

--Вывод возраста всех врачей--
SELECT id_doctor, fio, age(current_date, "doctors"."date_of_birth") FROM public."doctors";

--Переворачивание названий услуг--
SELECT reverse(the_name_of_the_service) as name_service FROM public."medical_services";

--Вывод выборочной информации о приеме у кардиолога--
SELECT id_doctor, date_and_time, diagnosis, id_service FROM public."appointments" 
WHERE id_doctor = (SELECT id_doctor FROM public."doctors" WHERE (specialization = (SELECT specialization FROM public."doctors" WHERE specialization = 'cardiologist'))) ;

--Средний возраст врачей--
SELECT avg(age(current_date, "doctors"."date_of_birth")) FROM public."doctors";

--Количество неоплаченных приёмов--
SELECT COUNT(*) FROM public."appointments" WHERE (payment = 'no');

--Количество услуг, которые стоят больше 500--
SELECT COUNT(*) FROM public."medical_services"
GROUP BY service_cost HAVING service_cost >'500';

--Вывод информации о пациентах, которые были на приеме 4 августа в час дня--
SELECT * FROM public."med_card" 
WHERE id_pacient = ANY ( SELECT id_pacient FROM public.appointments WHERE date_and_time = '04.08.2019 13.00');

--Вывод пациентов, которые имеют карту, но не были на приеме--
SELECT id_pacient FROM public."med_card" 
EXCEPT SELECT id_pacient FROM public."appointments";

--Вывод ФИО пациента, у которого раньше всех был прием--
SELECT "pacients".fio as pacient FROM public."pacients" 
INNER JOIN public."appointments" ON "pacients".id_pacient = "appointments".id_pacient 
ORDER BY "appointments".date_and_time limit 1;
