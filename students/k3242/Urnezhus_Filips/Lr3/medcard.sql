-- Создаем таблицу Мед.Карта
-- Table: lab3.Med.Card

-- DROP TABLE lab3."Med.Card";

CREATE TABLE lab3."Med.Card"
(
    id_patient integer NOT NULL,
    full_name "char" NOT NULL,
    birthday date NOT NULL,
    contacts "char" NOT NULL,
    CONSTRAINT "Med.Card_pkey" PRIMARY KEY (id_patient)
)

TABLESPACE pg_default;

ALTER TABLE lab3."Med.Card"
    OWNER to postgres;
-- Заполняем таблицу
INSERT INTO lab3."Med.Card"(id_patient, full_name, birthday, contacts)
	VALUES
	(1, 'Filips Urnezhus', '1998/07/07', +37129900227),
	(2, 'Yana Evshina', '2000/01/09', +79819655254),
	(3, 'Ilya Chistyakov', '1998/12/26', +79214219056),
	(4, 'Kirill Kuzmin', '2000/06/07', +79005557530),
	(5, 'Denis Ivanov', '1997/01/01', +79998504735);


-- Создаем таблицу с диагнозами
-- Table: lab3.Diagnosis

-- DROP TABLE lab3."Diagnosis";

CREATE TABLE lab3."Diagnosis"
(
	id_diagnosis integer NOT NULL,
	diagnosis_name char NOT NULL,
	diagnosis_descr char NOT NULL,
	CONSTRAINT "Diagnosis_pkey" PRIMARY KEY (id_diagnosis)
)

TABLESPACE pg_default;

ALTER TABLE lab3."Diagnosis"
	OWNER to postgres;
-- Заполняем таблицу
INSERT INTO lab3."Diagnosis"(id_diagnosis, diagnosis_name, diagnosis_descr)
	VALUES
	(1, 'Hypertension', 'high blood pressure (HBP), is a long-term medical condition in which the blood pressure in the arteries is persistently elevated.')
	(2, 'Diabetes', 'disease in which your blood glucose, or blood sugar, levels are too high.')
	(3, 'Back pain', 'Physical discomfort occurring anywhere on the spine or back, ranging from mild to disabling.')
	(4, 'Anxiety', 'Anxiety disorders are a group of mental disorders characterized by exaggerated feelings of anxiety and fear responses.')
	(5, 'Obesity', 'medical condition in which excess body fat has accumulated to the extent that it may have an adverse effect on health.')


-- Создаем таблицу Диагнозов пациентов
-- Table: lab3.Diag.Patient

-- DROP TABLE lab3."Diag.Patient";

CREATE TABLE lab3."Diag.Patient"
(
	id_patient integer NOT NULL,
	id_diagnosis integer NOT NULL,
	date_diagnosis integer NOT NULL,
	FOREIGN KEY (id_patient) REFERENCES Med.Card(id_patient)
	FOREIGN KEY (id_diagnosis) REFERENCES Diagnosis(id_diagnosis)
)

TABLESPACE pg_default;

ALTER TABLE lab3."Diag.Patient"
	OWNER to postgres;
-- Заполняем таблицу
INSERT INTO lab3."Diag.Patient"(id_patient, id_diagnosis, date_diagnosis)
	VALUES
	(1, 1, '2020/05/29')
	(2, 2, '2020/05/29')
	(3, 3, '2020/05/29')
	(4, 4, '2020/05/29')
	(5, 5, '2020/05/29')


-- Создаем таблицу Докторов
-- Table: lab3.Doctors

-- DROP TABLE lab3."Doctors";

CREATE TABLE lab3."Doctors"
(
	id_doctor integer NOT NULL,
	doctor_full_name char NOT NULL,
	doctor_birthday date NOT NULL,
	doctor_contacts char NOT NULL,
	doctor_specialization char NOT NULL,
	doctor_contract char NOT NULL,
	doctor_working_time char NOT NULL
)

TABLESPACE pg_default;

ALTER TABLE lab3."Doctors"
	OWNER to postgres;
-- Заполняем таблицу Докторов
INSERT INTO lab3."Doctors"(id_doctor, doctor_full_name, doctor_birthday, doctor_contacts, doctor_specialization, doctor_contract, doctor_working_time)
	VALUES
	(1, 'Mudite Ozolina', '1966/12/01', '+37163452430', 'pediatrician', '2021/01/01', '12:00 - 18:00')
	(2, 'Andris Briedis', '1972/01/30', '+37163422576', 'nutritionist', '2028/12/31', '08:00 - 16:00')
	(3, 'Ilze Lagzdina', '1955/07/22', '+37163422509', 'endocrinologist', '2020/12/31', '14:00 - 18:00')
	(4, 'Jelena Melere', '1980/12/12', '+37128908800', 'cardiologist', '2022/12/31', '10:00 - 15:30')
	(5, 'Aivars Olmanis', '1975/04/20', '+37129436630', 'psychologist', '2020/09/30', '12:30 - 15:00')


-- Создаем таблицу Цены приемов
-- Table: lab3.Reception_cost

-- DROP TABLE lab3."Reception_cost";

CREATE TABLE lab3."Reception_cost"
(
	id_reception integer NOT NULL,
	reception_name char NOT NULL,
	reception_price char NOT NULL,
	reception_descr char NOT_NULL
)

TABLESPACE pg_default;

ALTER TABLE lab3."Reception_cost"
	OWNER to postgres;
-- Заполняем таблицу цен за прием
INSERT INTO lab3."Reception_cost"(id_reception, reception_name, reception_price, reception_descr)
	VALUES
	(1, 'checkup', '1000', 'no description given')
	(2, 'dieting', '3500', 'no description given')
	(3, 'medical inspection', '1500', 'no description given')
	(4, 'pressure measurement', '1000', 'no description given')
	(5, 'therapy session', '4000', 'no description given')


-- Создаем таблицу Приемов
-- Table: lab3.Reception

-- DROP TABLE lab3."Reception";

CREATE TABLE lab3."Reception"
(
	id_patient integer NOT NULL,
	id_reception integer NOT NULL,
	id_doctor integer NOT NULL,
	reception_date date NOT NULL,
	reception_time char NOT NULL,
	reception_price char NOT NULL,
	FOREIGN KEY (id_patient) REFERENCES Med.Card(id_patient)
	FOREIGN KEY (id_doctor) REFERENCES Doctors(id_doctor)
	FOREIGN KEY (id_reception) REFERENCES Reception_cost(id_reception)
)

TABLESPACE pg_default;

ALTER TABLE lab3."Reception"
	OWNER to postgres;
-- Заполняем таблицу приемов
INSERT INTO lab3."Reception"(id_patient, id_reception, id_doctor, reception_date, reception_time, reception_price)
	VALUES
	(1, 1, 1, '2020/05/30', '12:00', '1000')
	(2, 2, 3, '2020/05/30', '12:20', '1500')
	(3, 3, 2, '2020/05/30', '12:40', '3575')
	(4, 4, 4, '2020/05/30', '13:00', '1000')
	(5, 5, 5, '2020/05/30', '13:20', '4500')