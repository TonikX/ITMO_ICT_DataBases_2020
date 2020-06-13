-- PostgreSQL
-- Нужно создать базу данных для хранения информации о
-- приёмах лечебной клиники, Вариант 10
-- Выолнил студент K3243 Самощенков Алексей



--
-- Создание базы данных
--


CREATE DATABASE "Clinic_admin" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';

ALTER DATABASE "Clinic_admin" OWNER TO postgres;



--
-- Создание основной схемы
--

CREATE SCHEMA "Clinic";

ALTER SCHEMA "Clinic" OWNER TO postgres;

COMMENT ON SCHEMA "Clinic" IS 'Lab3_Var10';

SET default_tablespace = '';

SET default_table_access_method = heap;


--
-- Создание таблиц
--

-- Таблица "Пацинет"

CREATE TABLE "Clinic"."Patient" (
    ID_patient integer NOT NULL,
    Patient_name text NOT NULL,
    Patient_sex text NOT NULL,
    Date_of_birth text NOT NULL,
    Passport_num text NOT NULL,
    SNILS_num text NOT NULL,
    Telephone_num text NOT NULL
);
ALTER TABLE "Clinic"."Patient" OWNER TO postgres;


-- Таблица "Диагнозы"

CREATE TABLE "Clinic"."Diagnoses" (
    ID_diagnose integer NOT NULL,
    Diagnose_name text NOT NULL
);
ALTER TABLE "Clinic"."Diagnoses" OWNER TO postgres;


-- Таблица "Медицинская карта"

CREATE TABLE "Clinic"."Medical_book" (
    ID_med_book integer NOT NULL,
	FK_ID_Diagnose integer NOT NULL,
    Owner_name text NOT NULL,
    Owner_sex text NOT NULL,
    Owner_date_of_birth text NOT NULL,
    Owner_telephone text  NOT NULL,
    Receptions text NOT NULL,
    FK_ID_patient integer NOT NULL
);
ALTER TABLE "Clinic"."Medical_book" OWNER TO postgres;


-- Таблица "Направление"

CREATE TABLE "Clinic"."Specialization" (
    ID_Specialization integer NOT NULL,
    Specialization_name text NOT NULL
);
ALTER TABLE "Clinic"."Specialization" OWNER TO postgres;


-- Таблица "Врач"

CREATE TABLE "Clinic"."Doctor" (
    ID_doctor integer NOT NULL,
    Doctor_name text NOT NULL,
    Specialization text NOT NULL,
    Doctor_Date_of_birth text NOT NULL,
    FK_ID_Specialization integer NOT NULL,
    Doctor_sex text NOT NULL,
    TD_data text NOT NULL,
    First_working_day text NOT NULL
);
ALTER TABLE "Clinic"."Doctor" OWNER TO postgres;


-- Таблица "Расписание"

CREATE TABLE "Clinic"."Schedule" (
    ID_schedule integer NOT NULL,
    Day_of_week integer NOT NULL,
    Working_status integer NOT NULL,
    Working_time text NOT NULL,
    FK_ID_Doctor integer NOT NULL
);
ALTER TABLE "Clinic"."Schedule" OWNER TO postgres;


-- Таблица "Прейскурант"

CREATE TABLE "Clinic"."Pricelist" (
    ID_price integer NOT NULL,
    Service_name text NOT NULL,
    Service_price integer NOT NULL
);
ALTER TABLE "Clinic"."Pricelist" OWNER TO postgres;


-- Таблица "Кабинет"

CREATE TABLE "Clinic"."Room" (
    ID_room integer NOT NULL,
    Room_num integer NOT NULL,
    Room_working_time text NOT NULL,
    Responsible_name text NOT NULL,
    responsible_telephone text NOT NULL,
    inner_telephone text NOT NULL
);
ALTER TABLE "Clinic"."Room" OWNER TO postgres;


-- Таблица "Приём"

CREATE TABLE "Clinic"."Reception" (
    ID_reception integer NOT NULL,
	FK_ID_Price integer NOT NULL,
    FK_ID_room integer NOT NULL,
    FK_ID_med_book integer NOT NULL,
    FK_ID_Doctor integer NOT NULL,
    Reception_Date_Time text NOT NULL
);
ALTER TABLE "Clinic"."Reception" OWNER TO postgres;


-- Таблица "Оплата_приёма"

CREATE TABLE "Clinic"."Payment" (
    FK_ID_reception integer NOT NULL,
    Type_of_payment text NOT NULL,
    Summ integer NOT NULL,
    Sale_date text NOT NULL,
    Status integer NOT NULL
);
ALTER TABLE "Clinic"."Payment" OWNER TO postgres;



--
-- Заполнение таблицы "Patient"
--

INSERT INTO "Clinic"."Patient" (ID_patient, Patient_name, Patient_sex, Date_of_birth, Passport_num, SNILS_num, Telephone_num) VALUES (1, 'Alexander Gelevich Dugin', 'male', 07-01-1962, 5414658974, 1234578965421, 891565789740);
INSERT INTO "Clinic"."Patient" (ID_patient, Patient_name, Patient_sex, Date_of_birth, Passport_num, SNILS_num, Telephone_num) VALUES (2, 'Ivanov Ivan Ivanovich', 'male', 25-03-1974, 5416365478, 1234578965425, 89624748965);
INSERT INTO "Clinic"."Patient" (ID_patient, Patient_name, Patient_sex, Date_of_birth, Passport_num, SNILS_num, Telephone_num) VALUES (3, 'Ann Ahmatova', 'female', 23-06-1989, 5418698745, 1234578965478, 89549637485);
INSERT INTO "Clinic"."Patient" (ID_patient, Patient_name, Patient_sex, Date_of_birth, Passport_num, SNILS_num, Telephone_num) VALUES (4, 'Lev Nikolaevich Tolstoy', 'male', 09-09-1928, 5404658974, 1234578965490, 89106589685);
INSERT INTO "Clinic"."Patient" (ID_patient, Patient_name, Patient_sex, Date_of_birth, Passport_num, SNILS_num, Telephone_num) VALUES (5, 'Fedor Mikhailowitch Dostoevskiy', 'male', 11-11-1921, 5401654789, 1234578965455, 89157891425);

--
-- Заполнение таблицы "Diagnoses"
--

INSERT INTO "Clinic"."Diagnoses" (ID_Diagnose, Diagnose_name) VALUES (101, 'ВСД');
INSERT INTO "Clinic"."Diagnoses" (ID_Diagnose, Diagnose_name) VALUES (102, 'Шизофрения');
INSERT INTO "Clinic"."Diagnoses" (ID_Diagnose, Diagnose_name) VALUES (103, 'Гомосексуальность');
INSERT INTO "Clinic"."Diagnoses" (ID_Diagnose, Diagnose_name) VALUES (104, 'Остеохондроз');
INSERT INTO "Clinic"."Diagnoses" (ID_Diagnose, Diagnose_name) VALUES (105, 'Цистит');

--
-- Заполнение таблицы "Medical_book"
--

INSERT INTO "Clinic"."Medical_book" (ID_med_book, FK_ID_Diagnose, Owner_name, Owner_sex, Owner_date_of_birth, Owner_telephone, Receptions, FK_ID_patient) VALUES (1, 101, 'Alexander Gelevich Dugin', 'male', 07-01-1962, 891565789740, 101, 1);
INSERT INTO "Clinic"."Medical_book" (ID_med_book, FK_ID_Diagnose, Owner_name, Owner_sex, Owner_date_of_birth, Owner_telephone, Receptions, FK_ID_patient) VALUES (2, 103, 'Ivanov Ivan Ivanovich', 'male', 25-03-1974, 89624748965, 102, 2);
INSERT INTO "Clinic"."Medical_book" (ID_med_book, FK_ID_Diagnose, Owner_name, Owner_sex, Owner_date_of_birth, Owner_telephone, Receptions, FK_ID_patient) VALUES (3, 105, 'Ann Ahmatova', 'female', 23-06-1989, 89549637485, 103, 3);
INSERT INTO "Clinic"."Medical_book" (ID_med_book, FK_ID_Diagnose, Owner_name, Owner_sex, Owner_date_of_birth, Owner_telephone, Receptions, FK_ID_patient) VALUES (4, 102, 'Lev Nikolaevich Tolstoy', 'male', 09-09-1928, 89106589685, 104, 4);
INSERT INTO "Clinic"."Medical_book" (ID_med_book, FK_ID_Diagnose, Owner_name, Owner_sex, Owner_date_of_birth, Owner_telephone, Receptions, FK_ID_patient) VALUES (5, 104, 'Fedor Mikhailowitch Dostoevskiy', 'male', 11-11-1921, 89157891425, 105, 5);

--
-- Заполнение таблицы "Specialization"
--

INSERT INTO "Clinic"."Specialization" (ID_Specialization, Specialization_name) VALUES (1, 'Neurologist');
INSERT INTO "Clinic"."Specialization" (ID_Specialization, Specialization_name) VALUES (2, 'Psychiatrist');
INSERT INTO "Clinic"."Specialization" (ID_Specialization, Specialization_name) VALUES (3, 'Gynecologist');
INSERT INTO "Clinic"."Specialization" (ID_Specialization, Specialization_name) VALUES (4, 'Urologist');
INSERT INTO "Clinic"."Specialization" (ID_Specialization, Specialization_name) VALUES (5, 'Narcologist');

--
-- Заполнение таблицы "Doctor"
--

INSERT INTO "Clinic"."Doctor" (ID_doctor, Doctor_Name, Specialization, Doctor_Date_of_birth, FK_ID_Specialization, Doctor_sex, TD_data, First_working_day) VALUES (1, 'Louis Ferdinand Céline', 'Gynecologist', 27-05-1979, 3, 'male', 'TD information', 01-09-2005);
INSERT INTO "Clinic"."Doctor" (ID_doctor, Doctor_Name, Specialization, Doctor_Date_of_birth, FK_ID_Specialization, Doctor_sex, TD_data, First_working_day) VALUES (2, 'Anton Pavlovich Chehov', 'Neurologist', 29-01-1960, 1, 'male', 'TD information', 24-11-1991);
INSERT INTO "Clinic"."Doctor" (ID_doctor, Doctor_Name, Specialization, Doctor_Date_of_birth, FK_ID_Specialization, Doctor_sex, TD_data, First_working_day) VALUES (3, 'Mikhail Afanasyewitch Bulgakov', 'Narcologist', 15-05-1991, 5, 'male', 'TD information', 15-07-2017);
INSERT INTO "Clinic"."Doctor" (ID_doctor, Doctor_Name, Specialization, Doctor_Date_of_birth, FK_ID_Specialization, Doctor_sex, TD_data, First_working_day) VALUES (4, 'Mechnikov Ilya Ilyich', 'Psychiatrist', 16-05-1945, 2, 'male', 'TD information', 18-03-1991);
INSERT INTO "Clinic"."Doctor" (ID_doctor, Doctor_Name, Specialization, Doctor_Date_of_birth, FK_ID_Specialization, Doctor_sex, TD_data, First_working_day) VALUES (5, 'William Somerset Maugham', 'Urologist', 25-01-1974, 4, 'male', 'TD information', 05-01-2000);

--
-- Заполнение таблицы "Schedule"
--

INSERT INTO "Clinic"."Schedule" (ID_schedule, Day_of_week, Working_status, Working_time, FK_ID_Doctor) VALUES (1, 1, 1, '08:00-14:00', 1);
INSERT INTO "Clinic"."Schedule" (ID_schedule, Day_of_week, Working_status, Working_time, FK_ID_Doctor) VALUES (2, 2, 0, 'No work', 2);
INSERT INTO "Clinic"."Schedule" (ID_schedule, Day_of_week, Working_status, Working_time, FK_ID_Doctor) VALUES (3, 3, 1, '14:00-20:00', 3);
INSERT INTO "Clinic"."Schedule" (ID_schedule, Day_of_week, Working_status, Working_time, FK_ID_Doctor) VALUES (4, 4, 0, 'No work', 4);
INSERT INTO "Clinic"."Schedule" (ID_schedule, Day_of_week, Working_status, Working_time, FK_ID_Doctor) VALUES (5, 5, 1, '08:00-14:00', 5);


--
-- Заполнение таблицы "Pricelist"
--

INSERT INTO "Clinic"."Pricelist" (ID_price, Service_name, Service_price) VALUES (1, 'First Consultation', 2000);
INSERT INTO "Clinic"."Pricelist" (ID_price, Service_name, Service_price) VALUES (2, 'Second/Another Consultation', 1000);
INSERT INTO "Clinic"."Pricelist" (ID_price, Service_name, Service_price) VALUES (3, 'FGDS', 1000);
INSERT INTO "Clinic"."Pricelist" (ID_price, Service_name, Service_price) VALUES (4, 'Vaccination', 500);
INSERT INTO "Clinic"."Pricelist" (ID_price, Service_name, Service_price) VALUES (5, 'Laser therapy', 800);


--
-- Заполнение таблицы "Room"
--

INSERT INTO "Clinic"."Room" (ID_room, Room_num, Room_working_time, Responsible_name, responsible_telephone, inner_telephone) VALUES (1, 21, '08:00-20:00', 'Anton Igorevich Govorov', 89152283317, 256987);
INSERT INTO "Clinic"."Room" (ID_room, Room_num, Room_working_time, Responsible_name, responsible_telephone, inner_telephone) VALUES (2, 22, '08:00-20:00', 'Anton Igorevich Govorov', 89152283317, 145897);
INSERT INTO "Clinic"."Room" (ID_room, Room_num, Room_working_time, Responsible_name, responsible_telephone, inner_telephone) VALUES (3, 23, '08:00-20:00', 'Anton Igorevich Govorov', 89152283317, 124536);
INSERT INTO "Clinic"."Room" (ID_room, Room_num, Room_working_time, Responsible_name, responsible_telephone, inner_telephone) VALUES (4, 24, '08:00-20:00', 'Anton Igorevich Govorov', 89152283317, 145896);
INSERT INTO "Clinic"."Room" (ID_room, Room_num, Room_working_time, Responsible_name, responsible_telephone, inner_telephone) VALUES (5, 25, '08:00-20:00', 'Anton Igorevich Govorov', 89152283317, 147859);


--
-- Заполнение таблицы "Reception"
--

INSERT INTO "Clinic"."Reception" (ID_reception, FK_ID_Price, FK_ID_room, FK_ID_med_book, FK_ID_Doctor, Reception_Date_Time) VALUES (1, 1, 1, 1, 2, '12:00 monday');
INSERT INTO "Clinic"."Reception" (ID_reception, FK_ID_Price, FK_ID_room, FK_ID_med_book, FK_ID_Doctor, Reception_Date_Time) VALUES (2, 1, 3, 2, 5, '19;00 wednesday');
INSERT INTO "Clinic"."Reception" (ID_reception, FK_ID_Price, FK_ID_room, FK_ID_med_book, FK_ID_Doctor, Reception_Date_Time) VALUES (3, 1, 3, 3, 1, '17:00 wednesday');
INSERT INTO "Clinic"."Reception" (ID_reception, FK_ID_Price, FK_ID_room, FK_ID_med_book, FK_ID_Doctor, Reception_Date_Time) VALUES (4, 2, 1, 4, 3, '10:00 monday');
INSERT INTO "Clinic"."Reception" (ID_reception, FK_ID_Price, FK_ID_room, FK_ID_med_book, FK_ID_Doctor, Reception_Date_Time) VALUES (5, 2, 5, 5, 4, '08:00 friday');


--
-- Заполнение таблицы "Payment"
--

INSERT INTO "Clinic"."Payment" (FK_ID_reception, Type_of_payment, Summ, Sale_date, Status) VALUES (1, 'cash', 2000, 25-05-2020, 1);
INSERT INTO "Clinic"."Payment" (FK_ID_reception, Type_of_payment, Summ, Sale_date, Status) VALUES (2, 'card', 1000, 16-05-2020, 0);
INSERT INTO "Clinic"."Payment" (FK_ID_reception, Type_of_payment, Summ, Sale_date, Status) VALUES (3, 'cash', 5000, 20-05-2020, 1);
INSERT INTO "Clinic"."Payment" (FK_ID_reception, Type_of_payment, Summ, Sale_date, Status) VALUES (4, 'card', 2000, 21-05-2020, 1);
INSERT INTO "Clinic"."Payment" (FK_ID_reception, Type_of_payment, Summ, Sale_date, Status) VALUES (5, 'cash', 1000, 28-05-2020, 1);



--
-- Связи между таблицами (PRIMARY KEY & FOREIGN KEY), установка ограничений целостности
--

ALTER TABLE ONLY "Clinic"."Patient"
    ADD CONSTRAINT "Patient_pkey" PRIMARY KEY (ID_patient);

ALTER TABLE ONLY "Clinic"."Diagnoses"
    ADD CONSTRAINT "Diagnoses_pkey" PRIMARY KEY (ID_diagnose);

ALTER TABLE ONLY "Clinic"."Medical_book"
    ADD CONSTRAINT "Medical_book_pkey" PRIMARY KEY (ID_med_book);

ALTER TABLE ONLY "Clinic"."Specialization"
    ADD CONSTRAINT "Specialization_pkey" PRIMARY KEY (ID_Specialization);

ALTER TABLE ONLY "Clinic"."Doctor"
    ADD CONSTRAINT "Doctor_pkey" PRIMARY KEY (ID_doctor);

ALTER TABLE ONLY "Clinic"."Schedule"
    ADD CONSTRAINT "Schedule_pkey" PRIMARY KEY (ID_schedule);

ALTER TABLE ONLY "Clinic"."Pricelist"
    ADD CONSTRAINT "Pricelist_pkey" PRIMARY KEY (ID_price);

ALTER TABLE ONLY "Clinic"."Room"
    ADD CONSTRAINT "Room_pkey" PRIMARY KEY (ID_room);

ALTER TABLE ONLY "Clinic"."Reception"
    ADD CONSTRAINT "Reception_pkey" PRIMARY KEY (ID_reception);

ALTER TABLE ONLY "Clinic"."Payment"
    ADD CONSTRAINT "Payment_pkey" PRIMARY KEY (FK_ID_reception);
	


ALTER TABLE ONLY "Clinic"."Medical_book"
    ADD CONSTRAINT "FK_ID_patient" FOREIGN KEY (FK_ID_patient) REFERENCES "Clinic"."Patient"(ID_patient) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Medical_book"
    ADD CONSTRAINT "FK_ID_Diagnose" FOREIGN KEY (FK_ID_Diagnose) REFERENCES "Clinic"."Diagnoses"(ID_Diagnose) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Doctor"
    ADD CONSTRAINT "FK_ID_Specialization" FOREIGN KEY (FK_ID_Specialization) REFERENCES "Clinic"."Specialization"(ID_Specialization) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Schedule"
    ADD CONSTRAINT "FK_ID_Doctor" FOREIGN KEY (FK_ID_Doctor) REFERENCES "Clinic"."Doctor"(ID_doctor) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Reception"
    ADD CONSTRAINT "FK_ID_Price" FOREIGN KEY (FK_ID_Price) REFERENCES "Clinic"."Pricelist"(ID_price) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Reception"
    ADD CONSTRAINT "FK_ID_room" FOREIGN KEY (FK_ID_room) REFERENCES "Clinic"."Room"(ID_room) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Reception"
    ADD CONSTRAINT "FK_ID_med_book" FOREIGN KEY (FK_ID_med_book) REFERENCES "Clinic"."Medical_book"(ID_med_book) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Reception"
    ADD CONSTRAINT "FK_ID_Doctor" FOREIGN KEY (FK_ID_Doctor) REFERENCES "Clinic"."Doctor"(ID_Doctor) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Clinic"."Payment"
    ADD CONSTRAINT "FK_ID_reception" FOREIGN KEY (FK_ID_reception) REFERENCES "Clinic"."Reception"(ID_reception) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;
