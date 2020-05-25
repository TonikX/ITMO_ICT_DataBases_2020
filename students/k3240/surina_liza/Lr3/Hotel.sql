﻿--создаем схему

CREATE SCHEMA hotel;

--создаем таблицу администратора

CREATE TABLE hotel."admin"
(
    "id_admin" integer NOT NULL,
    "id_timetable" integer NOT NULL,
    "code_reservation" integer NOT NULL,
    "code_report" integer NOT NULL,
    CONSTRAINT "admin_pkey" PRIMARY KEY ("id_admin"),
    CONSTRAINT "CODEreport" FOREIGN KEY ("code_report")
        REFERENCES hotel."report" ("code_report") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "CODEreserv" FOREIGN KEY ("code_reservation")
        REFERENCES hotel.reserv (code_reservation) MATCH SIMPLE
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
    "passport number" integer NOT NULL,
    CONSTRAINT "client_pkey" PRIMARY KEY ("id_client")
);

--создаем таблицу номеров гостиницы

CREATE TABLE hotel."number"
(
    "number_code" integer NOT NULL,
    "type_number" integer NOT NULL,
    "telephone" integer NOT NULL,
    "floor" integer NOT NULL,
    CONSTRAINT "number_pkey" PRIMARY KEY ("number_code"),
    CONSTRAINT "type" FOREIGN KEY ("type_number")
        REFERENCES hotel."type" ("type_number") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу отчетов гостиницы

CREATE TABLE hotel."report"
(
    "code_report" integer NOT NULL,
    "number_code" integer NOT NULL,
    "total" integer NOT NULL,
    CONSTRAINT "report_pkey" PRIMARY KEY ("code_report"),
    CONSTRAINT "CODEnumber" FOREIGN KEY ("number_code")
        REFERENCES hotel."number" ("number_code") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--создаем таблицу заказов гостиницы

CREATE TABLE hotel."reserv"
(
    "code_reservation" integer NOT NULL,
    "id_client" integer NOT NULL,
    "input" integer NOT NULL,
    "output" character(40) COLLATE pg_catalog."default" NOT NULL,
    "number_code" character(40) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "reserv_pkey" PRIMARY KEY ("code_reservation"),
    CONSTRAINT "CODEnumber" FOREIGN KEY ("number_code")
        REFERENCES hotel."number" ("number_code") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "IDclient" FOREIGN KEY ("id_client")
        REFERENCES hotel."client" ("id_client") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
    
);

--создаем таблицу персонала 

CREATE TABLE hotel."service"
(
    "id_service" integer NOT NULL,
    "full name" character(40) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "service_pkey" PRIMARY KEY ("id_service")
);

--создаем таблицу расписания персонала

CREATE TABLE hotel."timetable"
(
    "id_timetable" integer NOT NULL,
    "number_code" integer NOT NULL,
    "id_service" integer NOT NULL,
    "weekday" character(40) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "timetable_pkey" PRIMARY KEY ("id_timetable"),
    CONSTRAINT "CODEnumber" FOREIGN KEY ("number_code")
        REFERENCES hotel."number" ("number_code") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "IDservice" FOREIGN KEY ("id_service")
        REFERENCES hotel."service" ("id_service") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    
);

--создаем таблицу с типом номеров

CREATE TABLE hotel."type"
(
    "type_number" integer NOT NULL,
    "price" integer NOT NULL,
    CONSTRAINT "type_pkey" PRIMARY KEY ("type_number")
);


--заполняем таблицу тип номера

INSERT INTO hotel."type" VALUES (123, 14656);
INSERT INTO hotel."type" VALUES (234, 24351);
INSERT INTO hotel."type" VALUES (345, 24516);
INSERT INTO hotel."type" VALUES (456, 52612);
INSERT INTO hotel."type" VALUES (567, 36738);

--заполняем таблицу расписания персонала

INSERT INTO hotel."timetable" VALUES (10001, 1234456, 23, 'mondey');
INSERT INTO hotel."timetable" VALUES (20002, 4893201, 12, 'friday');
INSERT INTO hotel."timetable" VALUES (30003, 0985843, 34, 'wednesday');
INSERT INTO hotel."timetable" VALUES (40004, 1453112, 53, 'saturday');
INSERT INTO hotel."timetable" VALUES (50005, 3894584, 32, 'monday');

--заполняем таблицу заказов гостиницы

INSERT INTO hotel."reserv" VALUES (1234456, 12342098, '12.06.2020', '25.06.2020', 34543);
INSERT INTO hotel."reserv" VALUES (4893201, 34728938, '22.06.2020', '24.06.2020', 15109);
INSERT INTO hotel."reserv" VALUES (0985843, 84902984, '02.06.2020', '12.06.2020', 54351);
INSERT INTO hotel."reserv" VALUES (1453112, 63648928, '19.06.2020', '23.06.2020', 12344);
INSERT INTO hotel."reserv" VALUES (3894584, 49748821, '10.06.2020', '14.06.2020', 64215);

--заполняем таблицу отчета работы гостиницы

INSERT INTO hotel."report" VALUES (3454, 34543, 1234654);
INSERT INTO hotel."report" VALUES (1234, 12344, 3213454);
INSERT INTO hotel."report" VALUES (5435, 54351, 8465362);
INSERT INTO hotel."report" VALUES (6421, 64215, 4476578);
INSERT INTO hotel."report" VALUES (5109, 15109, 4382000);

--заполняем таблицу номеров гостиницы

INSERT INTO hotel."number" VALUES (34543, 123, 100100, 3);
INSERT INTO hotel."number" VALUES (12344, 234, 909090, 4);
INSERT INTO hotel."number" VALUES (54351, 345, 305305, 12);
INSERT INTO hotel."number" VALUES (64215, 456, 102102, 23);
INSERT INTO hotel."number" VALUES (15109, 567, 505050, 6);

--заполняем таблицу с клиентами гостиницы

INSERT INTO hotel."client" VALUES (12342098, 'Ivan Ivanov', 'Moscow', 2345);
INSERT INTO hotel."client" VALUES (34728938, 'Anna Serd', 'Moscow', 3562);
INSERT INTO hotel."client" VALUES (84902984, 'Peter Seruf', 'St.Peterburg', 2545);
INSERT INTO hotel."client" VALUES (63648928, 'Alex Ford', 'Riga', 4567);
INSERT INTO hotel."client" VALUES (49748821, 'Rita Sadirt', 'Moscow', 1245);

--заполняем таблицу о персонале гостинице

INSERT INTO hotel."service" VALUES (12, 'Ursula Salmon');
INSERT INTO hotel."service" VALUES (23, 'Lemon Frash');
INSERT INTO hotel."service" VALUES (34, 'Willy Wonka');
INSERT INTO hotel."service" VALUES (53, 'Fridrich Sopawe');
INSERT INTO hotel."service" VALUES (32, 'Hope Miklson');

--заполняем таблицу о работе администратора

INSERT INTO hotel."admin" VALUES (101, 10001, 12342098, 3454);
INSERT INTO hotel."admin" VALUES (102, 20002, 34728938, 1234);
INSERT INTO hotel."admin" VALUES (103, 30003, 84902984, 5435);
INSERT INTO hotel."admin" VALUES (104, 40004, 63648928, 6421);
INSERT INTO hotel."admin" VALUES (105, 50005, 49748821, 5109);
