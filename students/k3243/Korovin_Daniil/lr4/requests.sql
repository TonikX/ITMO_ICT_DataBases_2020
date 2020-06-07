--Вывод абитуриентов, имеющих медаль, их номера паспорта и вида медали.
SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."Passport_ID", enroll_comission."Medal"."Type"
	FROM enroll_comission."Enrolee"
		INNER JOIN enroll_comission."Medal" ON enroll_comission."Enrolee"."Medal_ID" = enroll_comission."Medal"."ID"
				ORDER BY enroll_comission."Enrolee"."Name"

--Вывод школ, которые находятся в Москве или Санкт-Петербурге, сортировка по названию школы в обратном порядке
SELECT enroll_comission."School"."Name", enroll_comission."School"."School_location"
FROM enroll_comission."School"
	WHERE enroll_comission."School"."School_location" = 'Moscow'
		OR enroll_comission."School"."School_location" = 'Saint-Petersburg'
ORDER BY enroll_comission."School"."Name" DESC

--Вывод ФИО абитуриента, его номера сертификата ЕГЭ, даты выдачи сертификата, даты выпуска и времени, прошедшего с выпускного и до получения сертификата
SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."EGE_sertificate_ID", enroll_comission."EGE_sertificate"."Issue_date", enroll_comission."School"."Graduation_date", age(enroll_comission."EGE_sertificate"."Issue_date", enroll_comission."School"."Graduation_date")
	FROM enroll_comission."Enrolee"
		INNER JOIN enroll_comission."School" ON enroll_comission."Enrolee"."School_name" = enroll_comission."School"."Name"
		INNER JOIN enroll_comission."EGE_sertificate" ON enroll_comission."Enrolee"."EGE_sertificate_ID" = enroll_comission."EGE_sertificate"."ID"

--Замена пробелов в ФИО абитуриента на подчеркивания
SELECT replace(enroll_comission."Enrolee"."Name", ' ', '_') as edited_name
	FROM enroll_comission."Enrolee"

--Вывод имен абитуриентов, ФИО которых имеет более 15 символов, номеров их паспортов и длину (посимвольно) номеров
SELECT enroll_comission."Enrolee"."Name", enroll_comission."Passport"."ID" , char_length(enroll_comission."Passport"."ID") as length
	FROM enroll_comission."Passport" 
		INNER JOIN enroll_comission."Enrolee" ON enroll_comission."Enrolee"."Passport_ID" = enroll_comission."Passport"."ID"
		WHERE length(enroll_comission."Enrolee"."Name") > 15

--Вывод имени студента и его среднего балла
SELECT enroll_comission."Enrolee"."Name", AVG(enroll_comission."Subj_res"."Grade") as average_grade
	FROM enroll_comission."Enrolee"
		RIGHT JOIN enroll_comission."School_sertificate" ON enroll_comission."Enrolee"."School_sertificate_ID" = enroll_comission."School_sertificate"."ID"
		LEFT JOIN enroll_comission."Subj_res" ON enroll_comission."School_sertificate"."ID" = enroll_comission."Subj_res"."School_sertificate_ID"
GROUP BY enroll_comission."Enrolee"."Name" ORDER BY enroll_comission."Enrolee"."Name" ASC

--Вывод имени студента, паспортных данных и информации о школе используя объединение запросов
SELECT enroll_comission."Enrolee"."Name", enroll_comission."Passport".*, enroll_comission."School".*
	FROM enroll_comission."Enrolee"
		INNER JOIN enroll_comission."Passport" ON enroll_comission."Enrolee"."Passport_ID" = enroll_comission."Passport"."ID"
		INNER JOIN enroll_comission."School" ON enroll_comission."Enrolee"."School_name" = enroll_comission."School"."Name"

--Вывод количества принятых, непринятых и тех, чьи заявки обрабатываются, с использованием подзапросов
SELECT approved.*, rejected.*, in_process.* FROM
		--принятые
		(SELECT COUNT(enroll_comission."Enrolee"."Name") as number_enrolled
			FROM enroll_comission."Enrolee", enroll_comission."Application"
			WHERE enroll_comission."Enrolee"."ID" = enroll_comission."Application"."Enrolee_ID"
			AND enroll_comission."Application"."Status" = 'Approved') AS approved,
		--непринятые
		(SELECT COUNT(enroll_comission."Enrolee"."Name") as number_rejected
			FROM enroll_comission."Enrolee", enroll_comission."Application"
			WHERE enroll_comission."Enrolee"."ID" = enroll_comission."Application"."Enrolee_ID"
			AND enroll_comission."Application"."Status" = 'Rejected') AS rejected,
		--в обработке
		(SELECT COUNT(enroll_comission."Enrolee"."Name") as number_processing
			FROM enroll_comission."Enrolee", enroll_comission."Application"
			WHERE enroll_comission."Enrolee"."ID" = enroll_comission."Application"."Enrolee_ID"
			AND enroll_comission."Application"."Status" = 'In process') AS in_process

--Вывод всей информации о направлении, на котором больше всего свободных мест
SELECT DISTINCT enroll_comission."Course".*
	FROM enroll_comission."Course"
	WHERE NOT enroll_comission."Course"."Available_slots" < SOME (SELECT enroll_comission."Course"."Available_slots" FROM enroll_comission."Course")

--Вывод среднего балла ЕГЭ у всех, чьи заявки были одобрены
SELECT AVG(enroll_comission."Subj_res"."Grade") as average_grade
	FROM enroll_comission."Enrolee"
		RIGHT JOIN enroll_comission."EGE_sertificate" ON enroll_comission."Enrolee"."EGE_sertificate_ID" = enroll_comission."EGE_sertificate"."ID"
		LEFT JOIN enroll_comission."Subj_res" ON enroll_comission."EGE_sertificate"."ID" = enroll_comission."Subj_res"."EGE_sertificate_ID"
		LEFT JOIN enroll_comission."Application" ON enroll_comission."Application"."Enrolee_ID" = enroll_comission."Enrolee"."ID"
GROUP BY enroll_comission."Application"."Status" HAVING enroll_comission."Application"."Status" = 'Approved'

--Вывод имени абитуриента и информации, на бюджете он или нет
SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."Budget" as is_smart_enough
	FROM enroll_comission."Enrolee"
	WHERE enroll_comission."Enrolee"."Budget" = 'true'
UNION
SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."Budget" as is_smart_enough
	FROM enroll_comission."Enrolee"
	WHERE enroll_comission."Enrolee"."Budget" = 'false'
ORDER BY is_smart_enough

--Вывод ФИО, номера паспорта, названия школы и расположения школы абитуриентов, школы которых находятся в городе, название которого заканчивается на ‘ow’
SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."Passport_ID", enroll_comission."Enrolee"."School_name", enroll_comission."School"."School_location"
	FROM enroll_comission."Enrolee"
	INNER JOIN enroll_comission."School" ON enroll_comission."School"."Name" = enroll_comission."Enrolee"."School_name"
	WHERE EXISTS
		(SELECT enroll_comission."School"."School_location" 
		 	FROM enroll_comission."School"
			WHERE enroll_comission."School"."Name" = enroll_comission."Enrolee"."School_name"
			AND enroll_comission."School"."School_location" LIKE '%ow')