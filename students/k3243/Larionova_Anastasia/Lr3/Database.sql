CREATE DATABASE "PoultryFarm" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';


ALTER DATABASE "PoultryFarm"
	OWNER TO postgres;

\connect "PoultryFarm"


CREATE SCHEMA "PoultryFarm";


ALTER SCHEMA "PoultryFarm"
	OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

-- Создание таблицы "Порода"

CREATE TABLE "PoultryFarm"."Breed" (
    name text NOT NULL,
    weight_avg integer NOT NULL,
    productivity integer NOT NULL,
    number_recommended integer NOT NULL,
    diet text NOT NULL,
    "ID_breed" integer NOT NULL
);


ALTER TABLE "PoultryFarm"."Breed"
	OWNER TO postgres;

-- Создание таблицы "Клетка"

CREATE TABLE "PoultryFarm"."Cell" (
    "ID_cell" integer NOT NULL,
    number_row integer NOT NULL,
    number_tsekh integer NOT NULL,
    number_cellinrow integer NOT NULL
);


ALTER TABLE "PoultryFarm"."Cell"
	OWNER TO postgres;

-- Создание таблицы "Курица"

CREATE TABLE "PoultryFarm"."Chicken" (
    weight integer NOT NULL,
    number_tsekh integer NOT NULL,
    number_row integer NOT NULL,
    "ID_cell" integer NOT NULL,
    age integer NOT NULL,
    eggs_per_month integer NOT NULL,
    "ID_breed" integer NOT NULL,
    "ID_chicken" integer NOT NULL
);


ALTER TABLE "PoultryFarm"."Chicken"
	OWNER TO postgres;

-- Создание таблицы "Директор"

CREATE TABLE "PoultryFarm"."Director" (
    passport text NOT NULL,
    salary integer NOT NULL
);


ALTER TABLE "PoultryFarm"."Director"
	OWNER TO postgres;

-- Создание таблицы "Ряд"

CREATE TABLE "PoultryFarm"."Row" (
    number_row integer NOT NULL,
    number_tsekh integer NOT NULL,
    amount_cells integer NOT NULL
);


ALTER TABLE "PoultryFarm"."Row"
	OWNER TO postgres;

-- Создание таблицы "Цех"

CREATE TABLE "PoultryFarm"."Tsekh" (
    number_tsekh integer NOT NULL,
    amount_rows integer NOT NULL
);


ALTER TABLE "PoultryFarm"."Tsekh"
	OWNER TO postgres;

-- Создание таблицы "Работник"

CREATE TABLE "PoultryFarm"."Worker" (
    passport text NOT NULL,
    salary integer NOT NULL,
    cells "char" NOT NULL,
    "ID_worker" integer NOT NULL
);


ALTER TABLE "PoultryFarm"."Worker"
	OWNER TO postgres;

-- Заполнение таблицы "Порода"

INSERT INTO "PoultryFarm"."Breed" VALUES
('Australop', 3, 24, 17, 'Fruit', 1),
('Naked neck', 4, 21, 13, 'Vegetables', 2),
('Orpington', 4, 18, 3, 'Beans', 3),
('Silkie', 4, 19, 29, 'Corn + vegetables', 4),
('Frizzle', 4, 23, 36, 'Fruit', 5)

-- Заполнение таблицы "Клетка"

INSERT INTO "PoultryFarm"."Cell" VALUES
(1, 13, 2, 46),
(2, 11, 5, 38),
(3, 8, 2, 25),
(4, 6, 3, 14),
(5, 10, 4, 32)

-- Заполнение таблицы "Курица"

INSERT INTO "PoultryFarm"."Chicken" VALUES 
(3, 1, 12, 3, 4, 17, 2, 1),
(3, 2, 10, 3, 3, 19, 3, 2),
(3, 3, 7, 2, 3, 20, 1, 3),
(4, 1, 6, 56, 4, 24, 3, 4),
(4, 5, 15, 124, 3, 21, 2, 5)

-- Заполнение таблицы "Директор"

INSERT INTO "PoultryFarm"."Director" VALUES
('Sorokin Mikhail Dmitrievich', 60000)


-- Заполнение таблицы "Ряд"

INSERT INTO "PoultryFarm"."Row" VALUES 
(3, 5, 15),
(10, 2, 13),
(8, 3, 14),
(9, 4, 17),
(6, 5, 15)

-- Заполнение таблицы "Цех"

INSERT INTO "PoultryFarm"."Tsekh" VALUES
(1, 16),
(2, 14),
(3, 18),
(4, 17),
(5, 15)

-- Заполнение таблицы "Работник"

INSERT INTO "PoultryFarm"."Worker" VALUES
('Sidorov Valeriy Alexandrovich', 20000, '9', 1),
('Fomenko Oxana Alekseevna', 22000, '1', 2),
('Rogovaya Marina Vitalievna', 18500, '8', 3),
('Zefirov Aleksey Valerievich', 25000, '1', 4),
('Makheev Stepan Fedorovich', 23500, '1', 5)

-- Установка первичных ключей

ALTER TABLE ONLY "PoultryFarm"."Breed"
    ADD CONSTRAINT "Breed_pkey" PRIMARY KEY ("ID_breed");

ALTER TABLE ONLY "PoultryFarm"."Cell"
    ADD CONSTRAINT "Cell_pkey" PRIMARY KEY ("ID_cell");


ALTER TABLE ONLY "PoultryFarm"."Chicken"
    ADD CONSTRAINT "Chicken_pkey" PRIMARY KEY ("ID_chicken");

ALTER TABLE ONLY "PoultryFarm"."Director"
    ADD CONSTRAINT "Director_pkey" PRIMARY KEY (passport);


ALTER TABLE ONLY "PoultryFarm"."Row"
    ADD CONSTRAINT "Row_pkey" PRIMARY KEY (number_row);

ALTER TABLE ONLY "PoultryFarm"."Tsekh"
    ADD CONSTRAINT "Tsekh_pkey" PRIMARY KEY (number_tsekh);


ALTER TABLE ONLY "PoultryFarm"."Worker"
    ADD CONSTRAINT "Worker_pkey" PRIMARY KEY ("ID_worker");
    
-- Установка внешних ключей


ALTER TABLE ONLY "PoultryFarm"."Cell"
    ADD CONSTRAINT "Cell_number_row_fkey" FOREIGN KEY (number_row)
		REFERENCES "PoultryFarm"."Row"(number_row) NOT VALID;

ALTER TABLE ONLY "PoultryFarm"."Cell"
    ADD CONSTRAINT "Cell_number_tsekh_fkey" FOREIGN KEY (number_tsekh)
		REFERENCES "PoultryFarm"."Tsekh"(number_tsekh) NOT VALID;


ALTER TABLE ONLY "PoultryFarm"."Chicken"
    ADD CONSTRAINT "Chicken_ID_breed_fkey" FOREIGN KEY ("ID_breed")
		REFERENCES "PoultryFarm"."Breed"("ID_breed") NOT VALID;


ALTER TABLE ONLY "PoultryFarm"."Chicken"
    ADD CONSTRAINT "Chicken_ID_cell_fkey" FOREIGN KEY ("ID_cell")
		REFERENCES "PoultryFarm"."Cell"("ID_cell") NOT VALID;


ALTER TABLE ONLY "PoultryFarm"."Row"
    ADD CONSTRAINT "Row_number_tsekh_fkey" FOREIGN KEY (number_tsekh)
		REFERENCES "PoultryFarm"."Tsekh"(number_tsekh) NOT VALID
