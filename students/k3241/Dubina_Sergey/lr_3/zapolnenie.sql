INSERT INTO public."faculty"(faculty_id, faculty_name)
	VALUES 
	(1 , 'IKT'), 
	(2 , 'BIT'),
	(3 , 'BTINS'),
	(4 , 'FTMI'),
	(5 , 'ITIP');

INSERT INTO public."school"(school_num, location)
	VALUES
	(121, 'Kyiv'),
	(32, 'Saint Petersburg'), 
	(456, 'Tumen'), 
	(3, 'Ufa'),
	(33, 'Almati');
	
INSERT INTO public."secretary"(secretary_id, secretary_contacts, fio, work_experience)
	VALUES
	(1, '854648383748', 'Ршоаовла Р.Н.', '4 года'),
	(2, '823343574768', 'Нылталвод Е.В.', '2 года'),
	(3, '850284924892', 'Лщвоыовщы Н.Ш.', '6 лет'),
	(4, '802847924927', 'Ашшовыдыб Р.Н.', '4 года'),
	(5, '871873538587', 'Фоавоущоа Л.Г.', '1 год');
	
INSERT INTO public."speciality"(speciality_id, faculty_id_fk, spciality_name, max_stud_amount, min_grade)
	VALUES
	(1, 5, 'GDFG', 213, 94),
	(2, 4, 'DGDH', 222, 87),
	(3, 3, 'SRTTS', 184, 98),
	(4, 2, 'TRYRY', 300, 76),
	(5, 1, 'YTUGFD', 255, 86);
	
INSERT INTO public."abiturient"(fio, birthday, faculty_id_fk, abiturient_id, speciality_id_fk, school_num_fk, passport_info, gold_medal, silver_medal, form_of_studying, graduation_date, organisation)
	VALUES
	('Дубина С.Д.', '2000/12/8', 1, 1, 5, 121, 5386298, FALSE, TRUE, 'budget', '2018/3/14', NULL),
	('Вельц A.A.', '2000/2/3', 2, 2, 4, 32, 46357357, FALSE, FALSE, 'budget', '2018/3/5', 'DSSDS'),
	('Махотина Е.Г.', '2000/8/6', 3, 3, 3, 456, 5637358, FALSE, TRUE, 'contract', '2018/3/7', NULL),
	('Матюшина Е.Д.', '2000/7/8', 4, 4, 2, 3, 88734799, TRUE, TRUE, 'budget', '2018/5/14', NULL),
	('Тарасов А.Р.', '2000/12/4', 5, 5, 1, 33, 13235356, FALSE, TRUE, 'budget', '2018/3/14', NULL);
	
INSERT INTO public."Application"(secretary_id_fk, abiturient_id_fk, application_date)
	VALUES
	(1, 5, '2020/9/4'),
	(2, 4, '2020/9/6'),
	(3, 3, '2020/9/2'),
	(4, 2, '2020/9/4'), 
	(5, 1, '2020/9/3');
	
INSERT INTO public."9_grade_certificat"(abiturient_id_fk, prof_discipline_1, prof_discipline_2, prof_discipline_3, prof_discipline_4, average_grade)
	VALUES
	(1, 4, 5, 3, 3, 4), 
	(2, 3, 3, 5, 4, 4), 
	(3, 5, 5, 5, 5, 5),
	(4, 3, 4, 3, 3, 3),
	(5, 4, 5, 5, 4, 4);
	
	
INSERT INTO public."EGE_sertificat"(abiturient_id_fk, discipline_1_grade, discipline_2_grade)
	VALUES
	(1, 89, 78), 
	(2, 88, 69), 
	(3, 92, 79), 
	(4, 84, 87), 
	(5, 78, 82);
	
