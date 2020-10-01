--
-- PostgreSQL database dump
--

-- Dumped from database version 11.3
-- Dumped by pg_dump version 11.3

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

DROP DATABASE "college_management ";
--
-- Name: college_management ; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "college_management " WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';


ALTER DATABASE "college_management " OWNER TO postgres;

\connect -reuse-previous=on "dbname='college_management '"

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
-- Data for Name: discipline; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.discipline (discipline_id, discipline_name, assessment) VALUES (1, 'Database', 'Exam');
INSERT INTO public.discipline (discipline_id, discipline_name, assessment) VALUES (2, 'Physics', 'Exam');
INSERT INTO public.discipline (discipline_id, discipline_name, assessment) VALUES (3, 'Foreign Language', 'Exam');
INSERT INTO public.discipline (discipline_id, discipline_name, assessment) VALUES (4, 'Informatics', 'Exam');
INSERT INTO public.discipline (discipline_id, discipline_name, assessment) VALUES (5, 'Maths', 'Pass/Fall');


--
-- Data for Name: grade; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.grade (discipline_id, point, student_id) VALUES (1, 81, 1);
INSERT INTO public.grade (discipline_id, point, student_id) VALUES (2, 95, 2);
INSERT INTO public.grade (discipline_id, point, student_id) VALUES (3, 94, 3);
INSERT INTO public.grade (discipline_id, point, student_id) VALUES (4, 91, 4);
INSERT INTO public.grade (discipline_id, point, student_id) VALUES (5, 92, 5);


--
-- Data for Name: group; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."group" (group_id, group_name, discipline_id, sumary_report) VALUES (1, 'K3241', 1, NULL);
INSERT INTO public."group" (group_id, group_name, discipline_id, sumary_report) VALUES (2, 'K3242', 2, NULL);
INSERT INTO public."group" (group_id, group_name, discipline_id, sumary_report) VALUES (3, 'K3240', 3, NULL);
INSERT INTO public."group" (group_id, group_name, discipline_id, sumary_report) VALUES (4, 'K3243', 4, NULL);
INSERT INTO public."group" (group_id, group_name, discipline_id, sumary_report) VALUES (5, 'K3244', 5, NULL);


--
-- Data for Name: lecturer; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.lecturer (lecturer_id, discipline_id, first_name, last_name, room_number) VALUES (1, 1, 'Anton', 'Govorov', NULL);
INSERT INTO public.lecturer (lecturer_id, discipline_id, first_name, last_name, room_number) VALUES (2, 2, 'Kirill', 'Boyarsky', NULL);
INSERT INTO public.lecturer (lecturer_id, discipline_id, first_name, last_name, room_number) VALUES (3, 3, 'Anna', 'Vasilevskaya', NULL);
INSERT INTO public.lecturer (lecturer_id, discipline_id, first_name, last_name, room_number) VALUES (4, 4, 'Natalia', 'Serebryanskaya', NULL);
INSERT INTO public.lecturer (lecturer_id, discipline_id, first_name, last_name, room_number) VALUES (5, 5, 'Alexandra', 'Vatyan', NULL);


--
-- Data for Name: manager; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.manager (manager_id, manager_name) VALUES (1, 'Andrew N');


--
-- Data for Name: office; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.office (room_number, lecturer_id, address) VALUES (314, NULL, NULL);
INSERT INTO public.office (room_number, lecturer_id, address) VALUES (313, NULL, NULL);
INSERT INTO public.office (room_number, lecturer_id, address) VALUES (309, 1, 'Birzhevaya Line, 14');


--
-- Data for Name: students; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.students (student_id, group_id, first_name, last_name) VALUES (1, 1, 'Trang', 'Nguyen');
INSERT INTO public.students (student_id, group_id, first_name, last_name) VALUES (2, 2, 'Andrey', 'Velts');
INSERT INTO public.students (student_id, group_id, first_name, last_name) VALUES (3, 3, 'Sergey', 'Dubina');
INSERT INTO public.students (student_id, group_id, first_name, last_name) VALUES (4, 4, 'Evgeniya', 'Matyushina');
INSERT INTO public.students (student_id, group_id, first_name, last_name) VALUES (5, 5, 'Ekaterina', 'Grigoryeva');


--
-- Data for Name: time_table; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.time_table (group_name, leturer_id, manager_id, discipline_id, address, "time") VALUES ('K3241', 1, 1, 1, 'Kronverkskiy Prospekt, 49', '2020-05-04');
INSERT INTO public.time_table (group_name, leturer_id, manager_id, discipline_id, address, "time") VALUES ('K3240', 1, 1, 1, 'Kronverkskiy Prospekt, 49', '2020-05-04');
INSERT INTO public.time_table (group_name, leturer_id, manager_id, discipline_id, address, "time") VALUES ('K3242', 1, 1, 1, 'Kronverkskiy Prospekt, 49', '2020-05-04');
INSERT INTO public.time_table (group_name, leturer_id, manager_id, discipline_id, address, "time") VALUES ('K3243', 1, 1, 1, 'Kronverkskiy Prospekt, 49', '2020-05-04');
INSERT INTO public.time_table (group_name, leturer_id, manager_id, discipline_id, address, "time") VALUES ('K3244', 2, 1, 2, 'Ulitsa Lomonosova, 9', '2020-06-08');


--
-- Name: Group_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Group_group_id_seq"', 1, false);


--
-- Name: discipline_discipline_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.discipline_discipline_id_seq', 1, false);


--
-- Name: grade_discipline_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grade_discipline_id_seq', 1, false);


--
-- Name: grade_student_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grade_student_id_seq', 1, false);


--
-- Name: lecturer_discipline_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lecturer_discipline_id_seq', 1, false);


--
-- Name: lecturer_lecturer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lecturer_lecturer_id_seq', 1, false);


--
-- Name: manager_manager_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.manager_manager_id_seq', 1, false);


--
-- Name: students_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.students_group_id_seq', 1, false);


--
-- Name: students_student_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.students_student_id_seq', 1, false);


--
-- Name: time_table_discipline_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.time_table_discipline_id_seq', 1, false);


--
-- Name: time_table_leturer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.time_table_leturer_id_seq', 1, false);


--
-- Name: time_table_manager_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.time_table_manager_id_seq', 1, false);


--
-- PostgreSQL database dump complete
--

