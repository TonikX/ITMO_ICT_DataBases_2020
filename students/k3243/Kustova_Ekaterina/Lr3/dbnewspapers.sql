--
-- PostgreSQL database dump
--

-- Dumped from database version 10.12
-- Dumped by pg_dump version 10.12

-- Started on 2020-05-04 16:20:48

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
-- TOC entry 5 (class 2615 OID 16394)
-- Name: newspapers; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA newspapers;


ALTER SCHEMA newspapers OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2853 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 201 (class 1259 OID 16532)
-- Name: distribution_report; Type: TABLE; Schema: newspapers; Owner: postgres
--

CREATE TABLE newspapers.distribution_report (
    "report№" integer NOT NULL,
    party_number integer NOT NULL,
    "office№" integer NOT NULL,
    print_amount integer
);


ALTER TABLE newspapers.distribution_report OWNER TO postgres;

--
-- TOC entry 2854 (class 0 OID 0)
-- Dependencies: 201
-- Name: TABLE distribution_report; Type: COMMENT; Schema: newspapers; Owner: postgres
--

COMMENT ON TABLE newspapers.distribution_report IS 'таблица "distribution_report" - "отчёт о распределении"
';


--
-- TOC entry 202 (class 1259 OID 16552)
-- Name: newspaper; Type: TABLE; Schema: newspapers; Owner: postgres
--

CREATE TABLE newspapers.newspaper (
    newspapers_name text NOT NULL,
    editors_surname text NOT NULL,
    editors_name text NOT NULL,
    index integer NOT NULL,
    price integer NOT NULL
);


ALTER TABLE newspapers.newspaper OWNER TO postgres;

--
-- TOC entry 2855 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE newspaper; Type: COMMENT; Schema: newspapers; Owner: postgres
--

COMMENT ON TABLE newspapers.newspaper IS 'таблица "newspaper" - "газета"
';


--
-- TOC entry 198 (class 1259 OID 16411)
-- Name: newspapers_party; Type: TABLE; Schema: newspapers; Owner: postgres
--

CREATE TABLE newspapers.newspapers_party (
    party_number integer NOT NULL,
    amount_of_copies integer NOT NULL,
    newspapers_name text NOT NULL
);


ALTER TABLE newspapers.newspapers_party OWNER TO postgres;

--
-- TOC entry 2856 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE newspapers_party; Type: COMMENT; Schema: newspapers; Owner: postgres
--

COMMENT ON TABLE newspapers.newspapers_party IS 'таблица "newspapers_party" - "партия газет"';


--
-- TOC entry 200 (class 1259 OID 16524)
-- Name: post_office; Type: TABLE; Schema: newspapers; Owner: postgres
--

CREATE TABLE newspapers.post_office (
    "office№" integer NOT NULL,
    office_address text NOT NULL
);


ALTER TABLE newspapers.post_office OWNER TO postgres;

--
-- TOC entry 2857 (class 0 OID 0)
-- Dependencies: 200
-- Name: TABLE post_office; Type: COMMENT; Schema: newspapers; Owner: postgres
--

COMMENT ON TABLE newspapers.post_office IS 'таблица "post_office" - "отделения почты"';


--
-- TOC entry 199 (class 1259 OID 16419)
-- Name: print; Type: TABLE; Schema: newspapers; Owner: postgres
--

CREATE TABLE newspapers.print (
    print_id integer NOT NULL,
    printery_name text NOT NULL,
    party_number integer NOT NULL,
    print_amount integer
);


ALTER TABLE newspapers.print OWNER TO postgres;

--
-- TOC entry 2858 (class 0 OID 0)
-- Dependencies: 199
-- Name: TABLE print; Type: COMMENT; Schema: newspapers; Owner: postgres
--

COMMENT ON TABLE newspapers.print IS 'таблица "print" - "печать"';


--
-- TOC entry 197 (class 1259 OID 16403)
-- Name: printery; Type: TABLE; Schema: newspapers; Owner: postgres
--

CREATE TABLE newspapers.printery (
    printery_name text NOT NULL,
    printery_address text NOT NULL,
    opening_time reltime NOT NULL,
    closing_time reltime NOT NULL
);


ALTER TABLE newspapers.printery OWNER TO postgres;

--
-- TOC entry 2859 (class 0 OID 0)
-- Dependencies: 197
-- Name: TABLE printery; Type: COMMENT; Schema: newspapers; Owner: postgres
--

COMMENT ON TABLE newspapers.printery IS 'таблица "printery" - "типография"';


--
-- TOC entry 203 (class 1259 OID 16573)
-- Name: post_office; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.post_office (
    "office№" integer NOT NULL,
    office_address text
);


ALTER TABLE public.post_office OWNER TO postgres;

--
-- TOC entry 2843 (class 0 OID 16532)
-- Dependencies: 201
-- Data for Name: distribution_report; Type: TABLE DATA; Schema: newspapers; Owner: postgres
--

COPY newspapers.distribution_report ("report№", party_number, "office№", print_amount) FROM stdin;
1	1	1	200
2	1	2	800
3	2	1	500
4	2	2	500
5	2	3	200
6	2	4	500
7	2	5	1000
8	3	1	500
9	3	2	200
10	4	3	1000
11	4	4	1000
12	5	5	1000
13	5	4	1000
\.


--
-- TOC entry 2844 (class 0 OID 16552)
-- Dependencies: 202
-- Data for Name: newspaper; Type: TABLE DATA; Schema: newspapers; Owner: postgres
--

COPY newspapers.newspaper (newspapers_name, editors_surname, editors_name, index, price) FROM stdin;
News	Eddison	Mark	1	4
Herald	Huddson	Finn	2	3
Whistler	Hummel	Kurt	3	4
MusicNews	Roberts	Agata	4	5
ScienceNews	Mangold	Maya	5	5
\.


--
-- TOC entry 2840 (class 0 OID 16411)
-- Dependencies: 198
-- Data for Name: newspapers_party; Type: TABLE DATA; Schema: newspapers; Owner: postgres
--

COPY newspapers.newspapers_party (party_number, amount_of_copies, newspapers_name) FROM stdin;
1	1000	News
2	3000	Herald
3	1000	Whistler
4	2000	MusicNews
5	2000	ScienceNews
\.


--
-- TOC entry 2842 (class 0 OID 16524)
-- Dependencies: 200
-- Data for Name: post_office; Type: TABLE DATA; Schema: newspapers; Owner: postgres
--

COPY newspapers.post_office ("office№", office_address) FROM stdin;
1	HallamStreet1
2	RoseberyAvenue2
3	DevonshireStreet3
4	AbbeyRoad4
5	BakerStreet5
\.


--
-- TOC entry 2841 (class 0 OID 16419)
-- Dependencies: 199
-- Data for Name: print; Type: TABLE DATA; Schema: newspapers; Owner: postgres
--

COPY newspapers.print (print_id, printery_name, party_number, print_amount) FROM stdin;
1	Jamesons	1	500
2	Print	1	500
3	Story	2	1000
4	Print	2	1000
5	Shimmermann	2	1000
6	Hicksons	3	500
7	Print	3	500
8	Story	4	2000
9	Jamesons	5	2000
\.


--
-- TOC entry 2839 (class 0 OID 16403)
-- Dependencies: 197
-- Data for Name: printery; Type: TABLE DATA; Schema: newspapers; Owner: postgres
--

COPY newspapers.printery (printery_name, printery_address, opening_time, closing_time) FROM stdin;
Jamesons	OxfordStreet1	08:00:00	16:00:00
Print	FallsStreet2	09:00:00	19:00:00
Story	CalmStreet3	09:00:00	17:00:00
Shimmermann	TobbeyStreet4	08:00:00	19:00:00
Hicksons	NottingtonStreet5	09:00:00	18:00:00
\.


--
-- TOC entry 2845 (class 0 OID 16573)
-- Dependencies: 203
-- Data for Name: post_office; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.post_office ("office№", office_address) FROM stdin;
1	HallamStreet1
2	RoseberyAvenue2
3	DevonshireStreet3
4	AbbeyRoad4
5	BakerStreet5
\.


--
-- TOC entry 2710 (class 2606 OID 16559)
-- Name: newspaper newspapers_pkey; Type: CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.newspaper
    ADD CONSTRAINT newspapers_pkey PRIMARY KEY (newspapers_name);


--
-- TOC entry 2706 (class 2606 OID 16531)
-- Name: post_office office_pkey; Type: CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.post_office
    ADD CONSTRAINT office_pkey PRIMARY KEY ("office№");


--
-- TOC entry 2702 (class 2606 OID 16495)
-- Name: newspapers_party party_number; Type: CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.newspapers_party
    ADD CONSTRAINT party_number PRIMARY KEY (party_number);


--
-- TOC entry 2704 (class 2606 OID 16521)
-- Name: print print_pkey; Type: CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.print
    ADD CONSTRAINT print_pkey PRIMARY KEY (print_id);


--
-- TOC entry 2700 (class 2606 OID 16410)
-- Name: printery printery_pkey; Type: CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.printery
    ADD CONSTRAINT printery_pkey PRIMARY KEY (printery_name);


--
-- TOC entry 2708 (class 2606 OID 16536)
-- Name: distribution_report report_pkey; Type: CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.distribution_report
    ADD CONSTRAINT report_pkey PRIMARY KEY ("report№");


--
-- TOC entry 2712 (class 2606 OID 16580)
-- Name: post_office post_office_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_office
    ADD CONSTRAINT post_office_pkey PRIMARY KEY ("office№");


--
-- TOC entry 2713 (class 2606 OID 16560)
-- Name: newspapers_party newspapers_name; Type: FK CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.newspapers_party
    ADD CONSTRAINT newspapers_name FOREIGN KEY (newspapers_name) REFERENCES newspapers.newspaper(newspapers_name) NOT VALID;


--
-- TOC entry 2717 (class 2606 OID 16542)
-- Name: distribution_report office№; Type: FK CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.distribution_report
    ADD CONSTRAINT "office№" FOREIGN KEY ("office№") REFERENCES newspapers.post_office("office№") NOT VALID;


--
-- TOC entry 2716 (class 2606 OID 16537)
-- Name: distribution_report party_number; Type: FK CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.distribution_report
    ADD CONSTRAINT party_number FOREIGN KEY (party_number) REFERENCES newspapers.newspapers_party(party_number) NOT VALID;


--
-- TOC entry 2715 (class 2606 OID 16547)
-- Name: print party_number; Type: FK CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.print
    ADD CONSTRAINT party_number FOREIGN KEY (party_number) REFERENCES newspapers.newspapers_party(party_number) NOT VALID;


--
-- TOC entry 2714 (class 2606 OID 16425)
-- Name: print printery_name; Type: FK CONSTRAINT; Schema: newspapers; Owner: postgres
--

ALTER TABLE ONLY newspapers.print
    ADD CONSTRAINT printery_name FOREIGN KEY (printery_name) REFERENCES newspapers.printery(printery_name);


-- Completed on 2020-05-04 16:20:48

--
-- PostgreSQL database dump complete
--

