--Делаем таблицу диагнозов 
CREATE TABLE "ClinicDB"."Diagnoses"
(
    diagnosis_id integer NOT NULL,
    diagnosis_name "char" NOT NULL,
    CONSTRAINT "Diagnoses_pkey" PRIMARY KEY (diagnosis_id)
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."Diagnoses"
    OWNER to postgres;

INSERT INTO "ClinicDB"."Diagnoses" VALUES
(1, 'Pharyngitis'),
(2, 'Myopia'),
(3, 'Sprained ankle'),
(4, 'Dermatitis'),
(5, 'Gastritis')


-- Делаем таблицу прейскуранта
CREATE TABLE "ClinicDB"."Prices"
(
    service_id integer NOT NULL,
    service_name text COLLATE pg_catalog."default" NOT NULL,
    service_price money NOT NULL,
    CONSTRAINT "Prices_pkey" PRIMARY KEY (service_id)
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."Prices"
    OWNER to postgres;
	
INSERT INTO "ClinicDB"."Prices" VALUES
(1, 'Consultation', 1200),
(2, 'Repeated consultation', 1000),
(3, 'Blood Sampling', 500),
(4, 'Bandaging', 300),
(5, 'Ultrasound', 1000)


-- Делаем таблицу направлений врачей	
CREATE TABLE "ClinicDB"."Specialties"
(
    specialty_id integer NOT NULL,
    specialty_name text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Specialties_pkey" PRIMARY KEY (specialty_id)
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."Specialties"
    OWNER to postgres;

INSERT INTO "ClinicDB"."Specialties" VALUES
(1, 'Otolaryngologist'),
(2, 'Eye doctor'),
(3, 'Trauna surgeon'),
(4, 'Dermatologist'),
(5, 'Gastroenterologist')


-- Добавляем таблицу кабинетов
CREATE TABLE "ClinicDB"."Offices"
(
    office_number integer NOT NULL,
    floor integer NOT NULL,
    field text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Offices_pkey" PRIMARY KEY (office_number)
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."Offices"
    OWNER to postgres;
	
INSERT INTO "ClinicDB"."Offices" VALUES
(12, 1, 'Otolaryngologist'),
(17, 1, 'Eye doctor'),
(23, 2, 'Trauna surgeon'),
(10, 3, 'Dermatologist'),
(20, 4, 'Gastroenterologist')
	
	
--  Таблица медицинских карт 	
CREATE TABLE "ClinicDB"."MedicalFiles"
(
    patient_id integer NOT NULL,
    patient_name text COLLATE pg_catalog."default" NOT NULL,
    patient_sex character(1) COLLATE pg_catalog."default" NOT NULL,
    patient_adress text COLLATE pg_catalog."default" NOT NULL,
    "patient_BD" date NOT NULL,
    patient_contacts text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "MedicalFiles_pkey" PRIMARY KEY (patient_id)
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."MedicalFiles"
    OWNER to postgres;
	
INSERT INTO "ClinicDB"."MedicalFiles" VALUES	
(243, 'Vasiliy Pupkin', 'M', 'Kamennoostrovskiy 96, kv 78', '2000-04-19', '+71488228322'),
(642, 'Stepan Petrov', 'M', '9-line 30, kv 6', '1974-03-20', '+71337133720'),
(457, 'Vika Shvabrina', 'F', 'Nevskiy av 45, kv 89', '1985-06-03', '+72282281337'),
(185, 'Roman Kefirov', 'M', 'ul Pushkina d Kolotushkina', '1996-09-14', '+72283221488'),
(294, 'Anna Dotina', 'F', 'Kronverkskiy av 49', '1994-08-30', 'email@mail.ru')
	
	
	
-- Ассоциативная сущность для связи пациентов и диагнозов
CREATE TABLE "ClinicDB"."IllnesCases"
(
    case_id integer NOT NULL,
    case_start date NOT NULL,
    case_status text COLLATE pg_catalog."default" NOT NULL,
    case_description text COLLATE pg_catalog."default" NOT NULL,
    "patient_id(FK)" integer NOT NULL,
    "diagnosis_id(FK)" integer NOT NULL,
    CONSTRAINT "IllnesCases_pkey" PRIMARY KEY (case_id),
    CONSTRAINT "diagnosis_id(FK)" FOREIGN KEY ("diagnosis_id(FK)")
        REFERENCES "ClinicDB"."Diagnoses" (diagnosis_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "patient_id(FK)" FOREIGN KEY ("patient_id(FK)")
        REFERENCES "ClinicDB"."MedicalFiles" (patient_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."IllnesCases"
    OWNER to postgres;

INSERT INTO "ClinicDB"."IllnesCases" VALUES
(328, '2015-04-09', 'cured in 2 months', 'Mild form', 243, 4),
(345, '2018-01-08', 'cured in 3 weeks', 'Ankle was sprained by accident', 457, 3),
(255, '2019-08-19', 'not cured', 'Initial stage', 642, 5),
(999, '2020-03-16', 'cured in 8 days', 'Bacterial pharyngitis', 185, 1),
(395, '2014-12-18', 'not cured' , 'Strong myopia, -4,5 left eye, -5 right eye', 294, 2);


CREATE TABLE "ClinicDB"."Doctors"
(
    doc_id integer NOT NULL,
    doc_name text COLLATE pg_catalog."default" NOT NULL,
    doc_contacts text COLLATE pg_catalog."default" NOT NULL,
    "doc_TD" text COLLATE pg_catalog."default" NOT NULL,
    "specialty_id(FK)" integer NOT NULL,
    CONSTRAINT "Doctors_pkey" PRIMARY KEY (doc_id),
    CONSTRAINT "specialty_id(FK)" FOREIGN KEY ("specialty_id(FK)")
        REFERENCES "ClinicDB"."Specialties" (specialty_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."Doctors"
    OWNER to postgres;
	
INSERT INTO "ClinicDB"."Doctors" VALUES
(100, 'Vasilisa Pupkina', 'emaildoctora@inbox.ru', 'td100', 2),
(101, 'Stepanida Petrova', '+78275193628', 'td101', 4),
(102, 'Viktor Shvabrin', '+79272638888', 'td102', 1),
(103, 'Romania Kefirova', '+79210231313', 'td103', 3),
(104, 'Angus Dotin', '+79524812234', 'td104', 5)
	
	
	
-- График работы
CREATE TABLE "ClinicDB"."Timetable"
(
    line_id integer NOT NULL,
    "doc_id(FK)" integer NOT NULL,
    date date NOT NULL,
    "office_number(FK)" integer NOT NULL,
    CONSTRAINT "Timetable_pkey" PRIMARY KEY (line_id),
    CONSTRAINT "doc_id(FK)" FOREIGN KEY ("doc_id(FK)")
        REFERENCES "ClinicDB"."Doctors" (doc_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "office_number(FK)" FOREIGN KEY ("office_number(FK)")
        REFERENCES "ClinicDB"."Offices" (office_number) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."Timetable"
    OWNER to postgres;
	
INSERT INTO "ClinicDB"."Timetable" VALUES 
(1, 102, '2020-03-16', 12),
(2, 102, '2020-03-17', 12),
(3, 100, '2020-03-18', 17),
(4, 101, '2020-03-18', 10),
(5, 103, '2020-03-19', 23)

	
-- То ради, чего мы здесь собрались - прием врача 
CREATE TABLE "ClinicDB"."Consultations"
(
	cons_id integer NOT NULL,
	"patient_id(FK)" integer NOT NULL,
	"doc_id(FK)" integer NOT NULL,
    cons_date date NOT NULL,
    patient_condition text COLLATE pg_catalog."default" NOT NULL,
    treatment text NOT NULL,
	"office_number(FK)" integer NOT NULL,
    "service_id(FK)" integer NOT NULL,
    payment_status boolean NOT NULL,
    CONSTRAINT "Consultations_pkey" PRIMARY KEY (cons_id),
    CONSTRAINT "doc_id(FK)" FOREIGN KEY ("doc_id(FK)")
        REFERENCES "ClinicDB"."Doctors" (doc_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "office_number(FK)" FOREIGN KEY ("office_number(FK)")
        REFERENCES "ClinicDB"."Offices" (office_number) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "patient_id(FK)" FOREIGN KEY ("patient_id(FK)")
        REFERENCES "ClinicDB"."MedicalFiles" (patient_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "service_id(FK)" FOREIGN KEY ("service_id(FK)")
        REFERENCES "ClinicDB"."Prices" (service_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE "ClinicDB"."Consultations"
    OWNER to postgres;
	
INSERT INTO "ClinicDB"."Consultations" VALUES 
(1, 185, 102, '2020-03-16', 'urgent', 'blood sampling', 12, 1, 'true'),
(2, 185, 102, '2020-03-17', 'urgent', 'treatment of pharyngitis', 12, 2, 'false'),
(3, 294, 100, '2020-03-18', 'chronic', 'change glasses', 17, 2, 'true'),
(4, 243, 101, '2020-03-18', 'urgent', 'tratment of dermatitis', 10, 1, 'false'),
(5, 457, 103, '2020-03-19', 'urgent', 'make x-ray, bandage', 23, 1, 'true')