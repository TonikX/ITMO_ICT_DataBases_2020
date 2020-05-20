-- Database: college

-- DROP DATABASE college;

CREATE DATABASE college
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'C'
    LC_CTYPE = 'C'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

-- SCHEMA: public

-- DROP SCHEMA public ;

CREATE SCHEMA public
    AUTHORIZATION postgres;

COMMENT ON SCHEMA public
    IS 'standard public schema';

GRANT ALL ON SCHEMA public TO PUBLIC;

GRANT ALL ON SCHEMA public TO postgres;

-- Table: public.classroom

-- DROP TABLE public.classroom;

CREATE TABLE public.classroom
(
    id_classroom integer NOT NULL,
    number_of_classroom integer,
    CONSTRAINT classroom_pkey PRIMARY KEY (id_classroom)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.classroom
    OWNER to postgres;

-- Table: public.classroom_for_teacher

-- DROP TABLE public.classroom_for_teacher;

CREATE TABLE public.classroom_for_teacher
(
    id_teacher integer,
    id_classroom integer,
    CONSTRAINT id_classroom FOREIGN KEY (id_classroom)
        REFERENCES public.classroom (id_classroom) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT id_teacher FOREIGN KEY (id_teacher)
        REFERENCES public.teacher (id_teacher) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.classroom_for_teacher
    OWNER to postgres;

-- Table: public.discipline

-- DROP TABLE public.discipline;

CREATE TABLE public.discipline
(
    id_discipline integer NOT NULL,
    title text COLLATE pg_catalog."default",
    credit_units text COLLATE pg_catalog."default",
    academic_plan text COLLATE pg_catalog."default",
    CONSTRAINT discipline_pkey PRIMARY KEY (id_discipline)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.discipline
    OWNER to postgres;

-- Table: public."group"

-- DROP TABLE public."group";

CREATE TABLE public."group"
(
    number_of_students integer,
    id_group integer NOT NULL,
    course integer,
    specialization text COLLATE pg_catalog."default",
    faculty text COLLATE pg_catalog."default",
    average_performance text COLLATE pg_catalog."default",
    CONSTRAINT group_pkey PRIMARY KEY (id_group)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."group"
    OWNER to postgres;

-- Table: public.student

-- DROP TABLE public.student;

CREATE TABLE public.student
(
    surname text COLLATE pg_catalog."default",
    id_student integer NOT NULL,
    year_of_receipt integer,
    attendance integer,
    academic_performance integer,
    id_group integer NOT NULL,
    CONSTRAINT student_pkey PRIMARY KEY (id_student),
    CONSTRAINT id_group FOREIGN KEY (id_group)
        REFERENCES public."group" (id_group) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.student
    OWNER to postgres;

-- Table: public.teacher

-- DROP TABLE public.teacher;

CREATE TABLE public.teacher
(
    id_teacher integer NOT NULL,
    surname text COLLATE pg_catalog."default",
    work_experience text COLLATE pg_catalog."default",
    education text COLLATE pg_catalog."default",
    CONSTRAINT teacher_pkey PRIMARY KEY (id_teacher)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.teacher
    OWNER to postgres;

-- Table: public.teaching

-- DROP TABLE public.teaching;

CREATE TABLE public.teaching
(
    id_teacher integer NOT NULL,
    id_discipline integer NOT NULL,
    CONSTRAINT id_discipline FOREIGN KEY (id_teacher)
        REFERENCES public.discipline (id_discipline) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT id_teacher FOREIGN KEY (id_teacher)
        REFERENCES public.teacher (id_teacher) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.teaching
    OWNER to postgres;

-- Table: public.timetable

-- DROP TABLE public.timetable;

CREATE TABLE public.timetable
(
    data date NOT NULL,
    number_of_discipline integer,
    "time" abstime,
    id_group integer,
    id_teacher integer,
    id_discipline integer,
    id_classroom integer,
    CONSTRAINT timetable_pkey PRIMARY KEY (data),
    CONSTRAINT id_classroom FOREIGN KEY (id_classroom)
        REFERENCES public.classroom (id_classroom) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT id_discipline FOREIGN KEY (id_discipline)
        REFERENCES public.discipline (id_discipline) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT id_group FOREIGN KEY (id_group)
        REFERENCES public."group" (id_group) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT id_teacher FOREIGN KEY (id_teacher)
        REFERENCES public.teacher (id_teacher) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.timetable
    OWNER to postgres;

INSERT INTO college.student (
	id_student, surname, year_of_receipt, attendance, academic_performance) 
	VALUES
	(1, 'Ivanov', 1987, 100, 100),
	(2, 'Berg', 2009, 90, 90),
	(3, 'Kravets', 1999, 80, 75),
	(4, 'Hitman', 1975, 36, 60),
	(5, 'Tess', 1990, 60, 80);

INSERT INTO public.classroom(
	id_classroom, number_of_classroom)
	VALUES 
	(1, 134),
	(2, 135),
	(3, 544),
	(4, 184),
	(5, 490);

INSERT INTO public.discipline(
	id_discipline, title, credit_units, academic_plan)
	VALUES 
	(1, 'math', '8', '09.06.90'),
	(2, 'db', '6', '09.06.90'),
	(3, 'vizualization', '7', '09.06.80'),
	(4, 'proga', '3', '09.06.90'),
	(5, 'russian', '6', '09.06.90');

INSERT INTO public.teacher(
	id_teacher, surname, work_experience, education)
	VALUES 
	(1, 'Ivanova', '3 years', 'MGU'),
	(2, 'Filipov', '15 years', 'KrasGU'),
	(3, 'Utkina', '7 years', 'MPHTY'),
	(4, 'Lapina', '5 months', 'Gertsena'),
	(5, 'Larin', '1 month', 'ITMO');

INSERT INTO public.classroom_for_teacher(
	id_teacher, id_classroom)
	VALUES 
	(1, 2),
	(2, 4),
	(4, 4),
	(3, 2),
	(2, 2);

INSERT INTO public."group"(
    id_group, number_of_students, course, specialization, faculty, average_performance)
    VALUES 
    (1, 30, 3, 'bio', 'ICT', 80),
    (2, 20, 2, 'proga', 'ICT', 67),
    (3, 24, 2, 'pharmacy', 'THR', 47),
    (4, 15, 3, 'sport', 'UFC', 50),
    (5, 31, 3, 'art', 'OKL', 78);

INSERT INTO public.teaching(
    id_teacher, id_discipline)
    VALUES 
    (1, 4),
    (3, 2),
    (1, 2),
    (2, 1),
    (4, 3);

INSERT INTO public.timetable(
    class_data, number_of_discipline, class_time, id_group, id_teacher, id_discipline, id_classroom)
    VALUES 
    ('2020-12-15', 3, '12:30:00', 2, 1, 2, 2),
    ('2020-08-26', 2, '07:30:00', 4, 1, 2, 2),
    ('2020-07-14', 1, '06:00:00', 1, 1, 2, 2),
    ('2020-10-09', 2, '11:40:00', 3, 1, 2, 2),
    ('2020-11-16', 1, '13:30:00', 4, 1, 2, 2);