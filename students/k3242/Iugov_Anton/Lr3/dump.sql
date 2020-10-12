--
-- PostgreSQL database dump
--

-- Dumped from database version 13.0
-- Dumped by pg_dump version 13.0

-- Started on 2020-10-12 16:09:33 MSK

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
-- TOC entry 3333 (class 1262 OID 16394)
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
-- TOC entry 3334 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 207 (class 1259 OID 16480)
-- Name: Batches; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Batches" (
    "Batch_ID" uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    "Item_ID" uuid NOT NULL
);


ALTER TABLE commodities."Batches" OWNER TO postgres;

--
-- TOC entry 3335 (class 0 OID 0)
-- Dependencies: 207
-- Name: TABLE "Batches"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Batches" IS 'Batches organize manufactured products into groups to be associated with shipments.';


--
-- TOC entry 204 (class 1259 OID 16409)
-- Name: Brockers; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Brockers" (
    "Brocker_ID" uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    "Name" character varying NOT NULL,
    CONSTRAINT "Name is non-empty." CHECK ((length(("Name")::text) > 0))
);


ALTER TABLE commodities."Brockers" OWNER TO postgres;

--
-- TOC entry 3336 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE "Brockers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Brockers" IS 'Brockers initiate shipments, pay their employers (firms) 10% fee from all successful deals and keep the rest.';


--
-- TOC entry 3337 (class 0 OID 0)
-- Dependencies: 204
-- Name: CONSTRAINT "Name is non-empty." ON "Brockers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Name is non-empty." ON commodities."Brockers" IS 'Name must not be empty.';


--
-- TOC entry 205 (class 1259 OID 16417)
-- Name: Firms; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Firms" (
    "Firm_ID" uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    "Brocker_ID" uuid NOT NULL
);


ALTER TABLE commodities."Firms" OWNER TO postgres;

--
-- TOC entry 3338 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE "Firms"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Firms" IS 'Firms hire brockers to trade and collect 10% comission from every deal.';


--
-- TOC entry 206 (class 1259 OID 16465)
-- Name: ManufacturedProducts; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."ManufacturedProducts" (
    "Item_ID" uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    "Manufacturer_ID" uuid NOT NULL,
    "Product_ID" uuid NOT NULL,
    "Price" numeric(12,2) NOT NULL,
    "Quantity" integer NOT NULL,
    "Produced_at" timestamp with time zone NOT NULL,
    "Expires_at" timestamp with time zone NOT NULL,
    CONSTRAINT "Expiry date is valid." CHECK (("Produced_at" < "Expires_at")),
    CONSTRAINT "Price is positive." CHECK (("Price" > (0)::numeric)),
    CONSTRAINT "Quantity is positive." CHECK (("Quantity" > 0))
);


ALTER TABLE commodities."ManufacturedProducts" OWNER TO postgres;

--
-- TOC entry 3339 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE "ManufacturedProducts"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."ManufacturedProducts" IS 'Manufactured products are tangible items that can be put into a batch and later shipped to consumers.';


--
-- TOC entry 3340 (class 0 OID 0)
-- Dependencies: 206
-- Name: CONSTRAINT "Expiry date is valid." ON "ManufacturedProducts"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Expiry date is valid." ON commodities."ManufacturedProducts" IS 'Expiry date must be set to a later date compared to the "Expires_at" attribute.';


--
-- TOC entry 3341 (class 0 OID 0)
-- Dependencies: 206
-- Name: CONSTRAINT "Price is positive." ON "ManufacturedProducts"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Price is positive." ON commodities."ManufacturedProducts" IS 'Price must be a positive value.';


--
-- TOC entry 3342 (class 0 OID 0)
-- Dependencies: 206
-- Name: CONSTRAINT "Quantity is positive." ON "ManufacturedProducts"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Quantity is positive." ON commodities."ManufacturedProducts" IS 'Quantity must be positive.';


--
-- TOC entry 202 (class 1259 OID 16396)
-- Name: Manufacturers; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Manufacturers" (
    "Title" character varying NOT NULL,
    "Manufacturer_ID" uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    CONSTRAINT "Title non-empty." CHECK ((length(("Title")::text) > 0))
);


ALTER TABLE commodities."Manufacturers" OWNER TO postgres;

--
-- TOC entry 3343 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE "Manufacturers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Manufacturers" IS 'Manufacturers produce products base on their products catalogue.';


--
-- TOC entry 3344 (class 0 OID 0)
-- Dependencies: 202
-- Name: CONSTRAINT "Title non-empty." ON "Manufacturers"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Title non-empty." ON commodities."Manufacturers" IS 'Title must not be empty.';


--
-- TOC entry 203 (class 1259 OID 16404)
-- Name: Products; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Products" (
    "Product_ID" uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    "Title" character varying NOT NULL,
    "Unit" character varying(20) NOT NULL,
    CONSTRAINT "Title non-empty" CHECK ((length(("Title")::text) > 0)),
    CONSTRAINT "Unit non-empty." CHECK ((length(("Unit")::text) > 0))
);


ALTER TABLE commodities."Products" OWNER TO postgres;

--
-- TOC entry 3345 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE "Products"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Products" IS '(Not yet manufactured) Products can be though of as entries in a manufacturer''s catalogue.';


--
-- TOC entry 3346 (class 0 OID 0)
-- Dependencies: 203
-- Name: CONSTRAINT "Title non-empty" ON "Products"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Title non-empty" ON commodities."Products" IS 'Title must not be empty.';


--
-- TOC entry 3347 (class 0 OID 0)
-- Dependencies: 203
-- Name: CONSTRAINT "Unit non-empty." ON "Products"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Unit non-empty." ON commodities."Products" IS 'Units must not be empty.';


--
-- TOC entry 208 (class 1259 OID 16520)
-- Name: Shipments; Type: TABLE; Schema: commodities; Owner: postgres
--

CREATE TABLE commodities."Shipments" (
    "Shipment_ID" uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    "Batch_ID" uuid NOT NULL,
    "Broker_ID" uuid NOT NULL,
    "Item_count" integer NOT NULL,
    "Subtotal" numeric(12,2) NOT NULL,
    "Shipped_at" timestamp with time zone NOT NULL,
    "Prepayment" boolean NOT NULL,
    CONSTRAINT "Items present" CHECK (("Item_count" > 0)),
    CONSTRAINT "Shipping schedule" CHECK ((CURRENT_TIMESTAMP < "Shipped_at")),
    CONSTRAINT "Subtotal is positive" CHECK (("Subtotal" > (0)::numeric))
);


ALTER TABLE commodities."Shipments" OWNER TO postgres;

--
-- TOC entry 3348 (class 0 OID 0)
-- Dependencies: 208
-- Name: TABLE "Shipments"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON TABLE commodities."Shipments" IS 'Shipments are deals made by brockers. They include batches of products, reference to a particular brocker and other data.';


--
-- TOC entry 3349 (class 0 OID 0)
-- Dependencies: 208
-- Name: CONSTRAINT "Items present" ON "Shipments"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Items present" ON commodities."Shipments" IS 'One or more items must be present in a shipment.';


--
-- TOC entry 3350 (class 0 OID 0)
-- Dependencies: 208
-- Name: CONSTRAINT "Shipping schedule" ON "Shipments"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Shipping schedule" ON commodities."Shipments" IS 'All new shippings must be scheduled in the future.';


--
-- TOC entry 3351 (class 0 OID 0)
-- Dependencies: 208
-- Name: CONSTRAINT "Subtotal is positive" ON "Shipments"; Type: COMMENT; Schema: commodities; Owner: postgres
--

COMMENT ON CONSTRAINT "Subtotal is positive" ON commodities."Shipments" IS 'Subtotal must be a positive value.';


--
-- TOC entry 3326 (class 0 OID 16480)
-- Dependencies: 207
-- Data for Name: Batches; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Batches" ("Batch_ID", "Item_ID") VALUES ('2c7fa86b-5997-4717-a565-78ac055c490e', '1d512a38-9e6b-4099-a7ea-6e96ad070571');
INSERT INTO commodities."Batches" ("Batch_ID", "Item_ID") VALUES ('9e3211b6-b64d-4878-8042-febce16ac8b1', 'a74722d2-131d-4c20-922e-7d9d0e998811');


--
-- TOC entry 3323 (class 0 OID 16409)
-- Dependencies: 204
-- Data for Name: Brockers; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Brockers" ("Brocker_ID", "Name") VALUES ('5aa0be4e-0ed8-41e2-90e9-3c9953500261', 'Larry');
INSERT INTO commodities."Brockers" ("Brocker_ID", "Name") VALUES ('8e8c1f34-d2dd-4d8b-8d2f-fc1af3f5e206', 'Ludwig');
INSERT INTO commodities."Brockers" ("Brocker_ID", "Name") VALUES ('6bff93ae-9d31-4b99-b4d1-e5d329b0ad43', 'Sandy');
INSERT INTO commodities."Brockers" ("Brocker_ID", "Name") VALUES ('b71c9558-ed11-406a-bcdb-8f92c0738657', 'Clara');
INSERT INTO commodities."Brockers" ("Brocker_ID", "Name") VALUES ('634023be-fdb1-4bb7-851d-2b896526e56f', 'Anton');


--
-- TOC entry 3324 (class 0 OID 16417)
-- Dependencies: 205
-- Data for Name: Firms; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Firms" ("Firm_ID", "Brocker_ID") VALUES ('17c99df2-0758-43dc-9c08-967232048ff2', '5aa0be4e-0ed8-41e2-90e9-3c9953500261');
INSERT INTO commodities."Firms" ("Firm_ID", "Brocker_ID") VALUES ('99953976-a841-4457-8ee8-012a533d71b6', '8e8c1f34-d2dd-4d8b-8d2f-fc1af3f5e206');
INSERT INTO commodities."Firms" ("Firm_ID", "Brocker_ID") VALUES ('36370f3e-d4d7-4965-baef-94419ef21b4f', '6bff93ae-9d31-4b99-b4d1-e5d329b0ad43');
INSERT INTO commodities."Firms" ("Firm_ID", "Brocker_ID") VALUES ('ff37482e-b086-4c0b-973f-11d690185182', 'b71c9558-ed11-406a-bcdb-8f92c0738657');
INSERT INTO commodities."Firms" ("Firm_ID", "Brocker_ID") VALUES ('3ff9c1d4-17f4-46e0-b9da-9b27d7c1c228', '634023be-fdb1-4bb7-851d-2b896526e56f');


--
-- TOC entry 3325 (class 0 OID 16465)
-- Dependencies: 206
-- Data for Name: ManufacturedProducts; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."ManufacturedProducts" ("Item_ID", "Manufacturer_ID", "Product_ID", "Price", "Quantity", "Produced_at", "Expires_at") VALUES ('1d512a38-9e6b-4099-a7ea-6e96ad070571', 'ef1118df-9592-4228-a7f0-ccb0ceb4b9a0', '782ec654-aa89-4011-af30-13918ec9a60d', 299.99, 10000000, '2020-05-09 00:00:00+03', '2025-01-01 00:00:00+03');
INSERT INTO commodities."ManufacturedProducts" ("Item_ID", "Manufacturer_ID", "Product_ID", "Price", "Quantity", "Produced_at", "Expires_at") VALUES ('a74722d2-131d-4c20-922e-7d9d0e998811', 'c18c66a5-80be-45de-8de7-d2da61e1ce3d', 'e7d7af4b-e671-4154-a723-26ba92103b8b', 599.99, 10000000, '2020-01-01 00:00:00+03', '2030-01-01 00:00:00+03');


--
-- TOC entry 3321 (class 0 OID 16396)
-- Dependencies: 202
-- Data for Name: Manufacturers; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Manufacturers" ("Title", "Manufacturer_ID") VALUES ('Apple', 'c18c66a5-80be-45de-8de7-d2da61e1ce3d');
INSERT INTO commodities."Manufacturers" ("Title", "Manufacturer_ID") VALUES ('Amazon', 'ef1118df-9592-4228-a7f0-ccb0ceb4b9a0');
INSERT INTO commodities."Manufacturers" ("Title", "Manufacturer_ID") VALUES ('Samsung', 'efa3f7a5-7ba0-4faf-9f61-311a3fdc53f2');


--
-- TOC entry 3322 (class 0 OID 16404)
-- Dependencies: 203
-- Data for Name: Products; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Products" ("Product_ID", "Title", "Unit") VALUES ('e7d7af4b-e671-4154-a723-26ba92103b8b', 'iPhone', 'pcs');
INSERT INTO commodities."Products" ("Product_ID", "Title", "Unit") VALUES ('10fae382-a796-46e3-b93b-ee6527d8ea1c', 'Galaxy S8', 'pcs');
INSERT INTO commodities."Products" ("Product_ID", "Title", "Unit") VALUES ('782ec654-aa89-4011-af30-13918ec9a60d', 'Alexa', 'pcs');


--
-- TOC entry 3327 (class 0 OID 16520)
-- Dependencies: 208
-- Data for Name: Shipments; Type: TABLE DATA; Schema: commodities; Owner: postgres
--

INSERT INTO commodities."Shipments" ("Shipment_ID", "Batch_ID", "Broker_ID", "Item_count", "Subtotal", "Shipped_at", "Prepayment") VALUES ('3752ca41-ac4e-4c93-862b-9f27c24543cf', '2c7fa86b-5997-4717-a565-78ac055c490e', '5aa0be4e-0ed8-41e2-90e9-3c9953500261', 10000000, 2999900000.00, '2020-11-11 00:00:00+03', false);
INSERT INTO commodities."Shipments" ("Shipment_ID", "Batch_ID", "Broker_ID", "Item_count", "Subtotal", "Shipped_at", "Prepayment") VALUES ('2a8eaba1-1a63-415c-b020-863d1acbc888', '9e3211b6-b64d-4878-8042-febce16ac8b1', '6bff93ae-9d31-4b99-b4d1-e5d329b0ad43', 10000000, 5999900000.00, '2020-11-11 17:20:00+03', true);


--
-- TOC entry 3182 (class 2606 OID 16484)
-- Name: Batches Batches_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches"
    ADD CONSTRAINT "Batches_pkey" PRIMARY KEY ("Batch_ID");


--
-- TOC entry 3176 (class 2606 OID 16416)
-- Name: Brockers Brockers_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Brockers"
    ADD CONSTRAINT "Brockers_pkey" PRIMARY KEY ("Brocker_ID");


--
-- TOC entry 3178 (class 2606 OID 16421)
-- Name: Firms Firms_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Firms"
    ADD CONSTRAINT "Firms_pkey" PRIMARY KEY ("Firm_ID");


--
-- TOC entry 3180 (class 2606 OID 16469)
-- Name: ManufacturedProducts ManufacturedProducts_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."ManufacturedProducts"
    ADD CONSTRAINT "ManufacturedProducts_pkey" PRIMARY KEY ("Item_ID");


--
-- TOC entry 3172 (class 2606 OID 16403)
-- Name: Manufacturers Manufacturers_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Manufacturers"
    ADD CONSTRAINT "Manufacturers_pkey" PRIMARY KEY ("Manufacturer_ID");


--
-- TOC entry 3174 (class 2606 OID 16408)
-- Name: Products Products_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Products"
    ADD CONSTRAINT "Products_pkey" PRIMARY KEY ("Product_ID");


--
-- TOC entry 3184 (class 2606 OID 16524)
-- Name: Shipments Shipments_pkey; Type: CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Shipments"
    ADD CONSTRAINT "Shipments_pkey" PRIMARY KEY ("Shipment_ID");


--
-- TOC entry 3188 (class 2606 OID 16485)
-- Name: Batches Batches_Item_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Batches"
    ADD CONSTRAINT "Batches_Item_ID_fkey" FOREIGN KEY ("Item_ID") REFERENCES commodities."ManufacturedProducts"("Item_ID") ON DELETE CASCADE;


--
-- TOC entry 3185 (class 2606 OID 16427)
-- Name: Firms Firms_Brocker_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Firms"
    ADD CONSTRAINT "Firms_Brocker_ID_fkey" FOREIGN KEY ("Brocker_ID") REFERENCES commodities."Brockers"("Brocker_ID") ON DELETE CASCADE;


--
-- TOC entry 3186 (class 2606 OID 16470)
-- Name: ManufacturedProducts ManufacturedProducts_Manufacturer_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."ManufacturedProducts"
    ADD CONSTRAINT "ManufacturedProducts_Manufacturer_ID_fkey" FOREIGN KEY ("Manufacturer_ID") REFERENCES commodities."Manufacturers"("Manufacturer_ID");


--
-- TOC entry 3187 (class 2606 OID 16475)
-- Name: ManufacturedProducts ManufacturedProducts_Product_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."ManufacturedProducts"
    ADD CONSTRAINT "ManufacturedProducts_Product_ID_fkey" FOREIGN KEY ("Product_ID") REFERENCES commodities."Products"("Product_ID");


--
-- TOC entry 3189 (class 2606 OID 16525)
-- Name: Shipments Shipments_Batch_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Shipments"
    ADD CONSTRAINT "Shipments_Batch_ID_fkey" FOREIGN KEY ("Batch_ID") REFERENCES commodities."Batches"("Batch_ID") ON DELETE CASCADE;


--
-- TOC entry 3190 (class 2606 OID 16530)
-- Name: Shipments Shipments_Broker_ID_fkey; Type: FK CONSTRAINT; Schema: commodities; Owner: postgres
--

ALTER TABLE ONLY commodities."Shipments"
    ADD CONSTRAINT "Shipments_Broker_ID_fkey" FOREIGN KEY ("Broker_ID") REFERENCES commodities."Brockers"("Brocker_ID") ON DELETE RESTRICT;


-- Completed on 2020-10-12 16:09:33 MSK

--
-- PostgreSQL database dump complete
--

