-- Database: postgres

-- DROP DATABASE postgres;

CREATE DATABASE postgres
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'C'
    LC_CTYPE = 'C'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

COMMENT ON DATABASE postgres
    IS 'default administrative connection database';

-- SCHEMA: Labour exchange

-- DROP SCHEMA "Labour exchange" ;

CREATE SCHEMA "Labour exchange"
    AUTHORIZATION postgres;

--Создание таблицы соискатель
-- Table: "Labour exchange"."Applicant"

-- DROP TABLE "Labour exchange"."Applicant";

CREATE TABLE "Labour exchange"."Applicant"
(
    "ID_applicant" integer[] NOT NULL,
    "FCS_applicant" "char"[] NOT NULL,
    "Age" integer[],
    "Sex" character(1) COLLATE pg_catalog."default",
    "Contacts" "char"[],
    "Last_salary" integer,
    "Start_receiving_benefits" date,
    "End_benefit_receipt" date,
    CONSTRAINT "Applicant_pkey" PRIMARY KEY ("ID_applicant", "FCS_applicant"),
    CONSTRAINT "Applicant_FCS_applicant_key" UNIQUE ("FCS_applicant"),
    CONSTRAINT "Applicant_ID_applicant_key" UNIQUE ("ID_applicant")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."Applicant"
    OWNER to postgres;

--Создание таблицы бюро
-- Table: "Labour exchange"."Bureau"

-- DROP TABLE "Labour exchange"."Bureau";

CREATE TABLE "Labour exchange"."Bureau"
(
    "ID__bureau" integer NOT NULL,
    "Organization_name" "char"[] NOT NULL,
    "Address" "char"[],
    "ID_job_openings" integer,
    "FCS_employer" "char"[],
    "ID_directory" integer,
    "ID_course" integer,
    "ID_employer" integer[],
    CONSTRAINT "Bureau_pkey" PRIMARY KEY ("ID__bureau", "Organization_name"),
    CONSTRAINT "Bureau_FCS_employer_fkey" FOREIGN KEY ("FCS_employer")
        REFERENCES "Labour exchange"."Employers" ("FCS_employer") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Bureau_ID_course_fkey" FOREIGN KEY ("ID_course")
        REFERENCES "Labour exchange"."Course" ("ID_course") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Bureau_ID_directory_fkey" FOREIGN KEY ("ID_directory")
        REFERENCES "Labour exchange"."Directory_professions" ("ID_directory") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Bureau_ID_employer_fkey" FOREIGN KEY ("ID_employer")
        REFERENCES "Labour exchange"."Employers" ("ID_employer") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Bureau_ID_job_openings_fkey" FOREIGN KEY ("ID_job_openings")
        REFERENCES "Labour exchange"."Job_openings" ("ID_job_openings") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."Bureau"
    OWNER to postgres;
--Создание таблицы резюме
-- Table: "Labour exchange"."CV"

-- DROP TABLE "Labour exchange"."CV";

CREATE TABLE "Labour exchange"."CV"
(
    "ID_CV" integer[] NOT NULL,
    "FCS_applicant" "char"[],
    "ID_job_openings" integer,
    "ID_employer" integer[],
    "FCS_employer" "char"[],
    "ID_directory" integer,
    "ID_applicant" integer[],
    CONSTRAINT "CV_pkey" PRIMARY KEY ("ID_CV"),
    CONSTRAINT "CV_FCS_applicant_fkey" FOREIGN KEY ("FCS_applicant")
        REFERENCES "Labour exchange"."Applicant" ("FCS_applicant") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "CV_FCS_employer_fkey" FOREIGN KEY ("FCS_employer")
        REFERENCES "Labour exchange"."Employers" ("FCS_employer") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "CV_ID_applicant_fkey" FOREIGN KEY ("ID_applicant")
        REFERENCES "Labour exchange"."Applicant" ("ID_applicant") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "CV_ID_directory_fkey" FOREIGN KEY ("ID_directory")
        REFERENCES "Labour exchange"."Directory_professions" ("ID_directory") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "CV_ID_employer_fkey" FOREIGN KEY ("ID_employer")
        REFERENCES "Labour exchange"."Employers" ("ID_employer") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "CV_ID_job_openings_fkey" FOREIGN KEY ("ID_job_openings")
        REFERENCES "Labour exchange"."Job_openings" ("ID_job_openings") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."CV"
    OWNER to postgres;

--Создание таблицы курсы
-- Table: "Labour exchange"."Course"

-- DROP TABLE "Labour exchange"."Course";

CREATE TABLE "Labour exchange"."Course"
(
    "ID_course" integer NOT NULL,
    "New_discharge" "char"[] NOT NULL,
    "Duration" time with time zone[],
    "Price" integer,
    "Group_number" "char"[] NOT NULL,
    "Students_list" "char"[] NOT NULL,
    CONSTRAINT "Course_pkey" PRIMARY KEY ("ID_course")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."Course"
    OWNER to postgres;

--Создание таблицы справочник профессий
-- Table: "Labour exchange"."Directory_professions"

-- DROP TABLE "Labour exchange"."Directory_professions";

CREATE TABLE "Labour exchange"."Directory_professions"
(
    "ID_directory" integer NOT NULL,
    "Course_list" "char"[],
    "ID_course" integer,
    CONSTRAINT "Directory_professions_pkey" PRIMARY KEY ("ID_directory"),
    CONSTRAINT "Directory_professions_ID_course_key" UNIQUE ("ID_course"),
    CONSTRAINT "Directory_professions_ID_directory_key" UNIQUE ("ID_directory"),
    CONSTRAINT "Directory_professions_ID_course_fkey" FOREIGN KEY ("ID_course")
        REFERENCES "Labour exchange"."Course" ("ID_course") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."Directory_professions"
    OWNER to postgres;

--Создание таблицы работодатели
-- Table: "Labour exchange"."Employers"

-- DROP TABLE "Labour exchange"."Employers";

CREATE TABLE "Labour exchange"."Employers"
(
    "ID_employer" integer[] NOT NULL,
    "FCS_employer" "char"[] NOT NULL,
    "Contact_details" "char"[] NOT NULL,
    "Organization_name" "char"[],
    CONSTRAINT "Employers_pkey" PRIMARY KEY ("ID_employer", "FCS_employer"),
    CONSTRAINT "Employers_FCS_employer_key" UNIQUE ("FCS_employer"),
    CONSTRAINT "Employers_ID_employer_key" UNIQUE ("ID_employer")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."Employers"
    OWNER to postgres;

--Создание таблицы вакансии
-- Table: "Labour exchange"."Job_openings"

-- DROP TABLE "Labour exchange"."Job_openings";

CREATE TABLE "Labour exchange"."Job_openings"
(
    "ID_job_openings" integer NOT NULL,
    "Salary" integer,
    "Qualification" "char"[] NOT NULL,
    "Details" "char"[],
    "Type_job" "char"[] NOT NULL,
    "Date_publication" date NOT NULL,
    "Working_conditions" "char"[],
    "Job_status" "char"[] NOT NULL,
    "Work_experience" "char"[],
    "Discharge" "char"[],
    "ID_employer" integer[],
    "FCS_employer" "char"[],
    "ID_course" integer,
    "ID_directory" integer,
    CONSTRAINT "Job_openings_pkey" PRIMARY KEY ("ID_job_openings"),
    CONSTRAINT "Job_openings_ID_job_openings_key" UNIQUE ("ID_job_openings"),
    CONSTRAINT "Job_openings_FCS_employer_fkey" FOREIGN KEY ("FCS_employer")
        REFERENCES "Labour exchange"."Employers" ("FCS_employer") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Job_openings_ID_course_fkey" FOREIGN KEY ("ID_course")
        REFERENCES "Labour exchange"."Course" ("ID_course") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Job_openings_ID_directory_fkey" FOREIGN KEY ("ID_directory")
        REFERENCES "Labour exchange"."Directory_professions" ("ID_directory") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Job_openings_ID_employer_fkey" FOREIGN KEY ("ID_employer")
        REFERENCES "Labour exchange"."Employers" ("ID_employer") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."Job_openings"
    OWNER to postgres;

--Создание таблицы учебный центр
-- Table: "Labour exchange"."Training_center"

-- DROP TABLE "Labour exchange"."Training_center";

CREATE TABLE "Labour exchange"."Training_center"
(
    "ID_training_center" integer NOT NULL,
    "Address" "char"[],
    "FCS_applicant" "char"[] NOT NULL,
    "ID_course" integer NOT NULL,
    "ID_applicant" integer[] NOT NULL,
    CONSTRAINT "Training_center_pkey" PRIMARY KEY ("ID_training_center"),
    CONSTRAINT "Training_center_FCS_applicant_fkey" FOREIGN KEY ("FCS_applicant")
        REFERENCES "Labour exchange"."Applicant" ("FCS_applicant") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Training_center_ID_applicant_fkey" FOREIGN KEY ("ID_applicant")
        REFERENCES "Labour exchange"."Applicant" ("ID_applicant") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "Training_center_ID_course_fkey" FOREIGN KEY ("ID_course")
        REFERENCES "Labour exchange"."Course" ("ID_course") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "Labour exchange"."Training_center"
    OWNER to postgres;


-- Заполнение таблиц
--Таблица соискатель
INSERT INTO "Labour exchange"."Applicant"(
	"ID_applicant", "FCS_applicant", "Age", "Sex", "Contacts", "Last_salary", "Start_receiving_benefits", "End_benefit_receipt")
	VALUES (1, 'В.А. Попов', 19, M, '44-44-44', 30000, '2018-01-01', '2019-01-01');
INSERT INTO "Labour exchange"."Applicant"(
	"ID_applicant", "FCS_applicant", "Age", "Sex", "Contacts", "Last_salary", "Start_receiving_benefits", "End_benefit_receipt")
	VALUES (2, 'П.К. Сидоров', 34, M, '12-12-12', 32000, '2019-03-01', '2020-01-05');
INSERT INTO "Labour exchange"."Applicant"(
	"ID_applicant", "FCS_applicant", "Age", "Sex", "Contacts", "Last_salary", "Start_receiving_benefits", "End_benefit_receipt")
	VALUES (3, 'К.К. Иванов', 23, M, '23-23-23', 12000, '2018-10-01', '2018-11-01');
INSERT INTO "Labour exchange"."Applicant"(
	"ID_applicant", "FCS_applicant", "Age", "Sex", "Contacts", "Last_salary", "Start_receiving_benefits", "End_benefit_receipt")
	VALUES (4, 'Н.У. Лебедев', 32, M, '34-34-34', 21000, '2010-01-01', '2019-11-11');
INSERT INTO "Labour exchange"."Applicant"(
	"ID_applicant", "FCS_applicant", "Age", "Sex", "Contacts", "Last_salary", "Start_receiving_benefits", "End_benefit_receipt")
	VALUES (5, 'Л.С. Желтова', 44, F, '57-32-65', 29000, '2014-07-01', '2019-05-05');

--Таблица резюме
INSERT INTO "Labour exchange"."CV"(
	"ID_CV", "FCS_applicant", "ID_job_openings", "ID_employer", "FCS_employer", "ID_directory", "ID_applicant")
	VALUES (1, 'В.А. Попов', 1, 1, 'А.О. Попов', 1, 1);
INSERT INTO "Labour exchange"."CV"(
	"ID_CV", "FCS_applicant", "ID_job_openings", "ID_employer", "FCS_employer", "ID_directory", "ID_applicant")
	VALUES (2, 'П.К. Сидоров', 2, 2, 'Е.Ф. Сидоров', 2, 2);
INSERT INTO "Labour exchange"."CV"(
	"ID_CV", "FCS_applicant", "ID_job_openings", "ID_employer", "FCS_employer", "ID_directory", "ID_applicant")
	VALUES (3, 'К.К. Иванов', 3, 3, 'С.В. Иванов', 3, 3);
INSERT INTO "Labour exchange"."CV"(
	"ID_CV", "FCS_applicant", "ID_job_openings", "ID_employer", "FCS_employer", "ID_directory", "ID_applicant")
	VALUES (4, 'Н.У. Лебедев', 4, 4, 'Л.Т. Лебедев', 4, 4);
INSERT INTO "Labour exchange"."CV"(
	"ID_CV", "FCS_applicant", "ID_job_openings", "ID_employer", "FCS_employer", "ID_directory", "ID_applicant")
	VALUES (5, 'Л.С. Желтова', 5, 5, 'О.Н. Желтова', 5, 5);

--Таблица курсы
INSERT INTO "Labour exchange"."Course"(
	"ID_course", "New_discharge", "Duration", "Price", "Group_number", "Students_list")
	VALUES (1, 'Красить', 14:05:06, 3000, 'K3240', 'В.А. Попов, Л.С. Желтова, К.К. Иванов, Н.У. Лебедев');
INSERT INTO "Labour exchange"."Course"(
	"ID_course", "New_discharge", "Duration", "Price", "Group_number", "Students_list")
	VALUES (2, 'Пилить', 05:10:56, 4000, 'K3340', 'В.А. Попов, К.К. Иванов');
INSERT INTO "Labour exchange"."Course"(
	"ID_course", "New_discharge", "Duration", "Price", "Group_number", "Students_list")
	VALUES (3, 'Резать', 01:05:45, 1000, 'K2144', 'В.А. Попов, Л.С. Желтова, Н.У. Лебедев');
INSERT INTO "Labour exchange"."Course"(
	"ID_course", "New_discharge", "Duration", "Price", "Group_number", "Students_list")
	VALUES (4, 'Программировать', 56:05:22, 7000, 'K2320', 'В.А. Попов, Л.С. Желтова, Н.У. Лебедев');
INSERT INTO "Labour exchange"."Course"(
	"ID_course", "New_discharge", "Duration", "Price", "Group_number", "Students_list")
	VALUES (5, 'Быстро ездить', 39:45:22, 6000, 'K4441', 'В.А. Попов, К.К. Иванов');

--Таблица справочник профессий
INSERT INTO "Labour exchange"."Directory_professions"(
	"ID_directory", "Course_list", "ID_course")
	VALUES (1, 'Красить', 1);
INSERT INTO "Labour exchange"."Directory_professions"(
	"ID_directory", "Course_list", "ID_course")
	VALUES (2, 'Красить', 1);
INSERT INTO "Labour exchange"."Directory_professions"(
	"ID_directory", "Course_list", "ID_course")
	VALUES (3, 'Пилить', 2);
INSERT INTO "Labour exchange"."Directory_professions"(
	"ID_directory", "Course_list", "ID_course")
	VALUES (4, 'Быстро ездить', 5);
INSERT INTO "Labour exchange"."Directory_professions"(
	"ID_directory", "Course_list", "ID_course")
	VALUES (5, 'Быстро ездить', 5);


--Таблица работодатели
INSERT INTO "Labour exchange"."Employers"(
	"ID_employer", "FCS_employer", "Contact_details", "Organization_name")
	VALUES (1, 'А.О. Попов', '11-11-11', 'Яндекс');
INSERT INTO "Labour exchange"."Employers"(
	"ID_employer", "FCS_employer", "Contact_details", "Organization_name")
	VALUES (2, 'Е.Ф. Сидоров', '22-22-22', 'Apple');
INSERT INTO "Labour exchange"."Employers"(
	"ID_employer", "FCS_employer", "Contact_details", "Organization_name")
	VALUES (3, 'С.В. Иванов', '33-33-33', 'Facebook');
INSERT INTO "Labour exchange"."Employers"(
	"ID_employer", "FCS_employer", "Contact_details", "Organization_name")
	VALUES (4, 'Л.Т. Лебедев', '44-44-44', 'Aviasales');
INSERT INTO "Labour exchange"."Employers"(
	"ID_employer", "FCS_employer", "Contact_details", "Organization_name")
	VALUES (5, 'О.Н. Желтова', '55-55-55', 'Xiaomi');

--Таблица вакансии
INSERT INTO "Labour exchange"."Job_openings"(
	"ID_job_openings", "Salary", "Qualification", "Details", "Type_job", "Date_publication", "Working_conditions", "Job_status", "Work_experience", "Discharge", "ID_employer", "FCS_employer", "ID_course", "ID_directory")
	VALUES (1, 10000, 'Junior', '', 'Открытая', '2020-02-11', 'Плохие', 'Актуальна', '1 год', 'Высший', 1, 'А.О. Попов', 1, 1);
INSERT INTO "Labour exchange"."Job_openings"(
	"ID_job_openings", "Salary", "Qualification", "Details", "Type_job", "Date_publication", "Working_conditions", "Job_status", "Work_experience", "Discharge", "ID_employer", "FCS_employer", "ID_course", "ID_directory")
	VALUES (2, 20000, 'Junior', 'Есть кофе', 'Открытая', '2020-01-12', 'Отличные', 'Актуальна', '10 лет', 'Средний', 2, 2, 'Е.Ф. Сидоров', 2, 2);
INSERT INTO "Labour exchange"."Job_openings"(
	"ID_job_openings", "Salary", "Qualifica''ion", "Details", "Type_job", "Date_publication", "Working_conditions", "Job_status", "Work_experience", "Discharge", "ID_employer", "FCS_employer", "ID_course", "ID_directory")
	VALUES (3, 30000, 'Midle', 'Бьют палкой', 'Открытая', '2020-04-05', 'Плохие', 'Актуальна', '4 года', 'Средний', 3, 3, 'С.В. Иванов', 3, 3);
INSERT INTO "Labour exchange"."Job_openings"(
	"ID_job_openings", "Salary", "Qualification", "Details", "Type_job", "Date_publication", "Working_conditions", "Job_status", "Work_experience", "Discharge", "ID_employer", "FCS_employer", "ID_course", "ID_directory")
	VALUES (4, 40000, 'Midle', 'Нужна машина', 'Открытая', '2020-05-08', 'Хорошие', 'Актуальна', 'Отсутствует', 'Низкий', 4, 4, 'Л.Т. Лебедев', 4, 4);
INSERT INTO "Labour exchange"."Job_openings"(
	"ID_job_openings", "Salary", "Qualification", "Details", "Type_job", "Date_publication", "Working_conditions", "Job_status", "Work_experience", "Discharge", "ID_employer", "FCS_employer", "ID_course", "ID_directory")
	VALUES (5, 50000, 'Senior', 'Свой кабинет', 'Закрытая', '2020-01-10', 'Отличные', 'Актуальна', '5 лет', 'Высший', 5, 5, 'О.Н. Желтова', 5, 5);


--Таблица бюро
INSERT INTO "Labour exchange"."Bureau"(
	"ID__bureau", "Organization_name", "Address", "ID_job_openings", "FCS_employer", "ID_directory", "ID_course", "ID_employer")
	VALUES (1, 'Работа с нами', '​Гороховая, 1​Адмиралтейский проспект, 8', 1, 1, 1, 1, 1);
INSERT INTO "Labour exchange"."Bureau"(
	"ID__bureau", "Organization_name", "Address", "ID_job_openings", "FCS_employer", "ID_directory", "ID_course", "ID_employer")
	VALUES (2, 'Поиск работы', 'Гражданская, 5', 2, 2, 2, 2, 2);
INSERT INTO "Labour exchange"."Bureau"(
	"ID__bureau", "Organization_name", "Address", "ID_job_openings", "FCS_employer", "ID_directory", "ID_course", "ID_employer")
	VALUES (3, 'Работа-дома', '​Пирогова переулок, 19​Прачечный переулок, 5', 3, 3, 3, 3, 3);
INSERT INTO "Labour exchange"."Bureau"(
	"ID__bureau", "Organization_name", "Address", "ID_job_openings", "FCS_employer", "ID_directory", "ID_course", "ID_employer")
	VALUES (4, 'Работа везде', 'Вознесенский проспект, 51', 4, 4, 4, 4, 4);
INSERT INTO "Labour exchange"."Bureau"(
	"ID__bureau", "Organization_name", "Address", "ID_job_openings", "FCS_employer", "ID_directory", "ID_course", "ID_employer")
	VALUES (5, 'Топовое бюро', 'Красноармейская 10-я, 11', 5, 5, 5, 5, 5);


--Таблица учебный центр
INSERT INTO "Labour exchange"."Training_center"(
	"ID_training_center", "Address", "FCS_applicant", "ID_course", "ID_applicant")
	VALUES (1, 'Якубовича, 22', 'В.А. Попов', 1, 1);
INSERT INTO "Labour exchange"."Training_center"(
	"ID_trainin''_center", "Address", "FCS_applicant", "ID_course", "ID_applicant")
	VALUES (2, 'Галерная, 14', 'П.К. Сидоров', 2, 2);
INSERT INTO "Labour exchange"."Training_center"(
	"ID_training_center", "Address", "FCS_applicant", "ID_course", "ID_applicant")
	VALUES (3, '​Набережная реки Мойки, 93​Большая Морская, 48', 'К.К. Иванов', 3, 3);
INSERT INTO "Labour exchange"."Training_center"(
	"ID_training_center", "Address", "FCS_applicant", "ID_course", "ID_applicant")
	VALUES (4, '​Английский проспект, 5​Рабочий переулок, 1', 'Н.У. Лебедев', 4, 4);
INSERT INTO "Labour exchange"."Training_center"(
	"ID_training_center", "Address", "FCS_applicant", "ID_course", "ID_applicant")
	VALUES (5, 'Союза Печатников, 10', 'Л.С. Желтова', 5, 5);

