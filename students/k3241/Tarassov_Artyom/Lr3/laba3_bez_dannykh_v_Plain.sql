--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-04-19 15:56:19

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

SET default_table_access_method = heap;

--
-- TOC entry 203 (class 1259 OID 17252)
-- Name: Book_instances; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."Book_instances" (
    id integer NOT NULL,
    status text NOT NULL,
    id_book integer NOT NULL
);


--
-- TOC entry 202 (class 1259 OID 17250)
-- Name: Book_instances_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public."Book_instances_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2891 (class 0 OID 0)
-- Dependencies: 202
-- Name: Book_instances_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public."Book_instances_id_seq" OWNED BY public."Book_instances".id;


--
-- TOC entry 205 (class 1259 OID 17261)
-- Name: Books; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."Books" (
    id integer NOT NULL,
    author text NOT NULL,
    name text NOT NULL,
    year_of_pub date NOT NULL,
    section text NOT NULL,
    pressmark text NOT NULL,
    debit_date text
);


--
-- TOC entry 204 (class 1259 OID 17259)
-- Name: Books_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public."Books_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2892 (class 0 OID 0)
-- Dependencies: 204
-- Name: Books_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public."Books_id_seq" OWNED BY public."Books".id;


--
-- TOC entry 206 (class 1259 OID 17268)
-- Name: Instance_issues; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."Instance_issues" (
    date_of_issue date NOT NULL,
    return_date date,
    id_reader integer NOT NULL,
    id_instance integer NOT NULL
);


--
-- TOC entry 207 (class 1259 OID 17271)
-- Name: Instances_in_room; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."Instances_in_room" (
    id_rooms integer NOT NULL,
    id_instance integer NOT NULL,
    value integer NOT NULL
);


--
-- TOC entry 209 (class 1259 OID 17276)
-- Name: Readers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."Readers" (
    id integer NOT NULL,
    number_of_card integer NOT NULL,
    full_name text NOT NULL,
    passport_number integer NOT NULL,
    data_of_birthday date NOT NULL,
    address text NOT NULL,
    call_number integer NOT NULL,
    graduation text NOT NULL,
    graduate_degree boolean NOT NULL
);


--
-- TOC entry 208 (class 1259 OID 17274)
-- Name: Readers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public."Readers_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2893 (class 0 OID 0)
-- Dependencies: 208
-- Name: Readers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public."Readers_id_seq" OWNED BY public."Readers".id;


--
-- TOC entry 211 (class 1259 OID 17285)
-- Name: Reading_rooms; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."Reading_rooms" (
    id integer NOT NULL,
    number integer NOT NULL,
    name text NOT NULL,
    people_capacity integer NOT NULL
);


--
-- TOC entry 210 (class 1259 OID 17283)
-- Name: Reading_rooms_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public."Reading_rooms_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2894 (class 0 OID 0)
-- Dependencies: 210
-- Name: Reading_rooms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public."Reading_rooms_id_seq" OWNED BY public."Reading_rooms".id;


--
-- TOC entry 212 (class 1259 OID 17292)
-- Name: Registers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."Registers" (
    id_room integer NOT NULL,
    id_reader integer NOT NULL,
    date_recorded date NOT NULL,
    date_of_re_registration date,
    discharge_date date
);


--
-- TOC entry 2721 (class 2604 OID 17255)
-- Name: Book_instances id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Book_instances" ALTER COLUMN id SET DEFAULT nextval('public."Book_instances_id_seq"'::regclass);


--
-- TOC entry 2722 (class 2604 OID 17264)
-- Name: Books id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Books" ALTER COLUMN id SET DEFAULT nextval('public."Books_id_seq"'::regclass);


--
-- TOC entry 2723 (class 2604 OID 17279)
-- Name: Readers id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Readers" ALTER COLUMN id SET DEFAULT nextval('public."Readers_id_seq"'::regclass);


--
-- TOC entry 2724 (class 2604 OID 17288)
-- Name: Reading_rooms id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Reading_rooms" ALTER COLUMN id SET DEFAULT nextval('public."Reading_rooms_id_seq"'::regclass);


--
-- TOC entry 2876 (class 0 OID 17252)
-- Dependencies: 203
-- Data for Name: Book_instances; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."Book_instances" (id, status, id_book) FROM stdin;
\.


--
-- TOC entry 2878 (class 0 OID 17261)
-- Dependencies: 205
-- Data for Name: Books; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."Books" (id, author, name, year_of_pub, section, pressmark, debit_date) FROM stdin;
\.


--
-- TOC entry 2879 (class 0 OID 17268)
-- Dependencies: 206
-- Data for Name: Instance_issues; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."Instance_issues" (date_of_issue, return_date, id_reader, id_instance) FROM stdin;
\.


--
-- TOC entry 2880 (class 0 OID 17271)
-- Dependencies: 207
-- Data for Name: Instances_in_room; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."Instances_in_room" (id_rooms, id_instance, value) FROM stdin;
\.


--
-- TOC entry 2882 (class 0 OID 17276)
-- Dependencies: 209
-- Data for Name: Readers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."Readers" (id, number_of_card, full_name, passport_number, data_of_birthday, address, call_number, graduation, graduate_degree) FROM stdin;
\.


--
-- TOC entry 2884 (class 0 OID 17285)
-- Dependencies: 211
-- Data for Name: Reading_rooms; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."Reading_rooms" (id, number, name, people_capacity) FROM stdin;
\.


--
-- TOC entry 2885 (class 0 OID 17292)
-- Dependencies: 212
-- Data for Name: Registers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."Registers" (id_room, id_reader, date_recorded, date_of_re_registration, discharge_date) FROM stdin;
\.


--
-- TOC entry 2895 (class 0 OID 0)
-- Dependencies: 202
-- Name: Book_instances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public."Book_instances_id_seq"', 1, false);


--
-- TOC entry 2896 (class 0 OID 0)
-- Dependencies: 204
-- Name: Books_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public."Books_id_seq"', 1, true);


--
-- TOC entry 2897 (class 0 OID 0)
-- Dependencies: 208
-- Name: Readers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public."Readers_id_seq"', 1, false);


--
-- TOC entry 2898 (class 0 OID 0)
-- Dependencies: 210
-- Name: Reading_rooms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public."Reading_rooms_id_seq"', 1, false);


--
-- TOC entry 2726 (class 2606 OID 17296)
-- Name: Book_instances Book_instances_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Book_instances"
    ADD CONSTRAINT "Book_instances_pkey" PRIMARY KEY (id);


--
-- TOC entry 2729 (class 2606 OID 17298)
-- Name: Books Books_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Books"
    ADD CONSTRAINT "Books_pkey" PRIMARY KEY (id);


--
-- TOC entry 2735 (class 2606 OID 17300)
-- Name: Readers Readers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Readers"
    ADD CONSTRAINT "Readers_pkey" PRIMARY KEY (id);


--
-- TOC entry 2737 (class 2606 OID 17302)
-- Name: Reading_rooms Reading_rooms_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Reading_rooms"
    ADD CONSTRAINT "Reading_rooms_pkey" PRIMARY KEY (id);


--
-- TOC entry 2727 (class 1259 OID 17303)
-- Name: id_books(FK); Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "id_books(FK)" ON public."Book_instances" USING btree (id_book);


--
-- TOC entry 2730 (class 1259 OID 17304)
-- Name: id_instance(fk); Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "id_instance(fk)" ON public."Instance_issues" USING btree (id_instance);


--
-- TOC entry 2732 (class 1259 OID 17305)
-- Name: id_instance_in_rooms(fk); Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "id_instance_in_rooms(fk)" ON public."Instances_in_room" USING btree (id_instance);


--
-- TOC entry 2731 (class 1259 OID 17306)
-- Name: id_reader(fk); Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "id_reader(fk)" ON public."Instance_issues" USING btree (id_reader);


--
-- TOC entry 2738 (class 1259 OID 17307)
-- Name: id_reader_in_register(fk); Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "id_reader_in_register(fk)" ON public."Registers" USING btree (id_reader);


--
-- TOC entry 2739 (class 1259 OID 17308)
-- Name: id_room(fk); Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "id_room(fk)" ON public."Registers" USING btree (id_room);


--
-- TOC entry 2733 (class 1259 OID 17309)
-- Name: id_rooms(fk); Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "id_rooms(fk)" ON public."Instances_in_room" USING btree (id_rooms);


--
-- TOC entry 2740 (class 2606 OID 17310)
-- Name: Book_instances Book_instances_id_book_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Book_instances"
    ADD CONSTRAINT "Book_instances_id_book_fkey" FOREIGN KEY (id_book) REFERENCES public."Books"(id) NOT VALID;


--
-- TOC entry 2741 (class 2606 OID 17315)
-- Name: Instance_issues Instance_issues_id_instance_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Instance_issues"
    ADD CONSTRAINT "Instance_issues_id_instance_fkey" FOREIGN KEY (id_instance) REFERENCES public."Book_instances"(id) NOT VALID;


--
-- TOC entry 2742 (class 2606 OID 17320)
-- Name: Instance_issues Instance_issues_id_reader_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Instance_issues"
    ADD CONSTRAINT "Instance_issues_id_reader_fkey" FOREIGN KEY (id_reader) REFERENCES public."Readers"(id) NOT VALID;


--
-- TOC entry 2743 (class 2606 OID 17325)
-- Name: Instances_in_room Instances_in_room_id_instance_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Instances_in_room"
    ADD CONSTRAINT "Instances_in_room_id_instance_fkey" FOREIGN KEY (id_instance) REFERENCES public."Book_instances"(id) NOT VALID;


--
-- TOC entry 2744 (class 2606 OID 17330)
-- Name: Instances_in_room Instances_in_room_id_instance_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Instances_in_room"
    ADD CONSTRAINT "Instances_in_room_id_instance_fkey1" FOREIGN KEY (id_instance) REFERENCES public."Book_instances"(id) NOT VALID;


--
-- TOC entry 2745 (class 2606 OID 17335)
-- Name: Instances_in_room Instances_in_room_id_rooms_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Instances_in_room"
    ADD CONSTRAINT "Instances_in_room_id_rooms_fkey" FOREIGN KEY (id_rooms) REFERENCES public."Reading_rooms"(id) NOT VALID;


--
-- TOC entry 2746 (class 2606 OID 17340)
-- Name: Registers Registers_id_reader_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Registers"
    ADD CONSTRAINT "Registers_id_reader_fkey" FOREIGN KEY (id_reader) REFERENCES public."Readers"(id) NOT VALID;


--
-- TOC entry 2747 (class 2606 OID 17345)
-- Name: Registers Registers_id_reader_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Registers"
    ADD CONSTRAINT "Registers_id_reader_fkey1" FOREIGN KEY (id_reader) REFERENCES public."Readers"(id) NOT VALID;


--
-- TOC entry 2748 (class 2606 OID 17350)
-- Name: Registers Registers_id_room_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."Registers"
    ADD CONSTRAINT "Registers_id_room_fkey" FOREIGN KEY (id_room) REFERENCES public."Reading_rooms"(id) NOT VALID;


-- Completed on 2020-04-19 15:56:19

--
-- PostgreSQL database dump complete
--

