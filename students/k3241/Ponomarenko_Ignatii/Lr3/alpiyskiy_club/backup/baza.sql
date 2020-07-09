--
-- PostgreSQL database dump
--

-- Dumped from database version 10.13
-- Dumped by pg_dump version 10.13

-- Started on 2020-07-02 18:04:28

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
-- Name: alpinisty; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA alpinisty;


ALTER SCHEMA alpinisty OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2904 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 212 (class 1259 OID 16490)
-- Name: alp_gruppa; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий основную информацию по восхождениям 
CREATE TABLE alpinisty.alp_gruppa (
    id_gruppy integer NOT NULL,
    commentariy character(200),
    rezult character(50) NOT NULL,
    data_otpravlenia timestamp with time zone,
    data_vozvrachenia timestamp with time zone,
    marshrut integer,
    nach_voshog_plan timestamp with time zone,
    zaver_voshog_plan timestamp with time zone,
    nach_voshog_fact time with time zone,
    zaver_voshog_fact time with time zone
);


ALTER TABLE alpinisty.alp_gruppa OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16488)
-- Name: alp_gruppa_id_gruppy_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.alp_gruppa_id_gruppy_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.alp_gruppa_id_gruppy_seq OWNER TO postgres;

--
-- TOC entry 2905 (class 0 OID 0)
-- Dependencies: 211
-- Name: alp_gruppa_id_gruppy_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.alp_gruppa_id_gruppy_seq OWNED BY alpinisty.alp_gruppa.id_gruppy;


--
-- TOC entry 206 (class 1259 OID 16445)
-- Name: alpinisty; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий информацию о альпинистах
CREATE TABLE alpinisty.alpinisty (
    id_alpinista integer NOT NULL,
    ima_alpinista character(100) NOT NULL,
    otchestvo_alpinista character(100) NOT NULL,
    familia_alpinista character(100) NOT NULL,
    vozrast integer,
    adres character(100) NOT NULL,
    tel character(100) NOT NULL,
    email character(100),
    id_cluba integer
);


ALTER TABLE alpinisty.alpinisty OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16443)
-- Name: alpinisty_id_alpinista_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.alpinisty_id_alpinista_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.alpinisty_id_alpinista_seq OWNER TO postgres;

--
-- TOC entry 2906 (class 0 OID 0)
-- Dependencies: 205
-- Name: alpinisty_id_alpinista_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.alpinisty_id_alpinista_seq OWNED BY alpinisty.alpinisty.id_alpinista;


--
-- TOC entry 204 (class 1259 OID 16429)
-- Name: cluby; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий информацию о альпинийских клубах
CREATE TABLE alpinisty.cluby (
    id_clubs integer NOT NULL,
    name_clubs character(100) NOT NULL,
    adres character(100) NOT NULL,
    tel character(100),
    email character(100),
    id_strany integer,
    kontakt_lico character(200)
);


ALTER TABLE alpinisty.cluby OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16427)
-- Name: cluby_id_clubs_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.cluby_id_clubs_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.cluby_id_clubs_seq OWNER TO postgres;

--
-- TOC entry 2907 (class 0 OID 0)
-- Dependencies: 203
-- Name: cluby_id_clubs_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.cluby_id_clubs_seq OWNED BY alpinisty.cluby.id_clubs;


--
-- TOC entry 208 (class 1259 OID 16461)
-- Name: gory; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий информацию о горах
CREATE TABLE alpinisty.gory (
    id_gory integer NOT NULL,
    vysota integer NOT NULL,
    name_gory character(100) NOT NULL,
    rayon integer
);


ALTER TABLE alpinisty.gory OWNER TO postgres;

--
-- TOC entry 2908 (class 0 OID 0)
-- Dependencies: 208
-- Name: TABLE gory; Type: COMMENT; Schema: alpinisty; Owner: postgres
--

COMMENT ON TABLE alpinisty.gory IS 'справочник горы';


--
-- TOC entry 207 (class 1259 OID 16459)
-- Name: gory_id_gory_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.gory_id_gory_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.gory_id_gory_seq OWNER TO postgres;

--
-- TOC entry 2909 (class 0 OID 0)
-- Dependencies: 207
-- Name: gory_id_gory_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.gory_id_gory_seq OWNED BY alpinisty.gory.id_gory;


--
-- TOC entry 210 (class 1259 OID 16474)
-- Name: marshruty; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий информацию о маршрутах
CREATE TABLE alpinisty.marshruty (
    id_marshrut integer NOT NULL,
    opisanie text,
    prodolgitelnost numeric,
    gory integer
);


ALTER TABLE alpinisty.marshruty OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 16472)
-- Name: marshruty_id_marshrut_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.marshruty_id_marshrut_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.marshruty_id_marshrut_seq OWNER TO postgres;

--
-- TOC entry 2910 (class 0 OID 0)
-- Dependencies: 209
-- Name: marshruty_id_marshrut_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.marshruty_id_marshrut_seq OWNED BY alpinisty.marshruty.id_marshrut;


--
-- TOC entry 200 (class 1259 OID 16408)
-- Name: nesht_situacii; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий информацию с перечнем нештатных ситуаций
CREATE TABLE alpinisty.nesht_situacii (
    id_ns integer NOT NULL,
    name_ns character(100) NOT NULL
);


ALTER TABLE alpinisty.nesht_situacii OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16406)
-- Name: nesht_situacii_id_ns_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.nesht_situacii_id_ns_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.nesht_situacii_id_ns_seq OWNER TO postgres;

--
-- TOC entry 2911 (class 0 OID 0)
-- Dependencies: 199
-- Name: nesht_situacii_id_ns_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.nesht_situacii_id_ns_seq OWNED BY alpinisty.nesht_situacii.id_ns;


--
-- TOC entry 202 (class 1259 OID 16416)
-- Name: rayon; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий информацию о горных районах маршрутов
CREATE TABLE alpinisty.rayon (
    id_rayon integer NOT NULL,
    name_rayon character(100) NOT NULL,
    id_strany integer
);


ALTER TABLE alpinisty.rayon OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16414)
-- Name: rayon_id_rayon_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.rayon_id_rayon_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.rayon_id_rayon_seq OWNER TO postgres;

--
-- TOC entry 2912 (class 0 OID 0)
-- Dependencies: 201
-- Name: rayon_id_rayon_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.rayon_id_rayon_seq OWNED BY alpinisty.rayon.id_rayon;


--
-- TOC entry 198 (class 1259 OID 16397)
-- Name: strany; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- справочник содержащий информацию с перечнем стран где находятся маршруты или альп.клубы
CREATE TABLE alpinisty.strany (
    name_strana character(100) NOT NULL,
    id_strana integer NOT NULL
);


ALTER TABLE alpinisty.strany OWNER TO postgres;

--
-- TOC entry 2913 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE strany; Type: COMMENT; Schema: alpinisty; Owner: postgres
--

COMMENT ON TABLE alpinisty.strany IS 'справочник страны';


--
-- TOC entry 197 (class 1259 OID 16395)
-- Name: strany_id_strana_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.strany_id_strana_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.strany_id_strana_seq OWNER TO postgres;

--
-- TOC entry 2914 (class 0 OID 0)
-- Dependencies: 197
-- Name: strany_id_strana_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.strany_id_strana_seq OWNED BY alpinisty.strany.id_strana;


--
-- TOC entry 214 (class 1259 OID 16503)
-- Name: uchastie_vgruppach; Type: TABLE; Schema: alpinisty; Owner: postgres
--
-- вспомагательный справочник содержащий информацию о восхождениях альпинистов
CREATE TABLE alpinisty.uchastie_vgruppach (
    alpinist integer,
    rezult_alpinista character(50),
    nesht_situacii integer,
    id_uvg integer NOT NULL,
    gruppa integer
);


ALTER TABLE alpinisty.uchastie_vgruppach OWNER TO postgres;

--
-- TOC entry 2915 (class 0 OID 0)
-- Dependencies: 214
-- Name: TABLE uchastie_vgruppach; Type: COMMENT; Schema: alpinisty; Owner: postgres
--

COMMENT ON TABLE alpinisty.uchastie_vgruppach IS 'вспомагательный справочник к справочнику alp_gruppa';


--
-- TOC entry 213 (class 1259 OID 16501)
-- Name: uchastie_vgruppach_id_uvg_seq; Type: SEQUENCE; Schema: alpinisty; Owner: postgres
--

CREATE SEQUENCE alpinisty.uchastie_vgruppach_id_uvg_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alpinisty.uchastie_vgruppach_id_uvg_seq OWNER TO postgres;

--
-- TOC entry 2916 (class 0 OID 0)
-- Dependencies: 213
-- Name: uchastie_vgruppach_id_uvg_seq; Type: SEQUENCE OWNED BY; Schema: alpinisty; Owner: postgres
--

ALTER SEQUENCE alpinisty.uchastie_vgruppach_id_uvg_seq OWNED BY alpinisty.uchastie_vgruppach.id_uvg;


--
-- TOC entry 2729 (class 2604 OID 16493)
-- Name: alp_gruppa id_gruppy; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.alp_gruppa ALTER COLUMN id_gruppy SET DEFAULT nextval('alpinisty.alp_gruppa_id_gruppy_seq'::regclass);


--
-- TOC entry 2726 (class 2604 OID 16448)
-- Name: alpinisty id_alpinista; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.alpinisty ALTER COLUMN id_alpinista SET DEFAULT nextval('alpinisty.alpinisty_id_alpinista_seq'::regclass);


--
-- TOC entry 2725 (class 2604 OID 16432)
-- Name: cluby id_clubs; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.cluby ALTER COLUMN id_clubs SET DEFAULT nextval('alpinisty.cluby_id_clubs_seq'::regclass);


--
-- TOC entry 2727 (class 2604 OID 16464)
-- Name: gory id_gory; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.gory ALTER COLUMN id_gory SET DEFAULT nextval('alpinisty.gory_id_gory_seq'::regclass);


--
-- TOC entry 2728 (class 2604 OID 16477)
-- Name: marshruty id_marshrut; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.marshruty ALTER COLUMN id_marshrut SET DEFAULT nextval('alpinisty.marshruty_id_marshrut_seq'::regclass);


--
-- TOC entry 2723 (class 2604 OID 16411)
-- Name: nesht_situacii id_ns; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.nesht_situacii ALTER COLUMN id_ns SET DEFAULT nextval('alpinisty.nesht_situacii_id_ns_seq'::regclass);


--
-- TOC entry 2724 (class 2604 OID 16419)
-- Name: rayon id_rayon; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.rayon ALTER COLUMN id_rayon SET DEFAULT nextval('alpinisty.rayon_id_rayon_seq'::regclass);


--
-- TOC entry 2722 (class 2604 OID 16400)
-- Name: strany id_strana; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.strany ALTER COLUMN id_strana SET DEFAULT nextval('alpinisty.strany_id_strana_seq'::regclass);


--
-- TOC entry 2730 (class 2604 OID 16506)
-- Name: uchastie_vgruppach id_uvg; Type: DEFAULT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.uchastie_vgruppach ALTER COLUMN id_uvg SET DEFAULT nextval('alpinisty.uchastie_vgruppach_id_uvg_seq'::regclass);


--
-- TOC entry 2894 (class 0 OID 16490)
-- Dependencies: 212
-- Data for Name: alp_gruppa; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.alp_gruppa (id_gruppy, commentariy, rezult, data_otpravlenia, data_vozvrachenia, marshrut, nach_voshog_plan, zaver_voshog_plan, nach_voshog_fact, zaver_voshog_fact) FROM stdin;
2	все хорошо                                                                                                                                                                                              	успешно                                           	2019-10-19 10:23:54+03	2019-10-24 10:23:54+03	3	2019-10-20 11:23:54+03	2019-10-22 10:24:54+03	11:23:54+03	10:24:54+03
3	все хорошо                                                                                                                                                                                              	успешно                                           	2019-01-19 10:23:54+02	2019-01-24 10:23:54+02	4	2019-01-20 11:23:54+02	2019-01-22 10:24:54+02	11:23:54+02	10:24:54+02
4	потеряли палатку                                                                                                                                                                                        	успешно                                           	2019-11-19 12:23:54+02	2019-11-24 12:23:54+02	3	2019-11-20 12:23:54+02	2019-11-22 12:24:54+02	12:23:54+02	12:24:54+02
5	травма у одного из участников                                                                                                                                                                           	удовлетварительно                                 	2019-02-19 10:23:54+02	2019-02-24 10:23:54+02	3	2019-02-20 11:23:54+02	2019-02-22 10:24:54+02	11:23:54+02	10:24:54+02
6	все хорошо                                                                                                                                                                                              	успешно                                           	2019-03-19 10:23:54+02	2019-03-24 10:23:54+02	3	2019-03-20 11:23:54+02	2019-03-22 10:24:54+02	11:23:54+02	10:24:54+02
\.


--
-- TOC entry 2888 (class 0 OID 16445)
-- Dependencies: 206
-- Data for Name: alpinisty; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.alpinisty (id_alpinista, ima_alpinista, otchestvo_alpinista, familia_alpinista, vozrast, adres, tel, email, id_cluba) FROM stdin;
3	Петр                                                                                                	Иванович                                                                                            	Самопалов                                                                                           	49	Санкт-петербург,ул Академика Павлова 1 кв 12                                                        	8950325235235                                                                                       	samopal@mail.ru                                                                                     	1
6	Николай                                                                                             	Семенович                                                                                           	Заикин                                                                                              	20	Санкт-петербург,ул Балканская 17 кв 10                                                              	895532523525                                                                                        	zaikin@mail.ru                                                                                      	1
2	Алексей                                                                                             	Петрович                                                                                            	Рубинин                                                                                             	39	Санкт-петербург,ул Бабушкина 11 кв 12                                                               	895012312312                                                                                        	rubinin@mail.ru                                                                                     	1
4	Алексей                                                                                             	Исхакович                                                                                           	Рубинштейн                                                                                          	19	Санкт-петербург,ул Академика Павлова 1 кв 10                                                        	8955235252325                                                                                       	rubin@mail.ru                                                                                       	1
5	Виталий                                                                                             	Романович                                                                                           	Иванов                                                                                              	29	Санкт-петербург,ул Александра Невского 10 кв 140                                                    	8956868656844                                                                                       	ivanov@mail.ru                                                                                      	1
\.


--
-- TOC entry 2886 (class 0 OID 16429)
-- Dependencies: 204
-- Data for Name: cluby; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.cluby (id_clubs, name_clubs, adres, tel, email, id_strany, kontakt_lico) FROM stdin;
1	Альпклуб ЛЭТИ                                                                                       	Санкт-Петербург                                                                                     	898190912345                                                                                        	alpclubleti@gmail.com                                                                               	1	Дмитрий Евгеньевич Царегородцев                                                                                                                                                                         
2	Ключ                                                                                                	Москва                                                                                              	892626281905                                                                                        	alpclub@gmail.com                                                                                   	1	Александр Геннадьевич Лавров                                                                                                                                                                            
3	Штурм                                                                                               	Владиковказ                                                                                         	8952346346333                                                                                       	clubshturm@mail.com                                                                                 	1	Владимир Анатольевич Кореньков                                                                                                                                                                          
4	Крокус                                                                                              	Омск                                                                                                	8956777373737                                                                                       	alpclub@mail.com                                                                                    	1	Евгений Сергеевич Жулинский                                                                                                                                                                             
5	Барс                                                                                                	Санкт-Петербург                                                                                     	8950474747474                                                                                       	alpclubars@mail.com                                                                                 	1	Сергей Алексеевич Семилеткин                                                                                                                                                                            
\.


--
-- TOC entry 2890 (class 0 OID 16461)
-- Dependencies: 208
-- Data for Name: gory; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.gory (id_gory, vysota, name_gory, rayon) FROM stdin;
3	4509	Белуха                                                                                              	3
4	4173	Маашей-Баш                                                                                          	3
5	3738	Беркутаул                                                                                           	3
6	5058	Джанга                                                                                              	1
7	5642	Эльбрус                                                                                             	1
\.


--
-- TOC entry 2892 (class 0 OID 16474)
-- Dependencies: 210
-- Data for Name: marshruty; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.marshruty (id_marshrut, opisanie, prodolgitelnost, gory) FROM stdin;
1	Восхождение на Белуху	45	3
2	Алтайская сказка	46	4
3	Облегченный маршрут на Алтае	46	5
4	Восхождение на Джангу	49	6
5	Сказки Эльбруса	46	7
\.


--
-- TOC entry 2882 (class 0 OID 16408)
-- Dependencies: 200
-- Data for Name: nesht_situacii; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.nesht_situacii (id_ns, name_ns) FROM stdin;
1	травма                                                                                              
2	пропал без вести                                                                                    
3	летальный исход                                                                                     
4	остался жить в горах                                                                                
5	псих. травма                                                                                        
6	без проишествий                                                                                     
\.


--
-- TOC entry 2884 (class 0 OID 16416)
-- Dependencies: 202
-- Data for Name: rayon; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.rayon (id_rayon, name_rayon, id_strany) FROM stdin;
1	Большой Кавказ                                                                                      	1
2	Уральские горы                                                                                      	1
3	Алтай                                                                                               	1
4	Западные Саяны                                                                                      	1
5	Восточные Саяны                                                                                     	1
\.


--
-- TOC entry 2880 (class 0 OID 16397)
-- Dependencies: 198
-- Data for Name: strany; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.strany (name_strana, id_strana) FROM stdin;
Россия                                                                                              	1
США                                                                                                 	2
Украина                                                                                             	3
Германия                                                                                            	4
Бразилия                                                                                            	5
\.


--
-- TOC entry 2896 (class 0 OID 16503)
-- Dependencies: 214
-- Data for Name: uchastie_vgruppach; Type: TABLE DATA; Schema: alpinisty; Owner: postgres
--

COPY alpinisty.uchastie_vgruppach (alpinist, rezult_alpinista, nesht_situacii, id_uvg, gruppa) FROM stdin;
2	успешно                                           	6	1	2
2	успешно                                           	6	2	3
2	успешно                                           	6	3	4
3	успешно                                           	6	4	2
4	удовлетворительно                                 	1	5	2
\.


--
-- TOC entry 2917 (class 0 OID 0)
-- Dependencies: 211
-- Name: alp_gruppa_id_gruppy_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.alp_gruppa_id_gruppy_seq', 6, true);


--
-- TOC entry 2918 (class 0 OID 0)
-- Dependencies: 205
-- Name: alpinisty_id_alpinista_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.alpinisty_id_alpinista_seq', 6, true);


--
-- TOC entry 2919 (class 0 OID 0)
-- Dependencies: 203
-- Name: cluby_id_clubs_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.cluby_id_clubs_seq', 5, true);


--
-- TOC entry 2920 (class 0 OID 0)
-- Dependencies: 207
-- Name: gory_id_gory_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.gory_id_gory_seq', 7, true);


--
-- TOC entry 2921 (class 0 OID 0)
-- Dependencies: 209
-- Name: marshruty_id_marshrut_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.marshruty_id_marshrut_seq', 5, true);


--
-- TOC entry 2922 (class 0 OID 0)
-- Dependencies: 199
-- Name: nesht_situacii_id_ns_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.nesht_situacii_id_ns_seq', 6, true);


--
-- TOC entry 2923 (class 0 OID 0)
-- Dependencies: 201
-- Name: rayon_id_rayon_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.rayon_id_rayon_seq', 5, true);


--
-- TOC entry 2924 (class 0 OID 0)
-- Dependencies: 197
-- Name: strany_id_strana_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.strany_id_strana_seq', 5, true);


--
-- TOC entry 2925 (class 0 OID 0)
-- Dependencies: 213
-- Name: uchastie_vgruppach_id_uvg_seq; Type: SEQUENCE SET; Schema: alpinisty; Owner: postgres
--

SELECT pg_catalog.setval('alpinisty.uchastie_vgruppach_id_uvg_seq', 5, true);


--
-- TOC entry 2746 (class 2606 OID 16495)
-- Name: alp_gruppa alp_gruppa_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.alp_gruppa
    ADD CONSTRAINT alp_gruppa_pkey PRIMARY KEY (id_gruppy);


--
-- TOC entry 2740 (class 2606 OID 16453)
-- Name: alpinisty alpinisty_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.alpinisty
    ADD CONSTRAINT alpinisty_pkey PRIMARY KEY (id_alpinista);


--
-- TOC entry 2738 (class 2606 OID 16434)
-- Name: cluby cluby_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.cluby
    ADD CONSTRAINT cluby_pkey PRIMARY KEY (id_clubs);


--
-- TOC entry 2742 (class 2606 OID 16466)
-- Name: gory gory_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.gory
    ADD CONSTRAINT gory_pkey PRIMARY KEY (id_gory);


--
-- TOC entry 2744 (class 2606 OID 16482)
-- Name: marshruty marshruty_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.marshruty
    ADD CONSTRAINT marshruty_pkey PRIMARY KEY (id_marshrut);


--
-- TOC entry 2734 (class 2606 OID 16413)
-- Name: nesht_situacii nesht_situacii_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.nesht_situacii
    ADD CONSTRAINT nesht_situacii_pkey PRIMARY KEY (id_ns);


--
-- TOC entry 2736 (class 2606 OID 16421)
-- Name: rayon rayon_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.rayon
    ADD CONSTRAINT rayon_pkey PRIMARY KEY (id_rayon);


--
-- TOC entry 2732 (class 2606 OID 16402)
-- Name: strany strany_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.strany
    ADD CONSTRAINT strany_pkey PRIMARY KEY (id_strana);


--
-- TOC entry 2748 (class 2606 OID 16508)
-- Name: uchastie_vgruppach uchastie_vgruppach_pkey; Type: CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.uchastie_vgruppach
    ADD CONSTRAINT uchastie_vgruppach_pkey PRIMARY KEY (id_uvg);


--
-- TOC entry 2755 (class 2606 OID 16509)
-- Name: uchastie_vgruppach alpinist; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.uchastie_vgruppach
    ADD CONSTRAINT alpinist FOREIGN KEY (alpinist) REFERENCES alpinisty.alpinisty(id_alpinista);


--
-- TOC entry 2753 (class 2606 OID 16483)
-- Name: marshruty gory; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.marshruty
    ADD CONSTRAINT gory FOREIGN KEY (gory) REFERENCES alpinisty.gory(id_gory);


--
-- TOC entry 2757 (class 2606 OID 16519)
-- Name: uchastie_vgruppach gruppa; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.uchastie_vgruppach
    ADD CONSTRAINT gruppa FOREIGN KEY (gruppa) REFERENCES alpinisty.alp_gruppa(id_gruppy);


--
-- TOC entry 2751 (class 2606 OID 16454)
-- Name: alpinisty id_cluba; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.alpinisty
    ADD CONSTRAINT id_cluba FOREIGN KEY (id_cluba) REFERENCES alpinisty.cluby(id_clubs);


--
-- TOC entry 2749 (class 2606 OID 16422)
-- Name: rayon id_strany; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.rayon
    ADD CONSTRAINT id_strany FOREIGN KEY (id_strany) REFERENCES alpinisty.strany(id_strana);


--
-- TOC entry 2750 (class 2606 OID 16435)
-- Name: cluby id_strany; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.cluby
    ADD CONSTRAINT id_strany FOREIGN KEY (id_strany) REFERENCES alpinisty.strany(id_strana);


--
-- TOC entry 2754 (class 2606 OID 16496)
-- Name: alp_gruppa marshrut; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.alp_gruppa
    ADD CONSTRAINT marshrut FOREIGN KEY (marshrut) REFERENCES alpinisty.marshruty(id_marshrut) NOT VALID;


--
-- TOC entry 2752 (class 2606 OID 16467)
-- Name: gory rayon; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.gory
    ADD CONSTRAINT rayon FOREIGN KEY (rayon) REFERENCES alpinisty.rayon(id_rayon);


--
-- TOC entry 2756 (class 2606 OID 16514)
-- Name: uchastie_vgruppach situacii; Type: FK CONSTRAINT; Schema: alpinisty; Owner: postgres
--

ALTER TABLE ONLY alpinisty.uchastie_vgruppach
    ADD CONSTRAINT situacii FOREIGN KEY (nesht_situacii) REFERENCES alpinisty.nesht_situacii(id_ns);


-- Completed on 2020-07-02 18:04:33

--
-- PostgreSQL database dump complete
--

