--
-- PostgreSQL database dump
--

-- Dumped from database version 12.3
-- Dumped by pg_dump version 12.3

-- Started on 2020-06-29 23:30:26

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
-- TOC entry 6 (class 2615 OID 16414)
-- Name: school; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA school;


ALTER SCHEMA school OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 205 (class 1259 OID 16457)
-- Name: class; Type: TABLE; Schema: school; Owner: postgres
--

CREATE TABLE school.class (
    id_class integer NOT NULL,
    id_teacher integer NOT NULL,
    number_class character varying(255) NOT NULL
);


ALTER TABLE school.class OWNER TO postgres;

--
-- TOC entry 2914 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE class; Type: COMMENT; Schema: school; Owner: postgres
--

COMMENT ON TABLE school.class IS 'Таблица "класс"';


--
-- TOC entry 208 (class 1259 OID 16618)
-- Name: class_id_class_seq; Type: SEQUENCE; Schema: school; Owner: postgres
--

ALTER TABLE school.class ALTER COLUMN id_class ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME school.class_id_class_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 207 (class 1259 OID 16478)
-- Name: journale; Type: TABLE; Schema: school; Owner: postgres
--

CREATE TABLE school.journale (
    id_journale integer NOT NULL,
    id_subject integer NOT NULL,
    id_pupil integer NOT NULL,
    grade integer NOT NULL,
    quarter integer NOT NULL
);


ALTER TABLE school.journale OWNER TO postgres;

--
-- TOC entry 2915 (class 0 OID 0)
-- Dependencies: 207
-- Name: TABLE journale; Type: COMMENT; Schema: school; Owner: postgres
--

COMMENT ON TABLE school.journale IS 'Таблица "журнал"';


--
-- TOC entry 211 (class 1259 OID 16624)
-- Name: journale_id_journale_seq; Type: SEQUENCE; Schema: school; Owner: postgres
--

ALTER TABLE school.journale ALTER COLUMN id_journale ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME school.journale_id_journale_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 203 (class 1259 OID 16415)
-- Name: office; Type: TABLE; Schema: school; Owner: postgres
--

CREATE TABLE school.office (
    id_office integer NOT NULL,
    number_office integer NOT NULL,
    floor_number integer NOT NULL
);


ALTER TABLE school.office OWNER TO postgres;

--
-- TOC entry 2916 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE office; Type: COMMENT; Schema: school; Owner: postgres
--

COMMENT ON TABLE school.office IS 'Таблица "кабинет"';


--
-- TOC entry 210 (class 1259 OID 16622)
-- Name: office_id_office_seq; Type: SEQUENCE; Schema: school; Owner: postgres
--

ALTER TABLE school.office ALTER COLUMN id_office ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME school.office_id_office_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 216 (class 1259 OID 16833)
-- Name: pupil; Type: TABLE; Schema: school; Owner: postgres
--

CREATE TABLE school.pupil (
    id_pupil integer NOT NULL,
    name_pupil character varying(255) NOT NULL,
    id_class integer NOT NULL,
    id_teacher integer NOT NULL,
    sex character varying(255) NOT NULL
);


ALTER TABLE school.pupil OWNER TO postgres;

--
-- TOC entry 2917 (class 0 OID 0)
-- Dependencies: 216
-- Name: TABLE pupil; Type: COMMENT; Schema: school; Owner: postgres
--

COMMENT ON TABLE school.pupil IS 'Таблица "ученик"';


--
-- TOC entry 215 (class 1259 OID 16831)
-- Name: pupil_id_pupil_seq; Type: SEQUENCE; Schema: school; Owner: postgres
--

ALTER TABLE school.pupil ALTER COLUMN id_pupil ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME school.pupil_id_pupil_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 213 (class 1259 OID 16804)
-- Name: subject; Type: TABLE; Schema: school; Owner: postgres
--

CREATE TABLE school.subject (
    id_subject integer NOT NULL,
    type_subject character varying(255),
    name_subject character varying(255) NOT NULL,
    id_teacher integer NOT NULL
);


ALTER TABLE school.subject OWNER TO postgres;

--
-- TOC entry 2918 (class 0 OID 0)
-- Dependencies: 213
-- Name: TABLE subject; Type: COMMENT; Schema: school; Owner: postgres
--

COMMENT ON TABLE school.subject IS 'Таблица "дисциплина"';


--
-- TOC entry 214 (class 1259 OID 16829)
-- Name: subject_id_subject_seq; Type: SEQUENCE; Schema: school; Owner: postgres
--

ALTER TABLE school.subject ALTER COLUMN id_subject ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME school.subject_id_subject_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 204 (class 1259 OID 16444)
-- Name: teacher; Type: TABLE; Schema: school; Owner: postgres
--

CREATE TABLE school.teacher (
    id_teacher integer NOT NULL,
    id_office integer NOT NULL,
    name_teacher character varying(255) NOT NULL
);


ALTER TABLE school.teacher OWNER TO postgres;

--
-- TOC entry 2919 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE teacher; Type: COMMENT; Schema: school; Owner: postgres
--

COMMENT ON TABLE school.teacher IS 'Таблица "учитель"';


--
-- TOC entry 209 (class 1259 OID 16620)
-- Name: teacher_id_teacher_seq; Type: SEQUENCE; Schema: school; Owner: postgres
--

ALTER TABLE school.teacher ALTER COLUMN id_teacher ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME school.teacher_id_teacher_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 206 (class 1259 OID 16462)
-- Name: timetable; Type: TABLE; Schema: school; Owner: postgres
--

CREATE TABLE school.timetable (
    id_timetable integer NOT NULL,
    id_teacher integer NOT NULL,
    id_office integer NOT NULL,
    id_subject integer NOT NULL,
    date_ date NOT NULL,
    lesson_number integer NOT NULL,
    id_class integer NOT NULL,
    type_subject character varying(255)
);


ALTER TABLE school.timetable OWNER TO postgres;

--
-- TOC entry 2920 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE timetable; Type: COMMENT; Schema: school; Owner: postgres
--

COMMENT ON TABLE school.timetable IS 'Таблица "расписание"';


--
-- TOC entry 212 (class 1259 OID 16630)
-- Name: timetable_id_timetable_seq; Type: SEQUENCE; Schema: school; Owner: postgres
--

ALTER TABLE school.timetable ALTER COLUMN id_timetable ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME school.timetable_id_timetable_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 2897 (class 0 OID 16457)
-- Dependencies: 205
-- Data for Name: class; Type: TABLE DATA; Schema: school; Owner: postgres
--

COPY school.class (id_class, id_teacher, number_class) FROM stdin;
1	1	2A
2	2	1B
4	3	6A
6	5	7G
8	6	11A
\.


--
-- TOC entry 2899 (class 0 OID 16478)
-- Dependencies: 207
-- Data for Name: journale; Type: TABLE DATA; Schema: school; Owner: postgres
--

COPY school.journale (id_journale, id_subject, id_pupil, grade, quarter) FROM stdin;
1	1	1	5	2
2	1	1	5	1
3	2	2	3	1
5	2	4	4	1
6	1	5	2	1
7	6	6	4	1
\.


--
-- TOC entry 2895 (class 0 OID 16415)
-- Dependencies: 203
-- Data for Name: office; Type: TABLE DATA; Schema: school; Owner: postgres
--

COPY school.office (id_office, number_office, floor_number) FROM stdin;
1	9	1
2	15	1
3	26	2
4	21	2
5	39	3
\.


--
-- TOC entry 2908 (class 0 OID 16833)
-- Dependencies: 216
-- Data for Name: pupil; Type: TABLE DATA; Schema: school; Owner: postgres
--

COPY school.pupil (id_pupil, name_pupil, id_class, id_teacher, sex) FROM stdin;
1	Pryadko_Alexey_Hohlovich	1	1	M
2	Shmeleva_Ksenia_Viktorovna	1	1	F
4	Astafiev_Peter_Dmitrievich	2	2	M
5	Medvedev_Dmitry_Anatolievich	4	3	M
6	Yeltsin_Boris_Nikolaevich	4	3	M
\.


--
-- TOC entry 2905 (class 0 OID 16804)
-- Dependencies: 213
-- Data for Name: subject; Type: TABLE DATA; Schema: school; Owner: postgres
--

COPY school.subject (id_subject, type_subject, name_subject, id_teacher) FROM stdin;
1	\N	Physics	1
2	\N	Russian	2
3	\N	English	3
5	specialized	mathematics	5
6	basic	mathematics	6
\.


--
-- TOC entry 2896 (class 0 OID 16444)
-- Dependencies: 204
-- Data for Name: teacher; Type: TABLE DATA; Schema: school; Owner: postgres
--

COPY school.teacher (id_teacher, id_office, name_teacher) FROM stdin;
1	1	Ivanov_Ivan_Ivanovich
2	2	Petrova_Anna_Nikolaevna
3	3	Boikov_Evgeny_Vilievich
5	4	Sharova_Svetlana_Mikhailovna
6	5	Demchenko_Sergey_Petrovich
\.


--
-- TOC entry 2898 (class 0 OID 16462)
-- Dependencies: 206
-- Data for Name: timetable; Type: TABLE DATA; Schema: school; Owner: postgres
--

COPY school.timetable (id_timetable, id_teacher, id_office, id_subject, date_, lesson_number, id_class, type_subject) FROM stdin;
1	1	1	1	2020-06-29	1	1	\N
2	2	2	2	2020-06-29	2	2	\N
3	3	3	3	2020-06-29	6	4	\N
4	5	4	5	2020-06-29	4	6	specialized
5	6	5	6	2020-06-29	1	8	basic
\.


--
-- TOC entry 2921 (class 0 OID 0)
-- Dependencies: 208
-- Name: class_id_class_seq; Type: SEQUENCE SET; Schema: school; Owner: postgres
--

SELECT pg_catalog.setval('school.class_id_class_seq', 8, true);


--
-- TOC entry 2922 (class 0 OID 0)
-- Dependencies: 211
-- Name: journale_id_journale_seq; Type: SEQUENCE SET; Schema: school; Owner: postgres
--

SELECT pg_catalog.setval('school.journale_id_journale_seq', 7, true);


--
-- TOC entry 2923 (class 0 OID 0)
-- Dependencies: 210
-- Name: office_id_office_seq; Type: SEQUENCE SET; Schema: school; Owner: postgres
--

SELECT pg_catalog.setval('school.office_id_office_seq', 5, true);


--
-- TOC entry 2924 (class 0 OID 0)
-- Dependencies: 215
-- Name: pupil_id_pupil_seq; Type: SEQUENCE SET; Schema: school; Owner: postgres
--

SELECT pg_catalog.setval('school.pupil_id_pupil_seq', 6, true);


--
-- TOC entry 2925 (class 0 OID 0)
-- Dependencies: 214
-- Name: subject_id_subject_seq; Type: SEQUENCE SET; Schema: school; Owner: postgres
--

SELECT pg_catalog.setval('school.subject_id_subject_seq', 6, true);


--
-- TOC entry 2926 (class 0 OID 0)
-- Dependencies: 209
-- Name: teacher_id_teacher_seq; Type: SEQUENCE SET; Schema: school; Owner: postgres
--

SELECT pg_catalog.setval('school.teacher_id_teacher_seq', 6, true);


--
-- TOC entry 2927 (class 0 OID 0)
-- Dependencies: 212
-- Name: timetable_id_timetable_seq; Type: SEQUENCE SET; Schema: school; Owner: postgres
--

SELECT pg_catalog.setval('school.timetable_id_timetable_seq', 5, true);


--
-- TOC entry 2737 (class 2606 OID 16675)
-- Name: class class_id_class_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.class
    ADD CONSTRAINT class_id_class_key UNIQUE (id_class);


--
-- TOC entry 2739 (class 2606 OID 16793)
-- Name: class class_id_teacher_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.class
    ADD CONSTRAINT class_id_teacher_key UNIQUE (id_teacher);


--
-- TOC entry 2741 (class 2606 OID 16461)
-- Name: class class_pkey; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.class
    ADD CONSTRAINT class_pkey PRIMARY KEY (id_class, id_teacher);


--
-- TOC entry 2747 (class 2606 OID 16677)
-- Name: journale journale_id_journale_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.journale
    ADD CONSTRAINT journale_id_journale_key UNIQUE (id_journale);


--
-- TOC entry 2749 (class 2606 OID 16485)
-- Name: journale journale_pkey; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.journale
    ADD CONSTRAINT journale_pkey PRIMARY KEY (id_journale);


--
-- TOC entry 2727 (class 2606 OID 16789)
-- Name: office office_id_office_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.office
    ADD CONSTRAINT office_id_office_key UNIQUE (id_office);


--
-- TOC entry 2729 (class 2606 OID 16791)
-- Name: office office_number_office_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.office
    ADD CONSTRAINT office_number_office_key UNIQUE (number_office);


--
-- TOC entry 2731 (class 2606 OID 16419)
-- Name: office office_pkey; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.office
    ADD CONSTRAINT office_pkey PRIMARY KEY (id_office);


--
-- TOC entry 2755 (class 2606 OID 16877)
-- Name: pupil pupil_id_pupil_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.pupil
    ADD CONSTRAINT pupil_id_pupil_key UNIQUE (id_pupil);


--
-- TOC entry 2757 (class 2606 OID 16840)
-- Name: pupil pupil_pkey; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.pupil
    ADD CONSTRAINT pupil_pkey PRIMARY KEY (id_pupil);


--
-- TOC entry 2751 (class 2606 OID 16813)
-- Name: subject subject_id_subject_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.subject
    ADD CONSTRAINT subject_id_subject_key UNIQUE (id_subject);


--
-- TOC entry 2753 (class 2606 OID 16811)
-- Name: subject subject_pkey; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.subject
    ADD CONSTRAINT subject_pkey PRIMARY KEY (id_subject);


--
-- TOC entry 2733 (class 2606 OID 16685)
-- Name: teacher teacher_id_teacher_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.teacher
    ADD CONSTRAINT teacher_id_teacher_key UNIQUE (id_teacher);


--
-- TOC entry 2735 (class 2606 OID 16448)
-- Name: teacher teacher_pkey; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.teacher
    ADD CONSTRAINT teacher_pkey PRIMARY KEY (id_teacher);


--
-- TOC entry 2743 (class 2606 OID 16687)
-- Name: timetable timetable_id_timetable_key; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.timetable
    ADD CONSTRAINT timetable_id_timetable_key UNIQUE (id_timetable);


--
-- TOC entry 2745 (class 2606 OID 16469)
-- Name: timetable timetable_pkey; Type: CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.timetable
    ADD CONSTRAINT timetable_pkey PRIMARY KEY (id_timetable);


--
-- TOC entry 2759 (class 2606 OID 16491)
-- Name: class class_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.class
    ADD CONSTRAINT class_fkey FOREIGN KEY (id_teacher) REFERENCES school.teacher(id_teacher) NOT VALID;


--
-- TOC entry 2762 (class 2606 OID 16703)
-- Name: timetable id_class_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.timetable
    ADD CONSTRAINT id_class_fkey FOREIGN KEY (id_class) REFERENCES school.class(id_class) NOT VALID;


--
-- TOC entry 2767 (class 2606 OID 16852)
-- Name: pupil id_class_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.pupil
    ADD CONSTRAINT id_class_fkey FOREIGN KEY (id_class) REFERENCES school.class(id_class) NOT VALID;


--
-- TOC entry 2761 (class 2606 OID 16693)
-- Name: timetable id_office_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.timetable
    ADD CONSTRAINT id_office_fkey FOREIGN KEY (id_office) REFERENCES school.office(id_office) NOT VALID;


--
-- TOC entry 2764 (class 2606 OID 16878)
-- Name: journale id_pupil_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.journale
    ADD CONSTRAINT id_pupil_fkey FOREIGN KEY (id_pupil) REFERENCES school.pupil(id_pupil) NOT VALID;


--
-- TOC entry 2765 (class 2606 OID 16819)
-- Name: journale id_subject_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.journale
    ADD CONSTRAINT id_subject_fkey FOREIGN KEY (id_subject) REFERENCES school.subject(id_subject) NOT VALID;


--
-- TOC entry 2763 (class 2606 OID 16824)
-- Name: timetable id_subject_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.timetable
    ADD CONSTRAINT id_subject_fkey FOREIGN KEY (id_subject) REFERENCES school.subject(id_subject) NOT VALID;


--
-- TOC entry 2760 (class 2606 OID 16688)
-- Name: timetable id_teacher_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.timetable
    ADD CONSTRAINT id_teacher_fkey FOREIGN KEY (id_teacher) REFERENCES school.teacher(id_teacher) NOT VALID;


--
-- TOC entry 2766 (class 2606 OID 16814)
-- Name: subject id_teacher_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.subject
    ADD CONSTRAINT id_teacher_fkey FOREIGN KEY (id_teacher) REFERENCES school.teacher(id_teacher) NOT VALID;


--
-- TOC entry 2768 (class 2606 OID 16857)
-- Name: pupil id_teacher_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.pupil
    ADD CONSTRAINT id_teacher_fkey FOREIGN KEY (id_teacher) REFERENCES school.class(id_teacher) NOT VALID;


--
-- TOC entry 2758 (class 2606 OID 16486)
-- Name: teacher teacher_fkey; Type: FK CONSTRAINT; Schema: school; Owner: postgres
--

ALTER TABLE ONLY school.teacher
    ADD CONSTRAINT teacher_fkey FOREIGN KEY (id_office) REFERENCES school.office(id_office) NOT VALID;


-- Completed on 2020-06-29 23:30:26

--
-- PostgreSQL database dump complete
--

