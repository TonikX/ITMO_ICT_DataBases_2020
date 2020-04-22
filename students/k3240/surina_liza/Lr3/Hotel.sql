--создаем схему

CREATE SCHEMA hotel;

--создаем таблицу администратора

CREATE TABLE hotel."admin"
(
    "id_admin" integer NOT NULL,
    "id_client" integer NOT NULL,
    "id_timetable" integer NOT NULL,
    "code_report" integer NOT NULL,
    CONSTRAINT "admin_pkey" PRIMARY KEY ("id_admin"),
    CONSTRAINT "CODEreport" FOREIGN KEY ("code_report")
        REFERENCES hotel."report" ("code_report") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "IDclient" FOREIGN KEY ("id_client")
        REFERENCES hotel.client (id_client) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "IDtimetable" FOREIGN KEY ("id_timetable")
        REFERENCES hotel."timetable" ("id_timetable") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу клиента

CREATE TABLE hotel."client"
(
    "id_client" integer NOT NULL,
    "full name" character(100) COLLATE pg_catalog."default" NOT NULL,
    "city" character(100) COLLATE pg_catalog."default" NOT NULL,
    "date of settlement" character(40) COLLATE pg_catalog."default" NOT NULL,
    "passport number" integer NOT NULL,
    "number_code" integer NOT NULL,
    CONSTRAINT "client_pkey" PRIMARY KEY ("id_client"),
    CONSTRAINT "nomber" FOREIGN KEY ("number_code")
        REFERENCES hotel."number" ("number_code") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу номеров гостиницы

CREATE TABLE hotel."number"
(
    "number_code" integer NOT NULL,
    "code_revenue" integer NOT NULL,
    "quantity" integer NOT NULL,
    "type_number" integer NOT NULL,
    "telephone" integer NOT NULL,
    "cost per day" integer NOT NULL,
    CONSTRAINT "number_pkey" PRIMARY KEY ("number_code"),
    CONSTRAINT "revenue" FOREIGN KEY ("code_revenue")
        REFERENCES hotel."revenue" ("code_revenue") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "type" FOREIGN KEY ("type_number")
        REFERENCES hotel."type" ("type_number") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу отчетов гостиницы

CREATE TABLE hotel."report"
(
    "code_report" integer NOT NULL,
    "code_revenue" integer NOT NULL,
    CONSTRAINT "report_pkey" PRIMARY KEY ("code_report"),
    CONSTRAINT "revenue" FOREIGN KEY ("code_revenue")
        REFERENCES hotel."revenue" ("code_revenue") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу дохода гостиницы

CREATE TABLE hotel."revenue"
(
    "code_revenue" integer NOT NULL,
    "revenue for number" integer NOT NULL,
    "total" integer NOT NULL,
    CONSTRAINT "revenue_pkey" PRIMARY KEY ("code_revenue")
);

--создаем таблицу персонала 

CREATE TABLE hotel."service"
(
    "id_service" integer NOT NULL,
    "id_timetable" integer NOT NULL,
    "full name" character(40) COLLATE pg_catalog."default" NOT NULL,
    "id_number" integer NOT NULL,
    CONSTRAINT "service_pkey" PRIMARY KEY ("id_service"),
    CONSTRAINT "IDnumber" FOREIGN KEY ("id_number")
        REFERENCES hotel."number" ("number_code") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "timetable" FOREIGN KEY ("id_timetable")
        REFERENCES hotel."timetable" ("id_timetable") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу расписания персонала

CREATE TABLE hotel."timetable"
(
    "id_timetable" integer NOT NULL,
    "floor" integer NOT NULL,
    "weekday" character(40) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "timetable_pkey" PRIMARY KEY ("id_timetable")
);

--создаем таблицу с типом номеров

CREATE TABLE hotel."type"
(
    "type_number" integer NOT NULL,
    "unary" character(3) COLLATE pg_catalog."default" NOT NULL,
    "double" character(3) COLLATE pg_catalog."default" NOT NULL,
    "triple" character(3) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "type_pkey" PRIMARY KEY ("type_number")
);


--заполняем таблицу тип номера

INSERT INTO hotel."type" VALUES (123, 'yes', 'no', 'no');
INSERT INTO hotel."type" VALUES (234, 'no', 'yes', 'no');
INSERT INTO hotel."type" VALUES (345, 'yes', 'no', 'no');
INSERT INTO hotel."type" VALUES (456, 'no', 'no', 'yes');
INSERT INTO hotel."type" VALUES (567, 'no', 'yes', 'no');

--заполняем таблицу расписания персонала

INSERT INTO hotel."timetable" VALUES (10001, 3, 'mondey');
INSERT INTO hotel."timetable" VALUES (20002, 12, 'friday');
INSERT INTO hotel."timetable" VALUES (30003, 20, 'wednesday');
INSERT INTO hotel."timetable" VALUES (40004, 5, 'saturday');
INSERT INTO hotel."timetable" VALUES (50005, 15, 'monday');

--заполняем таблицу дохода гостиницы

INSERT INTO hotel."revenue" VALUES (1234456, 750, 1500000);
INSERT INTO hotel."revenue" VALUES (4893201, 1250, 1500000);
INSERT INTO hotel."revenue" VALUES (0985843, 880, 1500000);
INSERT INTO hotel."revenue" VALUES (1453112, 500, 1500000);
INSERT INTO hotel."revenue" VALUES (3894584, 3750, 1500000);

--заполняем таблицу отчета работы гостиницы

INSERT INTO hotel."report" VALUES (3454, 1234456);
INSERT INTO hotel."report" VALUES (1234, 4893201);
INSERT INTO hotel."report" VALUES (5435, 0985843);
INSERT INTO hotel."report" VALUES (6421, 1453112);
INSERT INTO hotel."report" VALUES (5109, 3894584);

--заполняем таблицу номеров гостиницы

INSERT INTO hotel."number" VALUES (34543, 1234456, 45, 123, 100100, 1350);
INSERT INTO hotel."number" VALUES (12344, 4893201, 23, 234, 909090, 1456);
INSERT INTO hotel."number" VALUES (54351, 0985843, 56, 345, 305305, 1200);
INSERT INTO hotel."number" VALUES (64215, 1453112, 157, 456, 102102, 2344);
INSERT INTO hotel."number" VALUES (15109, 3894584, 53, 567, 505050, 1268);

--заполняем таблицу с клиентами гостиницы

INSERT INTO hotel."client" VALUES (12342098, 'Ivan Ivanov', 'Moscow', '12.06.2020', 2345, 34543);
INSERT INTO hotel."client" VALUES (34728938, 'Anna Serd', 'Moscow', '22.06.2020', 3562, 12344);
INSERT INTO hotel."client" VALUES (84902984, 'Peter Seruf', 'St.Peterburg', '02.06.2020', 2545, 54351);
INSERT INTO hotel."client" VALUES (63648928, 'Alex Ford', 'Riga', '19.06.2020', 4567, 64215);
INSERT INTO hotel."client" VALUES (49748821, 'Rita Sadirt', 'Moscow', '10.06.2020', 1245, 15109);

--заполняем таблицу о персонале гостинице

INSERT INTO hotel."service" VALUES (12, 10001, 'Ursula Salmon', 64215);
INSERT INTO hotel."service" VALUES (23, 20002, 'Lemon Frash', 15109);
INSERT INTO hotel."service" VALUES (34, 30003, 'Willy Wonka', 34543);
INSERT INTO hotel."service" VALUES (53, 40004, 'Fridrich Sopawe', 54351);
INSERT INTO hotel."service" VALUES (32, 50005, 'Hope Miklson', 12344);

--заполняем таблицу о работе администратора

INSERT INTO hotel."admin" VALUES (101, 12342098, 10001, 3454);
INSERT INTO hotel."admin" VALUES (102, 34728938, 20002, 1234);
INSERT INTO hotel."admin" VALUES (103, 84902984, 30003, 5435);
INSERT INTO hotel."admin" VALUES (104, 63648928, 40004, 6421);
INSERT INTO hotel."admin" VALUES (105, 49748821, 50005, 5109);
