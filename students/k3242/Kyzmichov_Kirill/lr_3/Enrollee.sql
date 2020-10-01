--
-- PostgreSQL database dump
--

-- Dumped from database version 11.7
-- Dumped by pg_dump version 11.7

-- Started on 2020-05-13 23:42:31

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
-- TOC entry 7 (class 2615 OID 16393)
-- Name: Students; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA "Students";


ALTER SCHEMA "Students" OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 16384)
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- TOC entry 2880 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 199 (class 1259 OID 16402)
-- Name: 11_grade; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."11_grade" (
    "ID_Enrollee" integer NOT NULL,
    "Points_1" integer NOT NULL,
    "Points_2" integer NOT NULL
);


ALTER TABLE "Students"."11_grade" OWNER TO postgres;

--
-- TOC entry 2881 (class 0 OID 0)
-- Dependencies: 199
-- Name: TABLE "11_grade"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."11_grade" IS 'Create table for 11th grade Enrollee';


--
-- TOC entry 200 (class 1259 OID 16407)
-- Name: 9_grade; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."9_grade" (
    "ID_Enrollee" integer NOT NULL,
    "Points_1" integer NOT NULL,
    "Ponts_2" integer NOT NULL,
    "Ponts_3" integer NOT NULL,
    "Ponts_4" integer NOT NULL,
    "Average_points" integer NOT NULL
);


ALTER TABLE "Students"."9_grade" OWNER TO postgres;

--
-- TOC entry 2882 (class 0 OID 0)
-- Dependencies: 200
-- Name: TABLE "9_grade"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."9_grade" IS 'Create table for 9th grade Enrollee';


--
-- TOC entry 198 (class 1259 OID 16394)
-- Name: Enrollee; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."Enrollee" (
    "ID_Enrollee" integer NOT NULL,
    "Passport" integer NOT NULL,
    "Name" text NOT NULL,
    "School" text NOT NULL,
    "Type" text NOT NULL,
    "Base" integer NOT NULL,
    "Rate" integer NOT NULL
);


ALTER TABLE "Students"."Enrollee" OWNER TO postgres;

--
-- TOC entry 2883 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE "Enrollee"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."Enrollee" IS 'Information about Enrollee';


--
-- TOC entry 202 (class 1259 OID 16428)
-- Name: Faculty; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."Faculty" (
    "ID_Faculty" integer NOT NULL,
    "Name" text NOT NULL
);


ALTER TABLE "Students"."Faculty" OWNER TO postgres;

--
-- TOC entry 2884 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE "Faculty"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."Faculty" IS 'Information about Faculty';


--
-- TOC entry 203 (class 1259 OID 16436)
-- Name: Form; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."Form" (
    "Type" text NOT NULL
);


ALTER TABLE "Students"."Form" OWNER TO postgres;

--
-- TOC entry 2885 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE "Form"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."Form" IS 'Information about Form';


--
-- TOC entry 205 (class 1259 OID 16470)
-- Name: Request; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."Request" (
    "ID_Enrollee" integer NOT NULL,
    "Form" text NOT NULL,
    "ID_Specialty" integer NOT NULL,
    "Rating" integer NOT NULL,
    "ID_Secretary" integer NOT NULL,
    "Date" date NOT NULL
);


ALTER TABLE "Students"."Request" OWNER TO postgres;

--
-- TOC entry 2886 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE "Request"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."Request" IS 'Full information about enrollee in the request';


--
-- TOC entry 201 (class 1259 OID 16412)
-- Name: Secretary; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."Secretary" (
    "ID_Secretary" integer NOT NULL,
    "Name" text NOT NULL
);


ALTER TABLE "Students"."Secretary" OWNER TO postgres;

--
-- TOC entry 2887 (class 0 OID 0)
-- Dependencies: 201
-- Name: TABLE "Secretary"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."Secretary" IS 'Information about secretary';


--
-- TOC entry 204 (class 1259 OID 16456)
-- Name: Specialty; Type: TABLE; Schema: Students; Owner: postgres
--

CREATE TABLE "Students"."Specialty" (
    "ID_Specilaty" integer NOT NULL,
    "ID_Faculty" integer NOT NULL,
    "Basis" text NOT NULL,
    "Name" text NOT NULL,
    "Number_of_places" integer NOT NULL
);


ALTER TABLE "Students"."Specialty" OWNER TO postgres;

--
-- TOC entry 2888 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE "Specialty"; Type: COMMENT; Schema: Students; Owner: postgres
--

COMMENT ON TABLE "Students"."Specialty" IS 'Information about Specialty';


--
-- TOC entry 2868 (class 0 OID 16402)
-- Dependencies: 199
-- Data for Name: 11_grade; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."11_grade" ("ID_Enrollee", "Points_1", "Points_2") FROM stdin;
1	80	62
2	86	60
3	88	76
6	90	78
7	90	80
\.


--
-- TOC entry 2869 (class 0 OID 16407)
-- Dependencies: 200
-- Data for Name: 9_grade; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."9_grade" ("ID_Enrollee", "Points_1", "Ponts_2", "Ponts_3", "Ponts_4", "Average_points") FROM stdin;
4	98	90	88	96	93
5	97	94	87	98	94
8	78	64	86	91	80
9	77	62	85	89	78
10	97	89	86	95	92
\.


--
-- TOC entry 2867 (class 0 OID 16394)
-- Dependencies: 198
-- Data for Name: Enrollee; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."Enrollee" ("ID_Enrollee", "Passport", "Name", "School", "Type", "Base", "Rate") FROM stdin;
1	468432	Kirill	667	Basic	11	29
2	434567	Polina	84	Basic	11	27
3	493400	Danil	586	Basic	11	13
4	589342	Lana	231	Invalid	9	3
5	468432	Allie	666	Tselovik	9	2
6	468445	Dony	523	Invalid	11	12
7	452525	Alex	234	Basic	11	10
8	495234	Anna	586	Basic	9	26
9	590424	Rick	7	Basic	9	28
10	515530	Richard	674	Basic	9	5
\.


--
-- TOC entry 2871 (class 0 OID 16428)
-- Dependencies: 202
-- Data for Name: Faculty; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."Faculty" ("ID_Faculty", "Name") FROM stdin;
1	Economics
2	Computer_Science
3	Linguistics
4	History
5	Arts
\.


--
-- TOC entry 2872 (class 0 OID 16436)
-- Dependencies: 203
-- Data for Name: Form; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."Form" ("Type") FROM stdin;
Extramural
Full-time
Part-time
\.


--
-- TOC entry 2874 (class 0 OID 16470)
-- Dependencies: 205
-- Data for Name: Request; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."Request" ("ID_Enrollee", "Form", "ID_Specialty", "Rating", "ID_Secretary", "Date") FROM stdin;
1	Extramural	5	142	2	2018-07-08
2	Full-time	4	146	4	2018-07-10
3	Part-time	2	164	3	2018-07-12
4	Extramural	1	465	1	2018-07-13
5	Full-time	6	470	5	2018-07-15
6	Part-time	3	168	5	2018-07-15
7	Extramural	7	170	1	2018-07-16
8	Full-time	8	399	2	2018-07-17
9	Part-time	1	391	3	2018-07-18
10	Extramural	4	459	4	2018-07-20
\.


--
-- TOC entry 2870 (class 0 OID 16412)
-- Dependencies: 201
-- Data for Name: Secretary; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."Secretary" ("ID_Secretary", "Name") FROM stdin;
1	Galina
2	Natalia
3	Tatiana
4	Luba
5	Irina
\.


--
-- TOC entry 2873 (class 0 OID 16456)
-- Dependencies: 204
-- Data for Name: Specialty; Type: TABLE DATA; Schema: Students; Owner: postgres
--

COPY "Students"."Specialty" ("ID_Specilaty", "ID_Faculty", "Basis", "Name", "Number_of_places") FROM stdin;
1	1	Contract	Finance	15
2	1	Budget	Finance	15
3	1	Contract	Banking	10
4	1	Budget	Banking	5
5	2	Contract	AI	15
6	2	Budget	AI	15
7	3	Contract	Translator	20
8	3	Budget	Translator	10
\.


--
-- TOC entry 2722 (class 2606 OID 16482)
-- Name: 11_grade 11_grade_pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."11_grade"
    ADD CONSTRAINT "11_grade_pkey" PRIMARY KEY ("ID_Enrollee");


--
-- TOC entry 2725 (class 2606 OID 16480)
-- Name: 9_grade 9_grade_pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."9_grade"
    ADD CONSTRAINT "9_grade_pkey" PRIMARY KEY ("ID_Enrollee");


--
-- TOC entry 2720 (class 2606 OID 16401)
-- Name: Enrollee Enrollee_pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Enrollee"
    ADD CONSTRAINT "Enrollee_pkey" PRIMARY KEY ("ID_Enrollee");


--
-- TOC entry 2730 (class 2606 OID 16435)
-- Name: Faculty Faculty_pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Faculty"
    ADD CONSTRAINT "Faculty_pkey" PRIMARY KEY ("ID_Faculty");


--
-- TOC entry 2732 (class 2606 OID 16443)
-- Name: Form Form_pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Form"
    ADD CONSTRAINT "Form_pkey" PRIMARY KEY ("Type");


--
-- TOC entry 2737 (class 2606 OID 16484)
-- Name: Request Request_pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Request"
    ADD CONSTRAINT "Request_pkey" PRIMARY KEY ("ID_Enrollee");


--
-- TOC entry 2728 (class 2606 OID 16419)
-- Name: Secretary Secretary _pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Secretary"
    ADD CONSTRAINT "Secretary _pkey" PRIMARY KEY ("ID_Secretary");


--
-- TOC entry 2734 (class 2606 OID 16463)
-- Name: Specialty Specialty_pkey; Type: CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Specialty"
    ADD CONSTRAINT "Specialty_pkey" PRIMARY KEY ("ID_Specilaty");


--
-- TOC entry 2723 (class 1259 OID 16455)
-- Name: fki_9_; Type: INDEX; Schema: Students; Owner: postgres
--

CREATE INDEX fki_9_ ON "Students"."11_grade" USING btree ("ID_Enrollee");


--
-- TOC entry 2726 (class 1259 OID 16449)
-- Name: fki_9_grade_enrollee; Type: INDEX; Schema: Students; Owner: postgres
--

CREATE INDEX fki_9_grade_enrollee ON "Students"."9_grade" USING btree ("ID_Enrollee");


--
-- TOC entry 2738 (class 1259 OID 16478)
-- Name: fki_Request_Enrollee; Type: INDEX; Schema: Students; Owner: postgres
--

CREATE INDEX "fki_Request_Enrollee" ON "Students"."Request" USING btree ("ID_Enrollee");


--
-- TOC entry 2735 (class 1259 OID 16469)
-- Name: fki_Specialty_Faculty; Type: INDEX; Schema: Students; Owner: postgres
--

CREATE INDEX "fki_Specialty_Faculty" ON "Students"."Specialty" USING btree ("ID_Faculty");


--
-- TOC entry 2739 (class 2606 OID 16450)
-- Name: 11_grade 11_grade_enrollee; Type: FK CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."11_grade"
    ADD CONSTRAINT "11_grade_enrollee" FOREIGN KEY ("ID_Enrollee") REFERENCES "Students"."Enrollee"("ID_Enrollee") NOT VALID;


--
-- TOC entry 2740 (class 2606 OID 16444)
-- Name: 9_grade 9_grade_enrollee; Type: FK CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."9_grade"
    ADD CONSTRAINT "9_grade_enrollee" FOREIGN KEY ("ID_Enrollee") REFERENCES "Students"."Enrollee"("ID_Enrollee") NOT VALID;


--
-- TOC entry 2744 (class 2606 OID 16473)
-- Name: Request Request_Enrollee; Type: FK CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Request"
    ADD CONSTRAINT "Request_Enrollee" FOREIGN KEY ("ID_Enrollee") REFERENCES "Students"."Enrollee"("ID_Enrollee");


--
-- TOC entry 2743 (class 2606 OID 16488)
-- Name: Request Request_Form; Type: FK CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Request"
    ADD CONSTRAINT "Request_Form" FOREIGN KEY ("Form") REFERENCES "Students"."Form"("Type");


--
-- TOC entry 2745 (class 2606 OID 16498)
-- Name: Request Request_Secretary; Type: FK CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Request"
    ADD CONSTRAINT "Request_Secretary" FOREIGN KEY ("ID_Secretary") REFERENCES "Students"."Secretary"("ID_Secretary");


--
-- TOC entry 2742 (class 2606 OID 16493)
-- Name: Request Request_Speciality; Type: FK CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Request"
    ADD CONSTRAINT "Request_Speciality" FOREIGN KEY ("ID_Specialty") REFERENCES "Students"."Specialty"("ID_Specilaty");


--
-- TOC entry 2741 (class 2606 OID 16464)
-- Name: Specialty Specialty_Faculty; Type: FK CONSTRAINT; Schema: Students; Owner: postgres
--

ALTER TABLE ONLY "Students"."Specialty"
    ADD CONSTRAINT "Specialty_Faculty" FOREIGN KEY ("ID_Faculty") REFERENCES "Students"."Faculty"("ID_Faculty") NOT VALID;


-- Completed on 2020-05-13 23:42:31

--
-- PostgreSQL database dump complete
--

