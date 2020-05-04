CREATE SCHEMA enroll;


--создаём таблицу школ
CREATE TABLE enroll."School"
(
    "SchooName" character varying(40) COLLATE pg_catalog."default" NOT NULL,
    "GraduationDate" date NOT NULL,
    "City" character varying(60) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "School_pkey" PRIMARY KEY ("SchooName")
);

--создаем таблицу факультетов
CREATE TABLE enroll."Faculty"
(
    "Email" character varying(40) COLLATE pg_catalog."default" NOT NULL,
    "FacultyName" character varying(40) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Faculty_pkey" PRIMARY KEY ("FacultyName")
);

--создаем таблицу аттестатов 9 класса
CREATE TABLE enroll."Сertificate9"
(
    "ID" integer NOT NULL,
    "AvgGrade" integer,
    "Date" date NOT NULL,
    CONSTRAINT "Сertificate9_pkey" PRIMARY KEY ("ID")
);

--создаем таблицу сертификатов ЕГЭ
CREATE TABLE enroll."CertificateUSE"
(
    "ID" integer NOT NULL,
    "Date" date NOT NULL,
    CONSTRAINT "CertificateUSE_pkey" PRIMARY KEY ("ID")
);

--создаем таблицу паспортов
CREATE TABLE enroll."Passport"
(
    "Number" character(10) COLLATE pg_catalog."default" NOT NULL,
    "Date" date NOT NULL,
    "IssuedBy" character varying(200) COLLATE pg_catalog."default",
    CONSTRAINT "Passport_pkey" PRIMARY KEY ("Number")
);

--создаем таблицу результатов по предметам
CREATE TABLE enroll."DisciplineResult"
(
    "DisciplineName" character varying(40) COLLATE pg_catalog."default" NOT NULL,
    "ID" integer NOT NULL,
    "Certificate9ID" integer,
    "CertificateUSEID" integer,
    "Profile" boolean NOT NULL,
    "Result" integer,
    CONSTRAINT "DisciplineResult_pkey" PRIMARY KEY ("ID"),
    CONSTRAINT "CertificateID" FOREIGN KEY ("Certificate9ID")
        REFERENCES enroll."Сertificate9" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "CertificateUSEID" FOREIGN KEY ("CertificateUSEID")
        REFERENCES enroll."CertificateUSE" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу направлений
CREATE TABLE enroll."Programm"
(
    "ProgrammName" character varying(300) COLLATE pg_catalog."default" NOT NULL,
    "FacultyName" character varying(300) COLLATE pg_catalog."default" NOT NULL,
    "Capacity" integer NOT NULL,
    CONSTRAINT "Programm_pkey" PRIMARY KEY ("ProgrammName"),
    CONSTRAINT "FacultyName" FOREIGN KEY ("FacultyName")
        REFERENCES enroll."Faculty" ("FacultyName") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу абитуриентов
CREATE TABLE enroll."Enrollee"
(
    "ID" integer NOT NULL,
    "Name" character varying(100) COLLATE pg_catalog."default" NOT NULL,
    "Foundation" character varying COLLATE pg_catalog."default" NOT NULL,
    "GoldenMedal" boolean,
    "SilverMedal" boolean,
    "PassportNumber" character(10) COLLATE pg_catalog."default" NOT NULL,
    "Certificate9" integer,
    "CertificateUSE" integer,
    "Preferential" boolean NOT NULL,
    "School" character varying(40) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Enrollee_pkey" PRIMARY KEY ("ID"),
    CONSTRAINT "Certificate9" FOREIGN KEY ("Certificate9")
        REFERENCES enroll."Сertificate9" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "CertificateUSE" FOREIGN KEY ("CertificateUSE")
        REFERENCES enroll."CertificateUSE" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "PassportNumber" FOREIGN KEY ("PassportNumber")
        REFERENCES enroll."Passport" ("Number") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "School" FOREIGN KEY ("School")
        REFERENCES enroll."School" ("SchooName") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем ассоциативную таблицу абитуриента к программе
CREATE TABLE enroll."ProgramToEnrolee"
(
    "Programm" character varying(300) COLLATE pg_catalog."default" NOT NULL,
    "Enrolle" integer NOT NULL,
    "Date" date NOT NULL,
    "Status" character varying(10) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "ProgramToEnrolee_pkey" PRIMARY KEY ("Programm", "Enrolle"),
    CONSTRAINT "Enrollee" FOREIGN KEY ("Enrolle")
        REFERENCES enroll."Enrollee" ("ID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "Programm" FOREIGN KEY ("Programm")
        REFERENCES enroll."Programm" ("ProgrammName") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);






--заполняем таблицу сертификатов ЕГЭ
INSERT INTO enroll."CertificateUSE" VALUES (1, '2019-07-01');
INSERT INTO enroll."CertificateUSE" VALUES (2, '2019-07-01');
INSERT INTO enroll."CertificateUSE" VALUES (3, '2019-07-01');
INSERT INTO enroll."CertificateUSE" VALUES (4, '2019-07-01');
INSERT INTO enroll."CertificateUSE" VALUES (5, '2019-07-01');

--заполняем таблицу аттестатов 9-ого класса
INSERT INTO enroll."Сertificate9" VALUES (1, 5, '2019-07-01');
INSERT INTO enroll."Сertificate9" VALUES (2, 5, '2019-07-01');
INSERT INTO enroll."Сertificate9" VALUES (3, 5, '2019-07-01');
INSERT INTO enroll."Сertificate9" VALUES (4, 5, '2019-07-01');
INSERT INTO enroll."Сertificate9" VALUES (5, 5, '2019-07-01');

--заполняем таблицу результатов по дисциплинам
INSERT INTO enroll."DisciplineResult" VALUES ('Math', 1, NULL, 1, true, 5);
INSERT INTO enroll."DisciplineResult" VALUES ('Math', 2, NULL, 2, true, 5);
INSERT INTO enroll."DisciplineResult" VALUES ('Math', 3, NULL, 3, true, 4);
INSERT INTO enroll."DisciplineResult" VALUES ('Math', 4, NULL, 4, true, 4);
INSERT INTO enroll."DisciplineResult" VALUES ('Math', 5, NULL, 5, true, 3);
INSERT INTO enroll."DisciplineResult" VALUES ('Beerology', 6, 1, NULL, false, 5);
INSERT INTO enroll."DisciplineResult" VALUES ('Beerology', 7, 2, NULL, false, 5);
INSERT INTO enroll."DisciplineResult" VALUES ('Beerology', 8, 3, NULL, false, 5);
INSERT INTO enroll."DisciplineResult" VALUES ('Beerology', 9, 4, NULL, false, 5);
INSERT INTO enroll."DisciplineResult" VALUES ('Beerology', 10, 5, NULL, false, 5);

--заполняем таблицу паспортов
INSERT INTO enroll."Passport" VALUES ('3222444444', '2015-04-22', 'OUFMS ROSSII');
INSERT INTO enroll."Passport" VALUES ('3222554444', '2015-04-22', 'OUFMS ROSSII');
INSERT INTO enroll."Passport" VALUES ('3226654444', '2015-04-22', 'OUFMS ROSSII');
INSERT INTO enroll."Passport" VALUES ('3277654444', '2015-04-22', 'OUFMS ROSSII');
INSERT INTO enroll."Passport" VALUES ('3277658224', '2015-04-22', 'OUFMS ROSSII');

--заполняем таблицу факультетов
INSERT INTO enroll."Faculty" VALUES ('zmih@university.edu', 'Faculty of Zmihovedenie');
INSERT INTO enroll."Faculty" VALUES ('math@university.edu', 'Faculty of Math');
INSERT INTO enroll."Faculty" VALUES ('tranzmihaciya@university.edu', 'Faculty of transzmihaciya');
INSERT INTO enroll."Faculty" VALUES ('history@university.edu', 'Faculty of history');
INSERT INTO enroll."Faculty" VALUES ('beerpong@university.edu', 'Faculty of beerpong');

--заполняем таблицу школ
INSERT INTO enroll."School" VALUES ('School #282', '2019-06-21', 'Saint-Petersburg');
INSERT INTO enroll."School" VALUES ('School #522', '2019-06-20', 'Saint-Petersburg');
INSERT INTO enroll."School" VALUES ('School #322', '2019-06-22', 'Moscow');
INSERT INTO enroll."School" VALUES ('School of Ahmat Kadyrov', '2019-05-25', 'Grozny');
INSERT INTO enroll."School" VALUES ('School #1', '2019-06-25', 'Rostov-on-Don');

--заполняем таблицу программ(направлений)
INSERT INTO enroll."Programm" VALUES ('Math', 'Faculty of Math', 30);
INSERT INTO enroll."Programm" VALUES ('Ancient History', 'Faculty of history', 30);
INSERT INTO enroll."Programm" VALUES ('Modern history', 'Faculty of history', 30);
INSERT INTO enroll."Programm" VALUES ('IT', 'Faculty of Math', 30);
INSERT INTO enroll."Programm" VALUES ('Beerpong Technologies', 'Faculty of beerpong', 20);

--заполняем таблицу абитуриентов
INSERT INTO enroll."Enrollee" VALUES (1, 'Zubenko Michael Petrovich', 'Budget', true, false, '3222444444', 1, 1, false, 'School #1');
INSERT INTO enroll."Enrollee" VALUES (2, 'Zmishenko Valery', 'Contract', false, true, '3222554444', 2, 2, false, 'School #282');
INSERT INTO enroll."Enrollee" VALUES (3, 'Putin Vladimir', 'Budget', true, true, '3222554444', 3, 3, true, 'School of Ahmat Kadyrov');
INSERT INTO enroll."Enrollee" VALUES (4, 'Banketniy Vladimir', 'Budget', true, true, '3277654444', 4, 4, true, 'School of Ahmat Kadyrov');
INSERT INTO enroll."Enrollee" VALUES (5, 'Udmurt Vladimir', 'Budget', true, true, '3277658224', 5, 5, true, 'School of Ahmat Kadyrov');

--заполняем ассоциативную таблицу абитуриента к направлению
INSERT INTO enroll."ProgramToEnrolee" VALUES ('Math', 1, '2019-08-01', 'Enrolled');
INSERT INTO enroll."ProgramToEnrolee" VALUES ('Beerpong Technologies', 2, '2019-08-01', 'Enrolled');
INSERT INTO enroll."ProgramToEnrolee" VALUES ('IT', 3, '2019-08-01', 'Enrolled');
INSERT INTO enroll."ProgramToEnrolee" VALUES ('Modern history', 4, '2019-08-01', 'Enrolled');
INSERT INTO enroll."ProgramToEnrolee" VALUES ('Math', 5, '2019-08-01', 'Enrolled');






