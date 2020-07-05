CREATE SCHEMA hospital;


ALTER SCHEMA hospital OWNER TO postgres;

-- Создаём таблицу "кабинет"

CREATE TABLE hospital.cabinet (
    id_cabinet integer NOT NULL,
    owner text,
    phone_cabinet text NOT NULL
);


ALTER TABLE hospital.cabinet OWNER TO postgres;

-- Создаём таблицу "диагноз"

CREATE TABLE hospital.disease (
    id_disease integer NOT NULL,
    name_disease text NOT NULL
);


ALTER TABLE hospital.disease OWNER TO postgres;

-- Создаём таблицу "доктор"

CREATE TABLE hospital.doctor (
    id_doctor integer NOT NULL,
    fio_doctor text NOT NULL,
    specialty text NOT NULL,
    education text NOT NULL,
    gender text NOT NULL,
    birthday_date_doctor date NOT NULL,
    contract text,
    work_time_in_clinic text NOT NULL
);


ALTER TABLE hospital.doctor OWNER TO postgres;

-- Создаём таблицу "мед.карта"

CREATE TABLE hospital.med_card (
    id_patient integer NOT NULL,
    id_disease integer NOT NULL,
    date_disease date NOT NULL,
    status_disease text NOT NULL
);


ALTER TABLE hospital.med_card OWNER TO postgres;

-- Создаём таблицу "приём"

CREATE TABLE hospital.meet (
    id_meet integer NOT NULL,
    id_patient integer NOT NULL,
    id_service integer NOT NULL,
    id_doctor integer NOT NULL,
    date_meet date NOT NULL,
    time_meet time without time zone NOT NULL,
    current_state text NOT NULL,
    payment_state boolean
);


ALTER TABLE hospital.meet OWNER TO postgres;

-- Создаём таблицу "пациент"

CREATE TABLE hospital.patient (
    id_patient integer NOT NULL,
    fio_patient text NOT NULL,
    birthday_date_patient date NOT NULL,
    phone_patient text NOT NULL,
    passport_patient text NOT NULL
);


ALTER TABLE hospital.patient OWNER TO postgres;

-- Создаём таблицу "прейскурант"

CREATE TABLE hospital.pricelist (
    id_service integer NOT NULL,
    name_service text NOT NULL,
    price_service integer NOT NULL
);


ALTER TABLE hospital.pricelist OWNER TO postgres;

-- Создаём таблицу "график работы"

CREATE TABLE hospital.schedule (
    id_schedule integer NOT NULL,
    id_doctor integer NOT NULL,
    id_cabinet integer NOT NULL,
    time_start time without time zone NOT NULL,
    time_end time without time zone NOT NULL,
    working_day text NOT NULL
);


ALTER TABLE hospital.schedule OWNER TO postgres;

-- Заполняем таблицу "пациент"

INSERT INTO hospital.patient (id_patient, fio_patient, birthday_date_patient, phone_patient, passport_patient) VALUES (11, 'Ivanov I.I.', '1993-12-03', '+7 921 3734509', '4010 565656');
INSERT INTO hospital.patient (id_patient, fio_patient, birthday_date_patient, phone_patient, passport_patient) VALUES (12, 'Petrov D.A.', '1976-09-01', '+7 911 3635649', '4014 347855');
INSERT INTO hospital.patient (id_patient, fio_patient, birthday_date_patient, phone_patient, passport_patient) VALUES (13, 'Mikhailov S.U.', '1980-04-05', '+7 931 6394079', '4118 529851');
INSERT INTO hospital.patient (id_patient, fio_patient, birthday_date_patient, phone_patient, passport_patient) VALUES (14, 'Yurieva N.B.', '1965-04-05', '+7 911 5350532', '4510 656082');
INSERT INTO hospital.patient (id_patient, fio_patient, birthday_date_patient, phone_patient, passport_patient) VALUES (16, 'Valichev O.E.', '1978-05-31', '+7 911 9545267', '4016 993762');

-- Заполняем таблицу "диагноз"

INSERT INTO hospital.disease (id_disease, name_disease) VALUES (1, 'ОРЗ');
INSERT INTO hospital.disease (id_disease, name_disease) VALUES (2, 'Coronavirus');
INSERT INTO hospital.disease (id_disease, name_disease) VALUES (3, 'Pneumonia');
INSERT INTO hospital.disease (id_disease, name_disease) VALUES (4, 'Asthma');
INSERT INTO hospital.disease (id_disease, name_disease) VALUES (5, 'Influenza');

-- Заполняем таблицу "прейскурант"

INSERT INTO hospital.pricelist (id_service, name_service, price_service) VALUES (1, 'Первичная консультация', 1000);
INSERT INTO hospital.pricelist (id_service, name_service, price_service) VALUES (2, 'Базовое обследование', 1500);
INSERT INTO hospital.pricelist (id_service, name_service, price_service) VALUES (3, 'Анализ крови', 1300);
INSERT INTO hospital.pricelist (id_service, name_service, price_service) VALUES (4, 'МРТ', 1200);
INSERT INTO hospital.pricelist (id_service, name_service, price_service) VALUES (5, 'Полное обследование', 3200);
INSERT INTO hospital.pricelist (id_service, name_service, price_service) VALUES (6, 'Консультация', 800);

-- Заполняем таблицу "врач"

INSERT INTO hospital.doctor (id_doctor, fio_doctor, specialty, education, gender, birthday_date_doctor, work_time_in_clinic) VALUES (11, 'Bykov V.D.', 'Отоларинголог', 'Высшее', 'Мужской', '1961-03-17', '19 years');
INSERT INTO hospital.doctor (id_doctor, fio_doctor, specialty, education, gender, birthday_date_doctor, work_time_in_clinic) VALUES (12, 'Frank A.L.', 'Аллерголог', 'Высшее', 'Мужской', '1974-11-09', '26 years');
INSERT INTO hospital.doctor (id_doctor, fio_doctor, specialty, education, gender, birthday_date_doctor, work_time_in_clinic) VALUES (13, 'Vanchuk M.T.', 'Главный врач', 'Высшее', 'Мужской', '1965-01-29', '31 years');
INSERT INTO hospital.doctor (id_doctor, fio_doctor, specialty, education, gender, birthday_date_doctor, work_time_in_clinic) VALUES (14, 'Tygymbek A.V.', 'Главный врач', 'Высшее', 'Мужской', '1976-06-01', '12 years');
INSERT INTO hospital.doctor (id_doctor, fio_doctor, specialty, education, gender, birthday_date_doctor, work_time_in_clinic) VALUES (15, 'Bibekov V.M.', 'Пульмонолог', 'Высшее', 'Мужской', '1973-04-11', '24 years');

-- Заполняем таблицу "кабинет"

INSERT INTO hospital.cabinet (id_cabinet, owner, phone_cabinet) VALUES (1, 'Malyshev T.M.', '+7 911 9230945');
INSERT INTO hospital.cabinet (id_cabinet, owner, phone_cabinet) VALUES (2, 'Mishina S.E.', '+7 911 9535659');
INSERT INTO hospital.cabinet (id_cabinet, owner, phone_cabinet) VALUES (3, 'Solntseva M.A.', '+7 911 9445591');
INSERT INTO hospital.cabinet (id_cabinet, owner, phone_cabinet) VALUES (4, 'Maminchuk A.D.', '+7 911 9055617');
INSERT INTO hospital.cabinet (id_cabinet, owner, phone_cabinet) VALUES (5, 'Lodurev N.K.', '+7 911 9036178');

-- Заполняем таблицу "мед.карта"

INSERT INTO hospital.med_card (id_patient, id_disease, date_disease, status_disease) VALUES (11, 5, '2019-12-14', 'Обнаружено');
INSERT INTO hospital.med_card (id_patient, id_disease, date_disease, status_disease) VALUES (12, 2, '2020-05-17', 'Обнаружено');
INSERT INTO hospital.med_card (id_patient, id_disease, date_disease, status_disease) VALUES (13, 2, '2020-04-30', 'Обнаружено');
INSERT INTO hospital.med_card (id_patient, id_disease, date_disease, status_disease) VALUES (14, 2, '2020-05-16', 'Вылечено');
INSERT INTO hospital.med_card (id_patient, id_disease, date_disease, status_disease) VALUES (15, 3, '2020-03-29', 'Вылечен');

-- Заполняем таблицу "приём"

INSERT INTO hospital.meet (id_meet, id_patient, id_service, id_doctor, date_meet, time_meet, current_state, payment_state) VALUES (100, 11, 1, 11, '2019-12-16', '13:10:00', 'Составлен план лечения', '1');
INSERT INTO hospital.meet (id_meet, id_patient, id_service, id_doctor, date_meet, time_meet, current_state, payment_state) VALUES (101, 12, 3, 13, '2020-05-16', '09:15:00', 'Анализ на наличие вируса', '1');
INSERT INTO hospital.meet (id_meet, id_patient, id_service, id_doctor, date_meet, time_meet, current_state, payment_state) VALUES (102, 13, 3, 13, '2020-04-28', '16:55:00', 'Анализ на наличие вируса', '1');
INSERT INTO hospital.meet (id_meet, id_patient, id_service, id_doctor, date_meet, time_meet, current_state, payment_state) VALUES (103, 14, 6, 14, '2020-05-16', '14:20:00', 'Вылечено', '1');
INSERT INTO hospital.meet (id_meet, id_patient, id_service, id_doctor, date_meet, time_meet, current_state, payment_state) VALUES (104, 15, 2, 11, '2020-03-18', '17:30:00', 'Состояние стабильное', '1');

-- Заполняем таблицу "график работы"

INSERT INTO hospital.schedule (id_schedule, id_doctor, id_cabinet, time_start, time_end, working_day) VALUES (1, 11, 1, '08:00:00', '20:00:00', 'С понедельника по пятницу');
INSERT INTO hospital.schedule (id_schedule, id_doctor, id_cabinet, time_start, time_end, working_day) VALUES (2, 12, 2, '10:00:00', '17:00:00', 'Понедельник, Среда, Пятница');
INSERT INTO hospital.schedule (id_schedule, id_doctor, id_cabinet, time_start, time_end, working_day) VALUES (3, 13, 3, '09:00:00', '19:00:00', 'С понедельника по субботу');
INSERT INTO hospital.schedule (id_schedule, id_doctor, id_cabinet, time_start, time_end, working_day) VALUES (4, 14, 4, '10:00:00', '20:00:00', 'С понедельника по субботу');
INSERT INTO hospital.schedule (id_schedule, id_doctor, id_cabinet, time_start, time_end, working_day) VALUES (5, 15, 5, '11:00:00', '18:30:00', 'Вторник, Четверг');

-- Задаём первичные ключи

ALTER TABLE ONLY hospital.cabinet
    ADD CONSTRAINT cabinet_pkey PRIMARY KEY (id_cabinet);

ALTER TABLE ONLY hospital.disease
    ADD CONSTRAINT disease_pkey PRIMARY KEY (id_disease);

ALTER TABLE ONLY hospital.doctor
    ADD CONSTRAINT doctor_pkey PRIMARY KEY (id_doctor);

ALTER TABLE ONLY hospital.med_card
    ADD CONSTRAINT "med.card_pkey" PRIMARY KEY (id_disease, id_patient);

ALTER TABLE ONLY hospital.meet
    ADD CONSTRAINT meet_pkey PRIMARY KEY (id_meet, id_patient, id_service, id_doctor);

ALTER TABLE ONLY hospital.patient
    ADD CONSTRAINT patient_pkey PRIMARY KEY (id_patient);

ALTER TABLE ONLY hospital.pricelist
    ADD CONSTRAINT pricelist_pkey PRIMARY KEY (id_service);

ALTER TABLE ONLY hospital.schedule
    ADD CONSTRAINT schedule_pkey PRIMARY KEY (id_schedule, id_doctor, id_cabinet);

-- Задаём внешние ключи

ALTER TABLE ONLY hospital.schedule
    ADD CONSTRAINT id_cabinet FOREIGN KEY (id_cabinet) REFERENCES hospital.cabinet(id_cabinet) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY hospital.med_card
    ADD CONSTRAINT id_disease FOREIGN KEY (id_disease) REFERENCES hospital.disease(id_disease) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY hospital.meet
    ADD CONSTRAINT id_doctor FOREIGN KEY (id_doctor) REFERENCES hospital.doctor(id_doctor) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY hospital.schedule
    ADD CONSTRAINT id_doctor FOREIGN KEY (id_doctor) REFERENCES hospital.doctor(id_doctor) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY hospital.med_card
    ADD CONSTRAINT id_patient FOREIGN KEY (id_patient) REFERENCES hospital.patient(id_patient) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY hospital.meet
    ADD CONSTRAINT id_patient FOREIGN KEY (id_patient) REFERENCES hospital.patient(id_patient) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY hospital.meet
    ADD CONSTRAINT id_service FOREIGN KEY (id_service) REFERENCES hospital.pricelist(id_service) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
