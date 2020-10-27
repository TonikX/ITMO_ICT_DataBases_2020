--
-- PostgreSQL database dump
--

-- Dumped from database version 13.0
-- Dumped by pg_dump version 13.0

-- Started on 2020-10-13 22:11:08 MSK

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
-- TOC entry 3361 (class 1262 OID 16394)
-- Name: exchange; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE exchange WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'C';


ALTER DATABASE exchange OWNER TO postgres;

\connect exchange

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
-- TOC entry 6 (class 2615 OID 16395)
-- Name: commodities; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA commodities;


ALTER SCHEMA commodities OWNER TO postgres;

--
-- TOC entry 2 (class 3079 OID 16563)
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- TOC entry 3362 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 206 (class 1259 OID 16465)
-- Name: Batches; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Batches" (
    "Price" numeric(12,2) NOT NULL,
    "Quantity" integer NOT NULL,
    "Produced_at" timestamp with time zone NOT NULL,
    "Expires_at" timestamp with time zone NOT NULL,
    "ID" integer NOT NULL,
    "Manufacturer_ID" integer NOT NULL,
    "Product_ID" integer NOT NULL,
    "Shipment_ID" bigint,
    CONSTRAINT "Expiry date is valid." CHECK (("Produced_at" < "Expires_at")),
    CONSTRAINT "Price is positive." CHECK (("Price" > (0)::numeric)),
    CONSTRAINT "Quantity is positive." CHECK (("Quantity" > 0))
);


ALTER TABLE commodities."Batches" OWNER TO postgres;

--
-- TOC entry 3363 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE "Batches"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Batches" IS 'Batches are tangible items that can be shipped to consumers.';


--
-- TOC entry 3364 (class 0 OID 0)
-- Dependencies: 206
-- Name: CONSTRAINT "Expiry date is valid." ON "Batches"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Expiry date is valid." ON commodities."Batches" IS 'Expiry date must be set to a later date compared to the "Expires_at" attribute.';


--
-- TOC entry 3365 (class 0 OID 0)
-- Dependencies: 206
-- Name: CONSTRAINT "Price is positive." ON "Batches"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Price is positive." ON commodities."Batches" IS 'Price must be a positive value.';


--
-- TOC entry 3366 (class 0 OID 0)
-- Dependencies: 206
-- Name: CONSTRAINT "Quantity is positive." ON "Batches"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Quantity is positive." ON commodities."Batches" IS 'Quantity must be positive.';


--
-- TOC entry 211 (class 1259 OID 16667)
-- Name: Batches_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Batches_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Batches_ID_seq" OWNER TO postgres;

--
-- TOC entry 3367 (class 0 OID 0)
-- Dependencies: 211
-- Name: Batches_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Batches_ID_seq" OWNED BY commodities."Batches"."ID";


--
-- TOC entry 212 (class 1259 OID 16673)
-- Name: Batches_Manufacturer_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Batches_Manufacturer_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Batches_Manufacturer_ID_seq" OWNER TO postgres;

--
-- TOC entry 3368 (class 0 OID 0)
-- Dependencies: 212
-- Name: Batches_Manufacturer_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Batches_Manufacturer_ID_seq" OWNED BY commodities."Batches"."Manufacturer_ID";


--
-- TOC entry 213 (class 1259 OID 16679)
-- Name: Batches_Product_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Batches_Product_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Batches_Product_ID_seq" OWNER TO postgres;

--
-- TOC entry 3369 (class 0 OID 0)
-- Dependencies: 213
-- Name: Batches_Product_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Batches_Product_ID_seq" OWNED BY commodities."Batches"."Product_ID";


--
-- TOC entry 204 (class 1259 OID 16409)
-- Name: Brokers; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Brokers" (
    "Name" character varying NOT NULL,
    "Firm_ID" integer NOT NULL,
    "ID" integer NOT NULL,
    CONSTRAINT "Name is non-empty." CHECK ((length(("Name")::text) > 0))
);


ALTER TABLE commodities."Brokers" OWNER TO postgres;

--
-- TOC entry 3370 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE "Brokers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Brokers" IS 'Brockers initiate shipments, pay their employers (firms) 10% fee from all successful deals and keep the rest.';


--
-- TOC entry 3371 (class 0 OID 0)
-- Dependencies: 204
-- Name: CONSTRAINT "Name is non-empty." ON "Brokers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Name is non-empty." ON commodities."Brokers" IS 'Name must not be empty.';


--
-- TOC entry 208 (class 1259 OID 16617)
-- Name: Brokers_Firm_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Brokers_Firm_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Brokers_Firm_ID_seq" OWNER TO postgres;

--
-- TOC entry 3372 (class 0 OID 0)
-- Dependencies: 208
-- Name: Brokers_Firm_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Brokers_Firm_ID_seq" OWNED BY commodities."Brokers"."Firm_ID";


--
-- TOC entry 214 (class 1259 OID 16898)
-- Name: Brokers_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Brokers_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Brokers_ID_seq" OWNER TO postgres;

--
-- TOC entry 3373 (class 0 OID 0)
-- Dependencies: 214
-- Name: Brokers_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Brokers_ID_seq" OWNED BY commodities."Brokers"."ID";


--
-- TOC entry 205 (class 1259 OID 16417)
-- Name: Firms; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Firms" (
    "Firm_ID" integer NOT NULL,
    "Title" character varying
);


ALTER TABLE commodities."Firms" OWNER TO postgres;

--
-- TOC entry 3374 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE "Firms"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Firms" IS 'Firms hire brockers to trade and collect 10% comission from every deal.';


--
-- TOC entry 207 (class 1259 OID 16597)
-- Name: Firms_Firm_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Firms_Firm_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Firms_Firm_ID_seq" OWNER TO postgres;

--
-- TOC entry 3375 (class 0 OID 0)
-- Dependencies: 207
-- Name: Firms_Firm_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Firms_Firm_ID_seq" OWNED BY commodities."Firms"."Firm_ID";


--
-- TOC entry 202 (class 1259 OID 16396)
-- Name: Manufacturers; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Manufacturers" (
    "Title" character varying NOT NULL,
    "ID" integer NOT NULL,
    CONSTRAINT "Title non-empty." CHECK ((length(("Title")::text) > 0))
);


ALTER TABLE commodities."Manufacturers" OWNER TO postgres;

--
-- TOC entry 3376 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE "Manufacturers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Manufacturers" IS 'Manufacturers produce products base on their products catalogue.';


--
-- TOC entry 3377 (class 0 OID 0)
-- Dependencies: 202
-- Name: CONSTRAINT "Title non-empty." ON "Manufacturers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Title non-empty." ON commodities."Manufacturers" IS 'Title must not be empty.';


--
-- TOC entry 209 (class 1259 OID 16641)
-- Name: Manufacturers_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Manufacturers_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Manufacturers_ID_seq" OWNER TO postgres;

--
-- TOC entry 3378 (class 0 OID 0)
-- Dependencies: 209
-- Name: Manufacturers_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Manufacturers_ID_seq" OWNED BY commodities."Manufacturers"."ID";


--
-- TOC entry 203 (class 1259 OID 16404)
-- Name: Products; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Products" (
    "Title" character varying NOT NULL,
    "Unit" character varying(20) NOT NULL,
    "ID" integer NOT NULL,
    CONSTRAINT "Title non-empty" CHECK ((length(("Title")::text) > 0)),
    CONSTRAINT "Unit non-empty." CHECK ((length(("Unit")::text) > 0))
);


ALTER TABLE commodities."Products" OWNER TO postgres;

--
-- TOC entry 3379 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE "Products"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Products" IS '(Not yet manufactured) Products can be though of as entries in a manufacturer''s catalogue.';


--
-- TOC entry 3380 (class 0 OID 0)
-- Dependencies: 203
-- Name: CONSTRAINT "Title non-empty" ON "Products"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Title non-empty" ON commodities."Products" IS 'Title must not be empty.';


--
-- TOC entry 3381 (class 0 OID 0)
-- Dependencies: 203
-- Name: CONSTRAINT "Unit non-empty." ON "Products"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Unit non-empty." ON commodities."Products" IS 'Units must not be empty.';


--
-- TOC entry 210 (class 1259 OID 16656)
-- Name: Products_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Products_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Products_ID_seq" OWNER TO postgres;

--
-- TOC entry 3382 (class 0 OID 0)
-- Dependencies: 210
-- Name: Products_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Products_ID_seq" OWNED BY commodities."Products"."ID";


--
-- TOC entry 217 (class 1259 OID 16913)
-- Name: Shipments; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Shipments" (
    "ID" bigint NOT NULL,
    "Broker_ID" integer NOT NULL,
    "Items" integer NOT NULL,
    "Subtotal" numeric(15,2) NOT NULL,
    "Prepayment" boolean NOT NULL,
    "Shipped_at" timestamp with time zone NOT NULL
);


ALTER TABLE commodities."Shipments" OWNER TO postgres;

--
-- TOC entry 3383 (class 0 OID 0)
-- Dependencies: 217
-- Name: TABLE "Shipments"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Shipments" IS 'Shipments can consist of multiple batches of products.';


--
-- TOC entry 216 (class 1259 OID 16911)
-- Name: Shipments_Broker_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Shipments_Broker_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Shipments_Broker_ID_seq" OWNER TO postgres;

--
-- TOC entry 3384 (class 0 OID 0)
-- Dependencies: 216
-- Name: Shipments_Broker_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Shipments_Broker_ID_seq" OWNED BY commodities."Shipments"."Broker_ID";


--
-- TOC entry 215 (class 1259 OID 16909)
-- Name: Shipments_ID_seq; Type: SEQUENCE; Schema: commodities; Owner: postgres
--

CREATE SEQUENCE commodities."Shipments_ID_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commodities."Shipments_ID_seq" OWNER TO postgres;

--
-- TOC entry 3385 (class 0 OID 0)
-- Dependencies: 215
-- Name: Shipments_ID_seq; Type: SEQUENCE OWNED BY; Schema: commodities; Owner: postgres
--

ALTER SEQUENCE commodities."Shipments_ID_seq" OWNED BY commodities."Shipments"."ID";


--
-- TOC entry 3181 (class 2604 OID 16669)
-- Name: Batches ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches" ALTER COLUMN "ID" SET DEFAULT nextval('commodities."Batches_ID_seq"'::regclass);


--
-- TOC entry 3182 (class 2604 OID 16675)
-- Name: Batches Manufacturer_ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches" ALTER COLUMN "Manufacturer_ID" SET DEFAULT nextval('commodities."Batches_Manufacturer_ID_seq"'::regclass);


--
-- TOC entry 3183 (class 2604 OID 16681)
-- Name: Batches Product_ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches" ALTER COLUMN "Product_ID" SET DEFAULT nextval('commodities."Batches_Product_ID_seq"'::regclass);


--
-- TOC entry 3176 (class 2604 OID 16619)
-- Name: Brokers Firm_ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Brokers" ALTER COLUMN "Firm_ID" SET DEFAULT nextval('commodities."Brokers_Firm_ID_seq"'::regclass);


--
-- TOC entry 3177 (class 2604 OID 16900)
-- Name: Brokers ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Brokers" ALTER COLUMN "ID" SET DEFAULT nextval('commodities."Brokers_ID_seq"'::regclass);


--
-- TOC entry 3179 (class 2604 OID 16599)
-- Name: Firms Firm_ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Firms" ALTER COLUMN "Firm_ID" SET DEFAULT nextval('commodities."Firms_Firm_ID_seq"'::regclass);


--
-- TOC entry 3171 (class 2604 OID 16643)
-- Name: Manufacturers ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Manufacturers" ALTER COLUMN "ID" SET DEFAULT nextval('commodities."Manufacturers_ID_seq"'::regclass);


--
-- TOC entry 3173 (class 2604 OID 16658)
-- Name: Products ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Products" ALTER COLUMN "ID" SET DEFAULT nextval('commodities."Products_ID_seq"'::regclass);


--
-- TOC entry 3187 (class 2604 OID 16916)
-- Name: Shipments ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Shipments" ALTER COLUMN "ID" SET DEFAULT nextval('commodities."Shipments_ID_seq"'::regclass);


--
-- TOC entry 3188 (class 2604 OID 16917)
-- Name: Shipments Broker_ID; Type: DEFAULT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Shipments" ALTER COLUMN "Broker_ID" SET DEFAULT nextval('commodities."Shipments_Broker_ID_seq"'::regclass);


--
-- TOC entry 3344 (class 0 OID 16465)
-- Dependencies: 206
-- Data for Name: Batches; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Batches" ("Price", "Quantity", "Produced_at", "Expires_at", "ID", "Manufacturer_ID", "Product_ID", "Shipment_ID") VALUES (599.99, 1000, '2020-01-01 00:00:00+03', '2030-01-01 00:00:00+03', 1, 1, 1, 2);
INSERT INTO commodities."Batches" ("Price", "Quantity", "Produced_at", "Expires_at", "ID", "Manufacturer_ID", "Product_ID", "Shipment_ID") VALUES (299.99, 2000, '2020-05-09 00:00:00+03', '2020-09-01 00:00:00+03', 2, 2, 3, 3);
INSERT INTO commodities."Batches" ("Price", "Quantity", "Produced_at", "Expires_at", "ID", "Manufacturer_ID", "Product_ID", "Shipment_ID") VALUES (129.99, 5000, '2020-02-02 15:00:00+03', '2024-02-02 00:00:00+03', 3, 3, 2, 4);
INSERT INTO commodities."Batches" ("Price", "Quantity", "Produced_at", "Expires_at", "ID", "Manufacturer_ID", "Product_ID", "Shipment_ID") VALUES (9.99, 10000, '2021-04-02 00:00:00+03', '2031-04-02 00:00:00+03', 4, 4, 6, 5);
INSERT INTO commodities."Batches" ("Price", "Quantity", "Produced_at", "Expires_at", "ID", "Manufacturer_ID", "Product_ID", "Shipment_ID") VALUES (89.99, 4500, '2018-05-06 00:00:00+03', '2021-03-30 00:00:00+03', 5, 5, 5, 6);
INSERT INTO commodities."Batches" ("Price", "Quantity", "Produced_at", "Expires_at", "ID", "Manufacturer_ID", "Product_ID", "Shipment_ID") VALUES (199.99, 1000, '2020-01-06 12:00:00+03', '2023-01-01 12:00:00+03', 6, 1, 4, NULL);


--
-- TOC entry 3342 (class 0 OID 16409)
-- Dependencies: 204
-- Data for Name: Brokers; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Brokers" ("Name", "Firm_ID", "ID") VALUES ('Larry', 1, 1);
INSERT INTO commodities."Brokers" ("Name", "Firm_ID", "ID") VALUES ('Ludwig', 2, 2);
INSERT INTO commodities."Brokers" ("Name", "Firm_ID", "ID") VALUES ('Sandy', 3, 3);
INSERT INTO commodities."Brokers" ("Name", "Firm_ID", "ID") VALUES ('Anton', 2, 4);
INSERT INTO commodities."Brokers" ("Name", "Firm_ID", "ID") VALUES ('Clara', 5, 5);


--
-- TOC entry 3343 (class 0 OID 16417)
-- Dependencies: 205
-- Data for Name: Firms; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Firms" ("Firm_ID", "Title") VALUES (1, 'ECO Trade');
INSERT INTO commodities."Firms" ("Firm_ID", "Title") VALUES (2, 'Brokers Association Limited');
INSERT INTO commodities."Firms" ("Firm_ID", "Title") VALUES (3, 'Kavanaugh Brothers CO');
INSERT INTO commodities."Firms" ("Firm_ID", "Title") VALUES (4, 'Goodwill');
INSERT INTO commodities."Firms" ("Firm_ID", "Title") VALUES (5, 'West Way United');


--
-- TOC entry 3340 (class 0 OID 16396)
-- Dependencies: 202
-- Data for Name: Manufacturers; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Manufacturers" ("Title", "ID") VALUES ('Apple', 1);
INSERT INTO commodities."Manufacturers" ("Title", "ID") VALUES ('Amazon', 2);
INSERT INTO commodities."Manufacturers" ("Title", "ID") VALUES ('Samsung', 3);
INSERT INTO commodities."Manufacturers" ("Title", "ID") VALUES ('Microsoft', 4);
INSERT INTO commodities."Manufacturers" ("Title", "ID") VALUES ('Obi', 5);


--
-- TOC entry 3341 (class 0 OID 16404)
-- Dependencies: 203
-- Data for Name: Products; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Products" ("Title", "Unit", "ID") VALUES ('iPhone', 'pcs', 1);
INSERT INTO commodities."Products" ("Title", "Unit", "ID") VALUES ('Galaxy S8', 'pcs', 2);
INSERT INTO commodities."Products" ("Title", "Unit", "ID") VALUES ('Alexa', 'pcs', 3);
INSERT INTO commodities."Products" ("Title", "Unit", "ID") VALUES ('iPad 12 2005', 'pcs', 4);
INSERT INTO commodities."Products" ("Title", "Unit", "ID") VALUES ('Plastic wrapping', 'box', 5);
INSERT INTO commodities."Products" ("Title", "Unit", "ID") VALUES ('Windows 10 870-AX-sd91', 'disc', 6);
INSERT INTO commodities."Products" ("Title", "Unit", "ID") VALUES ('Pixel 2', 'pcs', 7);


--
-- TOC entry 3355 (class 0 OID 16913)
-- Dependencies: 217
-- Data for Name: Shipments; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Shipments" ("ID", "Broker_ID", "Items", "Subtotal", "Prepayment", "Shipped_at") VALUES (2, 1, 1000, 5999900.00, true, '2020-10-12 00:04:00+03');
INSERT INTO commodities."Shipments" ("ID", "Broker_ID", "Items", "Subtotal", "Prepayment", "Shipped_at") VALUES (3, 2, 2000, 5999800.00, false, '2020-11-15 01:12:00+03');
INSERT INTO commodities."Shipments" ("ID", "Broker_ID", "Items", "Subtotal", "Prepayment", "Shipped_at") VALUES (4, 1, 5000, 649950.00, false, '2020-10-01 10:00:00+03');
INSERT INTO commodities."Shipments" ("ID", "Broker_ID", "Items", "Subtotal", "Prepayment", "Shipped_at") VALUES (5, 3, 10000, 99900.00, true, '2020-12-01 14:00:00+03');
INSERT INTO commodities."Shipments" ("ID", "Broker_ID", "Items", "Subtotal", "Prepayment", "Shipped_at") VALUES (6, 4, 4500, 404955.00, false, '2020-10-10 12:00:00+03');


--
-- TOC entry 3386 (class 0 OID 0)
-- Dependencies: 211
-- Name: Batches_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Batches_ID_seq"', 6, true);


--
-- TOC entry 3387 (class 0 OID 0)
-- Dependencies: 212
-- Name: Batches_Manufacturer_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Batches_Manufacturer_ID_seq"', 5, true);


--
-- TOC entry 3388 (class 0 OID 0)
-- Dependencies: 213
-- Name: Batches_Product_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Batches_Product_ID_seq"', 5, true);


--
-- TOC entry 3389 (class 0 OID 0)
-- Dependencies: 208
-- Name: Brokers_Firm_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Brokers_Firm_ID_seq"', 5, true);


--
-- TOC entry 3390 (class 0 OID 0)
-- Dependencies: 214
-- Name: Brokers_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Brokers_ID_seq"', 5, true);


--
-- TOC entry 3391 (class 0 OID 0)
-- Dependencies: 207
-- Name: Firms_Firm_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Firms_Firm_ID_seq"', 5, true);


--
-- TOC entry 3392 (class 0 OID 0)
-- Dependencies: 209
-- Name: Manufacturers_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Manufacturers_ID_seq"', 5, true);


--
-- TOC entry 3393 (class 0 OID 0)
-- Dependencies: 210
-- Name: Products_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Products_ID_seq"', 7, true);


--
-- TOC entry 3394 (class 0 OID 0)
-- Dependencies: 216
-- Name: Shipments_Broker_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Shipments_Broker_ID_seq"', 1, false);


--
-- TOC entry 3395 (class 0 OID 0)
-- Dependencies: 215
-- Name: Shipments_ID_seq; Type: SEQUENCE SET; Schema: commodities; Owner: postgres
--

SELECT pg_catalog.setval('commodities."Shipments_ID_seq"', 6, true);


--
-- TOC entry 3202 (class 2606 OID 16686)
-- Name: Batches Batches_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches"
    ADD CONSTRAINT "Batches_pkey" PRIMARY KEY ("ID");


--
-- TOC entry 3196 (class 2606 OID 16908)
-- Name: Brokers Brokers_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Brokers"
    ADD CONSTRAINT "Brokers_pkey" PRIMARY KEY ("ID");


--
-- TOC entry 3198 (class 2606 OID 16604)
-- Name: Firms Firms_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Firms"
    ADD CONSTRAINT "Firms_pkey" PRIMARY KEY ("Firm_ID");


--
-- TOC entry 3190 (class 2606 OID 16653)
-- Name: Manufacturers Manufacturers_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Manufacturers"
    ADD CONSTRAINT "Manufacturers_pkey" PRIMARY KEY ("ID");


--
-- TOC entry 3194 (class 2606 OID 16666)
-- Name: Products Products_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Products"
    ADD CONSTRAINT "Products_pkey" PRIMARY KEY ("ID");


--
-- TOC entry 3204 (class 2606 OID 16919)
-- Name: Shipments Shipments_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Shipments"
    ADD CONSTRAINT "Shipments_pkey" PRIMARY KEY ("ID");


--
-- TOC entry 3180 (class 2606 OID 16614)
-- Name: Firms Title is non-empty; Type: CHECK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE commodities."Firms"
    ADD CONSTRAINT "Title is non-empty" CHECK ((length(("Title")::text) > 0)) NOT VALID;


--
-- TOC entry 3396 (class 0 OID 0)
-- Dependencies: 3180
-- Name: CONSTRAINT "Title is non-empty" ON "Firms"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Title is non-empty" ON commodities."Firms" IS 'Firm''s title must not be empty.';


--
-- TOC entry 3200 (class 2606 OID 16616)
-- Name: Firms Unique title of firms; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Firms"
    ADD CONSTRAINT "Unique title of firms" UNIQUE ("Title");


--
-- TOC entry 3397 (class 0 OID 0)
-- Dependencies: 3200
-- Name: CONSTRAINT "Unique title of firms" ON "Firms"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Unique title of firms" ON commodities."Firms" IS 'Company''s title must be unique.';


--
-- TOC entry 3192 (class 2606 OID 16655)
-- Name: Manufacturers Unique title of manufacturers; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Manufacturers"
    ADD CONSTRAINT "Unique title of manufacturers" UNIQUE ("Title");


--
-- TOC entry 3398 (class 0 OID 0)
-- Dependencies: 3192
-- Name: CONSTRAINT "Unique title of manufacturers" ON "Manufacturers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Unique title of manufacturers" ON commodities."Manufacturers" IS 'Manufacturer''s title must be unique.';


--
-- TOC entry 3208 (class 2606 OID 16947)
-- Name: Batches Batches_Manufacturer_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches"
    ADD CONSTRAINT "Batches_Manufacturer_ID_fkey" FOREIGN KEY ("Manufacturer_ID") REFERENCES commodities."Manufacturers"("ID") ON UPDATE CASCADE ON DELETE RESTRICT NOT VALID;


--
-- TOC entry 3207 (class 2606 OID 16942)
-- Name: Batches Batches_Product_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches"
    ADD CONSTRAINT "Batches_Product_ID_fkey" FOREIGN KEY ("Product_ID") REFERENCES commodities."Products"("ID") ON UPDATE CASCADE ON DELETE RESTRICT NOT VALID;


--
-- TOC entry 3206 (class 2606 OID 16937)
-- Name: Batches Batches_Shipment_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches"
    ADD CONSTRAINT "Batches_Shipment_ID_fkey" FOREIGN KEY ("Shipment_ID") REFERENCES commodities."Shipments"("ID") ON UPDATE CASCADE ON DELETE SET NULL NOT VALID;


--
-- TOC entry 3205 (class 2606 OID 16627)
-- Name: Brokers Brokers_Firm_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Brokers"
    ADD CONSTRAINT "Brokers_Firm_ID_fkey" FOREIGN KEY ("Firm_ID") REFERENCES commodities."Firms"("Firm_ID") ON UPDATE CASCADE ON DELETE SET NULL NOT VALID;


--
-- TOC entry 3209 (class 2606 OID 16920)
-- Name: Shipments Shipments_Broker_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Shipments"
    ADD CONSTRAINT "Shipments_Broker_ID_fkey" FOREIGN KEY ("Broker_ID") REFERENCES commodities."Brokers"("ID") ON UPDATE CASCADE ON DELETE RESTRICT;


-- Completed on 2020-10-13 22:11:08 MSK

--
-- PostgreSQL database dump complete
--

