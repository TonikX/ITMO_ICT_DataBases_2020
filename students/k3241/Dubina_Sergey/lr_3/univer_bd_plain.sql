--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-04-20 22:25:12

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
-- TOC entry 6 (class 2615 OID 16394)
-- Name: university; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA university;


ALTER SCHEMA university OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 211 (class 1259 OID 16564)
-- Name: 9_grade_certificat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."9_grade_certificat" (
    abiturient_id_fk integer NOT NULL,
    prof_discipline_1 integer NOT NULL,
    prof_discipline_2 integer NOT NULL,
    prof_discipline_3 integer NOT NULL,
    prof_discipline_4 integer NOT NULL,
    average_grade integer NOT NULL
);


ALTER TABLE public."9_grade_certificat" OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 16573)
-- Name: Application; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Application" (
    secretary_id_fk integer NOT NULL,
    abiturient_id_fk integer NOT NULL,
    application_date date NOT NULL
);


ALTER TABLE public."Application" OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16474)
-- Name: EGE_sertificat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."EGE_sertificat" (
    abiturient_id_fk integer NOT NULL,
    discipline_1_grade integer NOT NULL,
    discipline_2_grade integer NOT NULL
);


ALTER TABLE public."EGE_sertificat" OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16452)
-- Name: abiturient; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.abiturient (
    fio text NOT NULL,
    birthday date NOT NULL,
    faculty_id_fk integer NOT NULL,
    abiturient_id integer NOT NULL,
    speciality_id_fk integer NOT NULL,
    school_num_fk integer NOT NULL,
    passport_info text NOT NULL,
    gold_medal boolean,
    silver_medal boolean,
    form_of_studying text NOT NULL,
    graduation_date date NOT NULL,
    organisation text
);


ALTER TABLE public.abiturient OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16496)
-- Name: abiturient_abiturient_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.abiturient_abiturient_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.abiturient_abiturient_id_seq OWNER TO postgres;

--
-- TOC entry 2900 (class 0 OID 0)
-- Dependencies: 207
-- Name: abiturient_abiturient_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.abiturient_abiturient_id_seq OWNED BY public.abiturient.abiturient_id;


--
-- TOC entry 204 (class 1259 OID 16460)
-- Name: faculty; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.faculty (
    faculty_name text NOT NULL,
    faculty_id integer NOT NULL
);


ALTER TABLE public.faculty OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16485)
-- Name: faculty_faculty_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.faculty_faculty_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.faculty_faculty_id_seq OWNER TO postgres;

--
-- TOC entry 2901 (class 0 OID 0)
-- Dependencies: 206
-- Name: faculty_faculty_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.faculty_faculty_id_seq OWNED BY public.faculty.faculty_id;


--
-- TOC entry 208 (class 1259 OID 16527)
-- Name: school; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.school (
    school_num integer NOT NULL,
    location text NOT NULL
);


ALTER TABLE public.school OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16588)
-- Name: secretary; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.secretary (
    secretary_id integer NOT NULL,
    secretary_contacts text NOT NULL,
    fio text NOT NULL,
    work_experience text NOT NULL
);


ALTER TABLE public.secretary OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 16586)
-- Name: secretary_secretary_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.secretary_secretary_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.secretary_secretary_id_seq OWNER TO postgres;

--
-- TOC entry 2902 (class 0 OID 0)
-- Dependencies: 213
-- Name: secretary_secretary_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.secretary_secretary_id_seq OWNED BY public.secretary.secretary_id;


--
-- TOC entry 210 (class 1259 OID 16543)
-- Name: speciality; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.speciality (
    speciality_id integer NOT NULL,
    faculty_id_fk integer NOT NULL,
    spciality_name text NOT NULL,
    max_stud_amount integer NOT NULL,
    min_grade integer NOT NULL
);


ALTER TABLE public.speciality OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 16541)
-- Name: speciality_speciality_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.speciality_speciality_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.speciality_speciality_id_seq OWNER TO postgres;

--
-- TOC entry 2903 (class 0 OID 0)
-- Dependencies: 209
-- Name: speciality_speciality_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.speciality_speciality_id_seq OWNED BY public.speciality.speciality_id;


--
-- TOC entry 2727 (class 2604 OID 16498)
-- Name: abiturient abiturient_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abiturient ALTER COLUMN abiturient_id SET DEFAULT nextval('public.abiturient_abiturient_id_seq'::regclass);


--
-- TOC entry 2728 (class 2604 OID 16487)
-- Name: faculty faculty_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.faculty ALTER COLUMN faculty_id SET DEFAULT nextval('public.faculty_faculty_id_seq'::regclass);


--
-- TOC entry 2730 (class 2604 OID 16591)
-- Name: secretary secretary_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretary ALTER COLUMN secretary_id SET DEFAULT nextval('public.secretary_secretary_id_seq'::regclass);


--
-- TOC entry 2729 (class 2604 OID 16546)
-- Name: speciality speciality_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.speciality ALTER COLUMN speciality_id SET DEFAULT nextval('public.speciality_speciality_id_seq'::regclass);


--
-- TOC entry 2891 (class 0 OID 16564)
-- Dependencies: 211
-- Data for Name: 9_grade_certificat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."9_grade_certificat" (abiturient_id_fk, prof_discipline_1, prof_discipline_2, prof_discipline_3, prof_discipline_4, average_grade) FROM stdin;
1	4	5	3	3	4
2	3	3	5	4	4
3	5	5	5	5	5
4	3	4	3	3	3
5	4	5	5	4	4
\.


--
-- TOC entry 2892 (class 0 OID 16573)
-- Dependencies: 212
-- Data for Name: Application; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Application" (secretary_id_fk, abiturient_id_fk, application_date) FROM stdin;
1	5	2020-09-04
2	4	2020-09-06
3	3	2020-09-02
4	2	2020-09-04
5	1	2020-09-03
\.


--
-- TOC entry 2885 (class 0 OID 16474)
-- Dependencies: 205
-- Data for Name: EGE_sertificat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."EGE_sertificat" (abiturient_id_fk, discipline_1_grade, discipline_2_grade) FROM stdin;
1	89	78
2	88	69
3	92	79
4	84	87
5	78	82
\.


--
-- TOC entry 2883 (class 0 OID 16452)
-- Dependencies: 203
-- Data for Name: abiturient; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.abiturient (fio, birthday, faculty_id_fk, abiturient_id, speciality_id_fk, school_num_fk, passport_info, gold_medal, silver_medal, form_of_studying, graduation_date, organisation) FROM stdin;
Дубина С.Д.	2000-12-08	1	1	5	121	5386298	f	t	budget	2018-03-14	\N
Вельц A.A.	2000-02-03	2	2	4	32	46357357	f	f	budget	2018-03-05	DSSDS
Махотина Е.Г.	2000-08-06	3	3	3	456	5637358	f	t	contract	2018-03-07	\N
Матюшина Е.Д.	2000-07-08	4	4	2	3	88734799	t	t	budget	2018-05-14	\N
Тарасов А.Р.	2000-12-04	5	5	1	33	13235356	f	t	budget	2018-03-14	\N
\.


--
-- TOC entry 2884 (class 0 OID 16460)
-- Dependencies: 204
-- Data for Name: faculty; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.faculty (faculty_name, faculty_id) FROM stdin;
IKT	41
BIT	42
BTINS	43
FTMI	44
ITIP	45
IKT	1
BIT	2
BTINS	3
FTMI	4
ITIP	5
\.


--
-- TOC entry 2888 (class 0 OID 16527)
-- Dependencies: 208
-- Data for Name: school; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.school (school_num, location) FROM stdin;
121	Kyiv
32	Saint Petersburg
456	Tumen
3	Ufa
33	Almati
\.


--
-- TOC entry 2894 (class 0 OID 16588)
-- Dependencies: 214
-- Data for Name: secretary; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.secretary (secretary_id, secretary_contacts, fio, work_experience) FROM stdin;
1	854648383748	Ршоаовла Р.Н.	4 года
2	823343574768	Нылталвод Е.В.	2 года
3	850284924892	Лщвоыовщы Н.Ш.	6 лет
4	802847924927	Ашшовыдыб Р.Н.	4 года
5	871873538587	Фоавоущоа Л.Г.	1 год
\.


--
-- TOC entry 2890 (class 0 OID 16543)
-- Dependencies: 210
-- Data for Name: speciality; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.speciality (speciality_id, faculty_id_fk, spciality_name, max_stud_amount, min_grade) FROM stdin;
1	5	GDFG	213	94
2	4	DGDH	222	87
3	3	SRTTS	184	98
4	2	TRYRY	300	76
5	1	YTUGFD	255	86
\.


--
-- TOC entry 2904 (class 0 OID 0)
-- Dependencies: 207
-- Name: abiturient_abiturient_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.abiturient_abiturient_id_seq', 1, false);


--
-- TOC entry 2905 (class 0 OID 0)
-- Dependencies: 206
-- Name: faculty_faculty_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.faculty_faculty_id_seq', 45, true);


--
-- TOC entry 2906 (class 0 OID 0)
-- Dependencies: 213
-- Name: secretary_secretary_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.secretary_secretary_id_seq', 10, true);


--
-- TOC entry 2907 (class 0 OID 0)
-- Dependencies: 209
-- Name: speciality_speciality_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.speciality_speciality_id_seq', 5, true);


--
-- TOC entry 2732 (class 2606 OID 16507)
-- Name: abiturient abiturient_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abiturient
    ADD CONSTRAINT abiturient_id PRIMARY KEY (abiturient_id);


--
-- TOC entry 2737 (class 2606 OID 16495)
-- Name: faculty faculty_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.faculty
    ADD CONSTRAINT faculty_id PRIMARY KEY (faculty_id);


--
-- TOC entry 2740 (class 2606 OID 16534)
-- Name: school school_num; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.school
    ADD CONSTRAINT school_num PRIMARY KEY (school_num);


--
-- TOC entry 2748 (class 2606 OID 16596)
-- Name: secretary secretary_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretary
    ADD CONSTRAINT secretary_id PRIMARY KEY (secretary_id);


--
-- TOC entry 2743 (class 2606 OID 16551)
-- Name: speciality speciality_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.speciality
    ADD CONSTRAINT speciality_id PRIMARY KEY (speciality_id);


--
-- TOC entry 2738 (class 1259 OID 16484)
-- Name: fki_abiturient_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_abiturient_id ON public."EGE_sertificat" USING btree (abiturient_id_fk);


--
-- TOC entry 2744 (class 1259 OID 16572)
-- Name: fki_abiturient_id(FK); Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_abiturient_id(FK)" ON public."9_grade_certificat" USING btree (abiturient_id_fk);


--
-- TOC entry 2745 (class 1259 OID 16639)
-- Name: fki_abiturient_id_FK; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_abiturient_id_FK" ON public."Application" USING btree (abiturient_id_fk);


--
-- TOC entry 2733 (class 1259 OID 16473)
-- Name: fki_faculty_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_faculty_id ON public.abiturient USING btree (faculty_id_fk);


--
-- TOC entry 2741 (class 1259 OID 16557)
-- Name: fki_faculty_id(FK); Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_faculty_id(FK)" ON public.speciality USING btree (faculty_id_fk);


--
-- TOC entry 2734 (class 1259 OID 16540)
-- Name: fki_school_num(FK); Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_school_num(FK)" ON public.abiturient USING btree (school_num_fk);


--
-- TOC entry 2746 (class 1259 OID 16603)
-- Name: fki_secretary_id(FK); Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_secretary_id(FK)" ON public."Application" USING btree (secretary_id_fk);


--
-- TOC entry 2735 (class 1259 OID 16563)
-- Name: fki_speciality_id(FK); Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_speciality_id(FK)" ON public.abiturient USING btree (speciality_id_fk);


--
-- TOC entry 2756 (class 2606 OID 16650)
-- Name: Application abiturient_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Application"
    ADD CONSTRAINT abiturient_id_fk FOREIGN KEY (abiturient_id_fk) REFERENCES public.abiturient(abiturient_id) NOT VALID;


--
-- TOC entry 2754 (class 2606 OID 16675)
-- Name: 9_grade_certificat abiturient_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."9_grade_certificat"
    ADD CONSTRAINT abiturient_id_fk FOREIGN KEY (abiturient_id_fk) REFERENCES public.abiturient(abiturient_id) NOT VALID;


--
-- TOC entry 2752 (class 2606 OID 16680)
-- Name: EGE_sertificat abiturient_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."EGE_sertificat"
    ADD CONSTRAINT abiturient_id_fk FOREIGN KEY (abiturient_id_fk) REFERENCES public.abiturient(abiturient_id) NOT VALID;


--
-- TOC entry 2753 (class 2606 OID 16655)
-- Name: speciality faculty_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.speciality
    ADD CONSTRAINT faculty_id_fk FOREIGN KEY (faculty_id_fk) REFERENCES public.faculty(faculty_id) NOT VALID;


--
-- TOC entry 2749 (class 2606 OID 16660)
-- Name: abiturient faculty_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abiturient
    ADD CONSTRAINT faculty_id_fk FOREIGN KEY (faculty_id_fk) REFERENCES public.faculty(faculty_id) NOT VALID;


--
-- TOC entry 2750 (class 2606 OID 16665)
-- Name: abiturient school_num_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abiturient
    ADD CONSTRAINT school_num_fk FOREIGN KEY (school_num_fk) REFERENCES public.school(school_num) NOT VALID;


--
-- TOC entry 2755 (class 2606 OID 16645)
-- Name: Application secretary_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Application"
    ADD CONSTRAINT secretary_id_fk FOREIGN KEY (secretary_id_fk) REFERENCES public.secretary(secretary_id) NOT VALID;


--
-- TOC entry 2751 (class 2606 OID 16670)
-- Name: abiturient speciality_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.abiturient
    ADD CONSTRAINT speciality_id_fk FOREIGN KEY (speciality_id_fk) REFERENCES public.speciality(speciality_id) NOT VALID;


-- Completed on 2020-04-20 22:25:12

--
-- PostgreSQL database dump complete
--

