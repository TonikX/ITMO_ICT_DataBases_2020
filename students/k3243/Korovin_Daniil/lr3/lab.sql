CREATE SCHEMA enroll_comission;


--создание таблиц:
--создание таблицы школ
CREATE TABLE enroll_comission."School"
(
	"Name" character varying(40) COLLATE pg_catalog."default" NOT NULL,
	"Graduation_date" date NOT NULL,
	"School_location" character varying(50) COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT "School_pkey" PRIMARY KEY ("Name")
);
--создание таблицы паспортов
CREATE TABLE enroll_comission."Passport"
(
	"ID" character (10) COLLATE pg_catalog."default" NOT NULL,
	"Issue_date" date NOT NULL,
	"Issued_by" character varying(100) COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT "Passport_pkey" PRIMARY KEY ("ID")
);
--создаем тип для определения вида либо наличия медали
 CREATE TYPE medal_type AS ENUM ('none', 'silver', 'golden');
--создание таблицы медалей
CREATE TABLE enroll_comission."Medal"
(
	"ID" integer NOT NULL,
	"Type" medal_type NOT NULL,
	CONSTRAINT "Medal_pkey" PRIMARY KEY ("ID")
);
--создание таблицы направлений
CREATE TABLE enroll_comission."Course"
(
	"ID" integer NOT NULL,
	"Name" character varying(40) COLLATE pg_catalog."default" NOT NULL,
	"Available_slots" integer NOT NULL,
	CONSTRAINT "Course_pkey" PRIMARY KEY ("ID")
);
--создание таблицы аттестатов
CREATE TABLE enroll_comission."School_sertificate"
(
	"ID" integer NOT NULL,
	"Issue_date" date NOT NULL,
	"Avg_grade" smallint NOT NULL,
	CONSTRAINT "School_sertificate_pkey" PRIMARY KEY ("ID")
);
--создание таблицы сертификатов
CREATE TABLE enroll_comission."EGE_sertificate"
(
	"ID" integer NOT NULL,
	"Issue_date" date NOT NULL,
	CONSTRAINT "EGE_sertificate_pkey" PRIMARY KEY ("ID")
);
--создание таблицы результатов
CREATE TABLE enroll_comission."Subj_res"
(
	"ID" integer NOT NULL,
	"Name" character varying(40) COLLATE pg_catalog."default" NOT NULL,
	"Grade" integer NOT NULL,
	"isProfile" boolean NOT NULL,
	"School_sertificate_ID" integer,
	"EGE_sertificate_ID" integer,
	CONSTRAINT "Subj_res_pkey" PRIMARY KEY ("ID"),
    CONSTRAINT "School_sertificate_ID" FOREIGN KEY ("School_sertificate_ID")
        REFERENCES enroll_comission."School_sertificate" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "EGE_sertificate_ID" FOREIGN KEY ("EGE_sertificate_ID")
        REFERENCES enroll_comission."EGE_sertificate" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
--создание таблицы абитуриентов
CREATE TABLE enroll_comission."Enrolee"
(
	"ID" integer NOT NULL,
	"Name" character (40) COLLATE pg_catalog."default" NOT NULL,
	"Passport_ID" character (10) COLLATE pg_catalog."default" NOT NULL,
	"Budget" boolean,
	"Privileges" boolean,
	"Target" boolean,
	"School_name" character varying(40) COLLATE pg_catalog."default" NOT NULL,
	"School_sertificate_ID" integer,
	"EGE_sertificate_ID" integer,
	"Medal_ID" integer,
	CONSTRAINT "Enrolee_pkey" PRIMARY KEY ("ID"),
	CONSTRAINT "Passport_ID" FOREIGN KEY ("Passport_ID")
        REFERENCES enroll_comission."Passport" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "School_sertificate_ID" FOREIGN KEY ("School_sertificate_ID")
        REFERENCES enroll_comission."School_sertificate" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "EGE_sertificate_ID" FOREIGN KEY ("EGE_sertificate_ID")
        REFERENCES enroll_comission."EGE_sertificate" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "Medal_ID" FOREIGN KEY ("Medal_ID")
        REFERENCES enroll_comission."Medal" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
--создание таблицы заявок
CREATE TABLE enroll_comission."Application"
(
	"ID" integer NOT NULL,
	"Enrolee_ID" integer NOT NULL,
	"Course_ID" integer NOT NULL,
	"Application_date" date NOT NULL,
	"Status" character varying(20) COLLATE pg_catalog."default" NOT NULL,
	CONSTRAINT "Application_pkey" PRIMARY KEY ("ID"),
	CONSTRAINT "Enrolee_ID" FOREIGN KEY ("Enrolee_ID")
        REFERENCES enroll_comission."Enrolee" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "Course_ID" FOREIGN KEY ("Course_ID")
        REFERENCES enroll_comission."Course" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--заполнение таблиц:

--школа
INSERT INTO enroll_comission."School" VALUES ('School #1', '2019-06-20', 'Moscow');
INSERT INTO enroll_comission."School" VALUES ('School #2', '2019-06-20', 'Saint-Petersburg');
INSERT INTO enroll_comission."School" VALUES ('School #3', '2019-06-20', 'Moscow');
INSERT INTO enroll_comission."School" VALUES ('School #4', '2019-06-20', 'Kazan');
INSERT INTO enroll_comission."School" VALUES ('School #5', '2019-06-20', 'Orel');

--паспорт
INSERT INTO enroll_comission."Passport" VALUES ('4112123456','2015-05-10','MVD RF');
INSERT INTO enroll_comission."Passport" VALUES ('4113654321','2015-04-28','MVD RF');
INSERT INTO enroll_comission."Passport" VALUES ('4114098765','2015-07-16','MVD RF');
INSERT INTO enroll_comission."Passport" VALUES ('4115228359','2015-02-14','MVD RF');
INSERT INTO enroll_comission."Passport" VALUES ('4116114488','2015-09-04','MVD RF');

--аттестат
INSERT INTO enroll_comission."School_sertificate" VALUES (1,'2019-07-01', 4);
INSERT INTO enroll_comission."School_sertificate" VALUES (2,'2019-07-01', 3);
INSERT INTO enroll_comission."School_sertificate" VALUES (3,'2019-07-01', 5);
INSERT INTO enroll_comission."School_sertificate" VALUES (4,'2019-07-01', 4);
INSERT INTO enroll_comission."School_sertificate" VALUES (5,'2019-07-01', 5);

--егэ
INSERT INTO enroll_comission."EGE_sertificate" VALUES (1,'2019-07-01');
INSERT INTO enroll_comission."EGE_sertificate" VALUES (2,'2019-07-01');
INSERT INTO enroll_comission."EGE_sertificate" VALUES (3,'2019-07-01');
INSERT INTO enroll_comission."EGE_sertificate" VALUES (4,'2019-07-01');
INSERT INTO enroll_comission."EGE_sertificate" VALUES (5,'2019-07-01');

--предмет
INSERT INTO enroll_comission."Subj_res" VALUES (1, 'Math', 4, false, 1, NULL);
INSERT INTO enroll_comission."Subj_res" VALUES (2, 'Math', 3, false, 2, NULL);
INSERT INTO enroll_comission."Subj_res" VALUES (3, 'Math', 5, false, 3, NULL);
INSERT INTO enroll_comission."Subj_res" VALUES (4, 'Math', 4, false, 4, NULL);
INSERT INTO enroll_comission."Subj_res" VALUES (5, 'Math', 5, false, 5, NULL);
INSERT INTO enroll_comission."Subj_res" VALUES (6, 'Chemistry', 60, true, NULL,1);
INSERT INTO enroll_comission."Subj_res" VALUES (7, 'Chemistry', 80, true, NULL,2);
INSERT INTO enroll_comission."Subj_res" VALUES (8, 'Chemistry', 90, true, NULL,3);
INSERT INTO enroll_comission."Subj_res" VALUES (9, 'Chemistry', 42, true, NULL,4);
INSERT INTO enroll_comission."Subj_res" VALUES (10, 'Chemistry', 99, true, NULL,5);

--медаль
INSERT INTO enroll_comission."Medal" VALUES (1,'golden');
INSERT INTO enroll_comission."Medal" VALUES (2,'silver');
INSERT INTO enroll_comission."Medal" VALUES (3,'silver');

--направление
INSERT INTO enroll_comission."Course" VALUES (1,'Course name 1',100);
INSERT INTO enroll_comission."Course" VALUES (2,'Course name 2',200);
INSERT INTO enroll_comission."Course" VALUES (3,'Course name 3',300);

--абитура
INSERT INTO enroll_comission."Enrolee" VALUES (1,'Ivanov Ivan Ivanovich','4112123456', true, true, false,'School #1', 1, 1, 2);
INSERT INTO enroll_comission."Enrolee" VALUES (2,'Dugin Alexander Gelevich','4113654321', true, false, true,'School #2', 2, 2, NULL);
INSERT INTO enroll_comission."Enrolee" VALUES (3,'Familiya Imya Otchestvo','4114098765', true, false, true,'School #3', 3, 3, 1);
INSERT INTO enroll_comission."Enrolee" VALUES (4,'Privet Eto Ya','4115228359', false, false, false,'School #4', 4, 4, 2);
INSERT INTO enroll_comission."Enrolee" VALUES (5,'Govorov Anton Igorevich','4116114488', true, false, false,'School #5', 5, 5, NULL);

--заявка
INSERT INTO enroll_comission."Application" VALUES(1, 1, 1, '2019-08-01', 'Approved');
INSERT INTO enroll_comission."Application" VALUES(2, 2, 1, '2019-08-01', 'Approved');
INSERT INTO enroll_comission."Application" VALUES(3, 3, 2, '2019-08-01', 'Rejected');
INSERT INTO enroll_comission."Application" VALUES(4, 4, 2, '2019-08-01', 'In process');
INSERT INTO enroll_comission."Application" VALUES(5, 5, 3, '2019-08-01', 'Approved');
