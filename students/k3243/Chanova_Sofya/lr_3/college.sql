--
-- PostgreSQL database dump
--

-- Dumped from database version 10.10 (Ubuntu 10.10-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 12.2 (Ubuntu 12.2-2.pgdg18.04+1)

-- Started on 2020-04-30 17:27:54 MSK

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- создание базы данных "Колледж" - вариант 12
--

CREATE DATABASE "College" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';


ALTER DATABASE "College" OWNER TO postgres;

\connect -reuse-previous=on "dbname='College'"


CREATE SCHEMA college;


ALTER SCHEMA college OWNER TO postgres;

SET default_tablespace = '';

--
-- создание таблицы "classroom" - "Кабинет"
--

CREATE TABLE college.classroom (
    number_classroom integer NOT NULL,
    subject_theme text,
    seats integer
);


ALTER TABLE college.classroom OWNER TO postgres;

--
-- создание таблицы "group" - "Учебная группа"
--

CREATE TABLE college."group" (
    number_group integer NOT NULL,
    number_course integer,
    name_course text,
    faculty text
);


ALTER TABLE college."group" OWNER TO postgres;

--
-- создание таблицы "student" - "Студент"
--

CREATE TABLE college.student (
    full_name_student text,
    id_student integer NOT NULL,
    number_group integer,
    education_form text
);


ALTER TABLE college.student OWNER TO postgres;

--
-- создание таблицы "subject" - "Дисциплина"
--

CREATE TABLE college.subject (
    id_subject integer NOT NULL,
    name_subject text NOT NULL,
    hours_amount text,
    pass_or_exam text
);


ALTER TABLE college.subject OWNER TO postgres;

--
-- создание таблицы "teacher" - "Преподаватель"
--

CREATE TABLE college.teacher (
    id_teacher integer NOT NULL,
    full_name_teacher text NOT NULL,
    experience_teacher text,
    qualifications text
);


ALTER TABLE college.teacher OWNER TO postgres;

--
-- создание таблицы "semester_grade" - "Оценка за семестр"
--

CREATE TABLE college.semester_grade (
    id_student integer NOT NULL,
    number_group integer NOT NULL,
    id_subject integer NOT NULL,
    grade text,
    number_semester integer
);


ALTER TABLE college.semester_grade OWNER TO postgres;

--
-- создание таблицы "schedule" - "Расписание"
--

CREATE TABLE college.schedule (
    date date NOT NULL,
    weekday text NOT NULL,
    number_classroom integer,
    id_teacher integer,
    number_group integer,
    id_subject integer
);


ALTER TABLE college.schedule OWNER TO postgres;

--
-- создание таблицы "teaching" - "Преподавание",
-- связующей сущности для связи дисциплин
-- с преподавателями
--

CREATE TABLE college.teaching (
    id_teacher integer NOT NULL,
    id_subject integer NOT NULL
);


ALTER TABLE college.teaching OWNER TO postgres;


--
-- создание таблицы "classroom_teacher" - "Кабинет-Преподаватель",
-- связующей сущности для привязки кабинетов
-- к преподавателям
--


CREATE TABLE college.classroom_teacher (
    id_teacher integer NOT NULL,
    number_classroom integer NOT NULL
);


ALTER TABLE college.classroom_teacher OWNER TO postgres;

--
-- заполнение таблицы "classroom"
--

INSERT INTO college.classroom (number_classroom, subject_theme, seats) VALUES (10, 'chemistry', 30);
INSERT INTO college.classroom (number_classroom, subject_theme, seats) VALUES (11, 'none', 30);
INSERT INTO college.classroom (number_classroom, subject_theme, seats) VALUES (12, 'computer', 30);
INSERT INTO college.classroom (number_classroom, subject_theme, seats) VALUES (20, 'hall', 300);
INSERT INTO college.classroom (number_classroom, subject_theme, seats) VALUES (13, 'none', 30);

--
-- заполнение таблицы "group"
--

INSERT INTO college."group" (number_group, number_course, name_course, faculty) VALUES (101, 1, 'Zoology', 'Biology');
INSERT INTO college."group" (number_group, number_course, name_course, faculty) VALUES (102, 1, 'Biochemistry', 'Biology');
INSERT INTO college."group" (number_group, number_course, name_course, faculty) VALUES (201, 2, 'Zoology', 'Biology');
INSERT INTO college."group" (number_group, number_course, name_course, faculty) VALUES (203, 2, 'Computer Science', 'IT');
INSERT INTO college."group" (number_group, number_course, name_course, faculty) VALUES (304, 3, 'Data Analysis', 'IT');

--
-- заполнение таблицы "student"
--

INSERT INTO college.student (full_name_student, id_student, number_group, education_form) VALUES ('Pupov Ivan Vasilevitch', 1, 101, 'full-time');
INSERT INTO college.student (full_name_student, id_student, number_group, education_form) VALUES ('Pupova Iriva Vasilevna', 2, 102, 'part-time');
INSERT INTO college.student (full_name_student, id_student, number_group, education_form) VALUES ('Romov Nikita Alexandrovitch', 3, 304, 'full-time');
INSERT INTO college.student (full_name_student, id_student, number_group, education_form) VALUES ('Kotova Regina Evgenevna', 4, 203, 'part-time');
INSERT INTO college.student (full_name_student, id_student, number_group, education_form) VALUES ('Tokareva Elena Yurevna', 5, 101, 'full-time');

--
-- заполнение таблицы "subject"
--

INSERT INTO college.subject (id_subject, name_subject, hours_amount, pass_or_exam) VALUES (1, 'Chemistry', '72', 'exam');
INSERT INTO college.subject (id_subject, name_subject, hours_amount, pass_or_exam) VALUES (2, 'Physics', '80', 'exam');
INSERT INTO college.subject (id_subject, name_subject, hours_amount, pass_or_exam) VALUES (3, 'Biology', '72', 'exam');
INSERT INTO college.subject (id_subject, name_subject, hours_amount, pass_or_exam) VALUES (4, 'Philosophy', '64', 'pass');
INSERT INTO college.subject (id_subject, name_subject, hours_amount, pass_or_exam) VALUES (5, 'Math', '80', 'exam');

--
-- заполнение таблицы "teacher"
--

INSERT INTO college.teacher (id_teacher, full_name_teacher, experience_teacher, qualifications) VALUES (1, 'Platonov Platon Platonovitch', '28 years', 'Philosophy teacher');
INSERT INTO college.teacher (id_teacher, full_name_teacher, experience_teacher, qualifications) VALUES (2, 'Mendeleev Dmitry Ivanovitch', '40 years', 'Chemistry teacher');
INSERT INTO college.teacher (id_teacher, full_name_teacher, experience_teacher, qualifications) VALUES (3, 'Lobachevsky Nikolai Ivanovitch', '10 years', 'Math teacher');
INSERT INTO college.teacher (id_teacher, full_name_teacher, experience_teacher, qualifications) VALUES (4, 'Mechnikov Ilya Ilyich', '18 years', 'Biology teacher');
INSERT INTO college.teacher (id_teacher, full_name_teacher, experience_teacher, qualifications) VALUES (5, 'Stoletov Alexander Grigorievich', '26 years', 'Physics teacher');

--
-- заполнение таблицы "schedule"
--

INSERT INTO college.schedule (date, weekday, number_classroom, id_teacher, number_group, id_subject) VALUES ('2020-04-20', 'Tuesday', 10, 2, 102, 1);
INSERT INTO college.schedule (date, weekday, number_classroom, id_teacher, number_group, id_subject) VALUES ('2020-04-21', 'Tuesday', 11, 1, 203, 4);
INSERT INTO college.schedule (date, weekday, number_classroom, id_teacher, number_group, id_subject) VALUES ('2020-04-22', 'Tuesday', 10, 4, 101, 3);
INSERT INTO college.schedule (date, weekday, number_classroom, id_teacher, number_group, id_subject) VALUES ('2020-04-23', 'Tuesday', 12, 3, 304, 5);
INSERT INTO college.schedule (date, weekday, number_classroom, id_teacher, number_group, id_subject) VALUES ('2020-04-24', 'Tuesday', 13, 5, 201, 2);


--
-- заполнение таблицы "semester_grade"
--

INSERT INTO college.semester_grade (id_student, number_group, id_subject, grade, number_semester) VALUES (1, 101, 1, 'A', 2);
INSERT INTO college.semester_grade (id_student, number_group, id_subject, grade, number_semester) VALUES (2, 102, 2, 'B', 2);
INSERT INTO college.semester_grade (id_student, number_group, id_subject, grade, number_semester) VALUES (3, 304, 3, 'A', 2);
INSERT INTO college.semester_grade (id_student, number_group, id_subject, grade, number_semester) VALUES (4, 203, 4, 'pass', 2);
INSERT INTO college.semester_grade (id_student, number_group, id_subject, grade, number_semester) VALUES (5, 101, 5, 'C', 2);


--
-- заполнение таблицы "teaching"
--

INSERT INTO college.teaching (id_teacher, id_subject) VALUES (1, 4);
INSERT INTO college.teaching (id_teacher, id_subject) VALUES (2, 1);
INSERT INTO college.teaching (id_teacher, id_subject) VALUES (3, 5);
INSERT INTO college.teaching (id_teacher, id_subject) VALUES (4, 3);
INSERT INTO college.teaching (id_teacher, id_subject) VALUES (5, 2);

--
-- заполнение таблицы "classroom_teacher"
--

INSERT INTO college.classroom_teacher (id_teacher, number_classroom) VALUES (1, 11);
INSERT INTO college.classroom_teacher (id_teacher, number_classroom) VALUES (2, 10);
INSERT INTO college.classroom_teacher (id_teacher, number_classroom) VALUES (3, 13);
INSERT INTO college.classroom_teacher (id_teacher, number_classroom) VALUES (4, 11);
INSERT INTO college.classroom_teacher (id_teacher, number_classroom) VALUES (5, 12);

--
-- задание первичных ключей
--

ALTER TABLE ONLY college.classroom_teacher
    ADD CONSTRAINT "classroom-teacher_pkey" PRIMARY KEY (id_teacher);



ALTER TABLE ONLY college.classroom
    ADD CONSTRAINT classroom_pkey PRIMARY KEY (number_classroom);



ALTER TABLE ONLY college."group"
    ADD CONSTRAINT group_pkey PRIMARY KEY (number_group);



ALTER TABLE ONLY college.schedule
    ADD CONSTRAINT schedule_pkey PRIMARY KEY (date);



ALTER TABLE ONLY college.semester_grade
    ADD CONSTRAINT semester_grade_pkey PRIMARY KEY (number_group, id_student, id_subject);



ALTER TABLE ONLY college.student
    ADD CONSTRAINT student_pkey PRIMARY KEY (id_student);



ALTER TABLE ONLY college.subject
    ADD CONSTRAINT subject_pkey PRIMARY KEY (id_subject);



ALTER TABLE ONLY college.teacher
    ADD CONSTRAINT teacher_pkey PRIMARY KEY (id_teacher);



ALTER TABLE ONLY college.teaching
    ADD CONSTRAINT teaching_pkey PRIMARY KEY (id_teacher);


--
-- задание внешних ключей
--

CREATE INDEX "fki_class-teach_class_number_fk" ON college.classroom_teacher USING btree (number_classroom);



CREATE INDEX fki_grade_group_fk ON college.semester_grade USING btree (number_group);



CREATE INDEX fki_grade_student_fk ON college.semester_grade USING btree (id_student);



CREATE INDEX fki_grade_subject_fk ON college.semester_grade USING btree (id_subject);



CREATE INDEX fki_schedule_classroom_fk ON college.schedule USING btree (number_classroom);



CREATE INDEX fki_schedule_group_fk ON college.schedule USING btree (number_group);



CREATE INDEX fki_schedule_subject_fk ON college.schedule USING btree (id_subject);



CREATE INDEX fki_schedule_teacher_id_fk ON college.schedule USING btree (id_teacher);



CREATE INDEX fki_student_group_number_fk ON college.student USING btree (number_group);



CREATE INDEX fki_teaching_subject_id_fk ON college.teaching USING btree (id_subject);



ALTER TABLE ONLY college.classroom_teacher
    ADD CONSTRAINT "class-teach_class_number_fk" FOREIGN KEY (number_classroom) REFERENCES college.classroom(number_classroom) NOT VALID;



ALTER TABLE ONLY college.classroom_teacher
    ADD CONSTRAINT "class-teach_teacher_id_fk" FOREIGN KEY (id_teacher) REFERENCES college.teacher(id_teacher) NOT VALID;



ALTER TABLE ONLY college.semester_grade
    ADD CONSTRAINT grade_group_fk FOREIGN KEY (number_group) REFERENCES college."group"(number_group) NOT VALID;



ALTER TABLE ONLY college.semester_grade
    ADD CONSTRAINT grade_student_fk FOREIGN KEY (id_student) REFERENCES college.student(id_student) NOT VALID;



ALTER TABLE ONLY college.semester_grade
    ADD CONSTRAINT grade_subject_fk FOREIGN KEY (id_subject) REFERENCES college.subject(id_subject) NOT VALID;



ALTER TABLE ONLY college.schedule
    ADD CONSTRAINT schedule_classroom_fk FOREIGN KEY (number_classroom) REFERENCES college.classroom(number_classroom) NOT VALID;



ALTER TABLE ONLY college.schedule
    ADD CONSTRAINT schedule_group_fk FOREIGN KEY (number_group) REFERENCES college."group"(number_group) NOT VALID;



ALTER TABLE ONLY college.schedule
    ADD CONSTRAINT schedule_subject_fk FOREIGN KEY (id_subject) REFERENCES college.subject(id_subject) NOT VALID;



ALTER TABLE ONLY college.schedule
    ADD CONSTRAINT schedule_teacher_id_fk FOREIGN KEY (id_teacher) REFERENCES college.teacher(id_teacher) NOT VALID;



ALTER TABLE ONLY college.student
    ADD CONSTRAINT student_group_number_fk FOREIGN KEY (number_group) REFERENCES college."group"(number_group) NOT VALID;



ALTER TABLE ONLY college.teaching
    ADD CONSTRAINT teaching_subject_id_fk FOREIGN KEY (id_subject) REFERENCES college.subject(id_subject) NOT VALID;



ALTER TABLE ONLY college.teaching
    ADD CONSTRAINT teaching_teacher_id_fk FOREIGN KEY (id_teacher) REFERENCES college.teacher(id_teacher) NOT VALID;


-- Completed on 2020-04-30 17:27:58 MSK


