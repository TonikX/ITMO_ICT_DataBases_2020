CREATE SCHEMA airport;

ALTER SCHEMA airport OWNER TO postgres;

-- Создаём таблицу "работник"

CREATE TABLE airport.rabotnik (
    kod_rabotnika integer NOT NULL,
    fio text NOT NULL,
    uroven_obrazovania text NOT NULL,
    vozrast integer NOT NULL,
    stazh_raboty integer NOT NULL,
    pasportnye_dannye text
);

ALTER TABLE airport.rabotnik OWNER TO postgres;

-- Создаём таблицу "эпипаж"

CREATE TABLE airport.ekipazh (
    kod_ekipazha integer NOT NULL,
    nazvanie text
);

ALTER TABLE airport.ekipazh OWNER TO postgres;

-- Создаём таблицу "самолёт"

CREATE TABLE airport.samolet (
    pozyvnoi text NOT NULL,
    tip text NOT NULL,
    nomer_modeli integer NOT NULL,
    chislo_mest integer NOT NULL,
    skorost_poleta integer NOT NULL,
    aviacompany text
);

ALTER TABLE airport.samolet OWNER TO postgres;

-- Создаём таблицу "транзит"

CREATE TABLE airport.tranzit (
    kod_tranzita integer NOT NULL,
    punkt_posadki text NOT NULL
);

ALTER TABLE airport.tranzit OWNER TO postgres;

-- Создаём таблицу "рейс"

CREATE TABLE airport.reys (
    nomer_reysa integer NOT NULL,
    rasstoyanie_do_punkta_naznachenia integer NOT NULL,
    punkt_vyleta text NOT NULL,
    punkt_prileta text NOT NULL,
    kod_tranzita integer
);

ALTER TABLE airport.reys OWNER TO postgres;

-- Создаём таблицу "ремонт"

CREATE TABLE airport.remont (
    kod_remonta integer NOT NULL,
    pozyvnoi text NOT NULL,
    polomka text
);

ALTER TABLE airport.remont OWNER TO postgres;

-- Создаём таблицу "авиакомпания"

CREATE TABLE airport.aviacompany (
    kod_rabotnika integer NOT NULL,
    kod_ekipazha integer NOT NULL,
    zanimaemaya_dolzhnost text
);

ALTER TABLE airport.aviacompany OWNER TO postgres;

-- Создаём таблицу "допуск"

CREATE TABLE airport.dopusk (
    nomer_reysa integer NOT NULL,
    kod_ekipazha integer NOT NULL,
    nalichie_dopuska boolean NOT NULL
);

ALTER TABLE airport.dopusk OWNER TO postgres;

-- Создаём таблицу "разрешение"

CREATE TABLE airport.razrechenie (
    pozyvnoi text NOT NULL,
    kod_ekipazha integer NOT NULL,
    nalichie_razrecheniya boolean NOT NULL
);

ALTER TABLE airport.razrechenie OWNER TO postgres;

-- Создаём таблицу "полёт"

CREATE TABLE airport.polet (
    kod_poleta integer NOT NULL,
    nomer_reysa integer NOT NULL,
    pozyvnoi text NOT NULL,
    data_vyleta date NOT NULL,
    vremya_vyleta time without time zone NOT NULL,
    data_prileta date NOT NULL,
    vremya_prileta time without time zone NOT NULL,
    kolichestvo_prodannych_biletov integer NOT NULL,
    kolichestvo_soverchennych_reysov integer NOT NULL,
    data_tranzitnoy_posadki date,
    vremya_tranzitnoy_posadki time without time zone,
    data_vyleta_iz_tranzita date,
    vremya_vyleta_iz_tranzita time without time zone
);

ALTER TABLE airport.polet OWNER TO postgres;

-- Заполняем таблицу "работник"

INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(10, 'Fomin M.D.', 'Vysshee', 29, 7, 4019 657893);
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(11, 'Ivanov A.P.', 'Vysshee', 38, 16, 4115 893456);
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(12, 'Sidorov D.E.', 'Vysshee', 22, 2, 4018 543897);
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(13, 'Lodyshev A.U.', 'Vysshee', 63, 44, 4010 565656);
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(14, 'Svintsov K.T.', 'Vysshee', 47, 23, 4117 934256);
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(15, 'Mishina S.E.', 'Srednee', 19, 1, 4014 347855);
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(16, ‘Mamontov M.E.', 'Vysshee', 24, 5, ‘4016 548575’);
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(17, 'Yudina T.L.', 'Srednee', 20, 3, '4013 598544');
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(18, 'Ptashenchuk P.I.', 'Srednee', 19, 1, '4714 891065');
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(19, 'Pivovarov Y.M.', 'Vysshee', 26, 4, '4914 134502');
INSERT INTO airport.rabotnik (kod_rabotnika, fio, uroven_obrazovania, vozrast, stazh_raboty, pasportnye_dannye) VALUES 
(20, 'Lavandysh Z.H.', 'Vysshee', 51, 24, '4510 656082');

-- Заполняем таблицу "экипаж"

INSERT INTO airport.ekipazh (kod_ekipazha, nazvanie) VALUES 
(120, null);
INSERT INTO airport.ekipazh (kod_ekipazha, nazvanie) VALUES 
(121, null);
INSERT INTO airport.ekipazh (kod_ekipazha, nazvanie) VALUES 
(122, null);
INSERT INTO airport.ekipazh (kod_ekipazha, nazvanie) VALUES 
(123, 'Ushastyi');
INSERT INTO airport.ekipazh (kod_ekipazha, nazvanie) VALUES 
(124, null);

-- Заполняем таблицу "самолёт"

INSERT INTO airport.samolet (pozyvnoi, tip, nomer_modeli, chislo_mest, skorost_poleta, aviacompany) VALUES 
('Myagkiy-7', 'Airbus', 320, 146, 830, 'Aeroflot');
INSERT INTO airport.samolet (pozyvnoi, tip, nomer_modeli, chislo_mest, skorost_poleta, aviacompany) VALUES 
('Tyazheliy-9', 'Boeing', 737, 178, 840, 'Aeroflot');
INSERT INTO airport.samolet (pozyvnoi, tip, nomer_modeli, chislo_mest, skorost_poleta, aviacompany) VALUES 
('B-Tyazheliy', 'Boeing', 773, 550, 950, 'British Airways');
INSERT INTO airport.samolet (pozyvnoi, tip, nomer_modeli, chislo_mest, skorost_poleta, aviacompany) VALUES 
('Tyazheliy-1', 'Airbus', 359, 314, 945, 'Lufthansa');
INSERT INTO airport.samolet (pozyvnoi, tip, nomer_modeli, chislo_mest, skorost_poleta, aviacompany) VALUES
('A-Tyazheliy', 'Boeing', 738, 190, 850, 'S7');

-- Заполняем таблицу "транзит"

INSERT INTO airport.tranzit (kod_tranzita, punkt_posadki) VALUES
(60, 'Heathrow');
INSERT INTO airport.tranzit (kod_tranzita, punkt_posadki) VALUES
(56, 'Pulkovo');
INSERT INTO airport.tranzit (kod_tranzita, punkt_posadki) VALUES
(57, 'Sheremetievo');
INSERT INTO airport.tranzit (kod_tranzita, punkt_posadki) VALUES
(58, 'Athens_main_airport');
INSERT INTO airport.tranzit (kod_tranzita, punkt_posadki) VALUES
(59, 'Pulkovo');

-- Заполняем таблицу "рейс"

INSERT INTO airport.reys (nomer_reysa, rasstoyanie_do_punkta_naznachenia, punkt_vyleta, punkt_prileta, kod_tranzita) VALUES
(372, 725, 'Pulkovo', 'Sheremetievo', null);
INSERT INTO airport.reys (nomer_reysa, rasstoyanie_do_punkta_naznachenia, punkt_vyleta, punkt_prileta, kod_tranzita) VALUES
(963, 409, 'Vnukovo', 'Strigino', null);
INSERT INTO airport.reys (nomer_reysa, rasstoyanie_do_punkta_naznachenia, punkt_vyleta, punkt_prileta, kod_tranzita) VALUES
(404, 34, 'Domodedovo', 'Vnukovo', null);
INSERT INTO airport.reys (nomer_reysa, rasstoyanie_do_punkta_naznachenia, punkt_vyleta, punkt_prileta, kod_tranzita) VALUES
(109, 5330, 'Pulkovo', 'Lissabon_main_airport', 58);
INSERT INTO airport.reys (nomer_reysa, rasstoyanie_do_punkta_naznachenia, punkt_vyleta, punkt_prileta, kod_tranzita) VALUES
(551, 305, 'Frankfurt_international_airport', 'Zurich_main_airport', null);

-- Заполняем таблицу "ремонт"

INSERT INTO airport.remont (kod_remonta, pozyvnoi, polomka) VALUES
(1, 'A-Tyazheliy', 'Nasos');
INSERT INTO airport.remont (kod_remonta, pozyvnoi, polomka) VALUES
(2, 'Myagkiy-7', 'Zadniya_dver');
INSERT INTO airport.remont (kod_remonta, pozyvnoi, polomka) VALUES
(3, 'Tyazheliy-9', 'Chvostovoe_operenie');
INSERT INTO airport.remont (kod_remonta, pozyvnoi, polomka) VALUES
(4, 'Tyazheliy-9', 'Shassi'); 
INSERT INTO airport.remont (kod_remonta, pozyvnoi, polomka) VALUES
(5, 'A-Tyazheliy', 'Dvertsa_tualeta');

-- Заполняем таблицу "авиакомпания"

INSERT INTO airport.aviacompany (kod_rabotnika, kod_ekipazha, zanimaemaya_dolzhnost) VALUES
(10, 120, 'Shturman');
INSERT INTO airport.aviacompany (kod_rabotnika, kod_ekipazha, zanimaemaya_dolzhnost) VALUES
(11, 120, 'Komandir');
INSERT INTO airport.aviacompany (kod_rabotnika, kod_ekipazha, zanimaemaya_dolzhnost) VALUES
(14, 120, 'Vtoroy_pilot');
INSERT INTO airport.aviacompany (kod_rabotnika, kod_ekipazha, zanimaemaya_dolzhnost) VALUES
(15, 120, 'Styardessa');
INSERT INTO airport.aviacompany (kod_rabotnika, kod_ekipazha, zanimaemaya_dolzhnost) VALUES
(16, 120, 'Styard');

-- Заполняем таблицу "допуск"

INSERT INTO airport.dopusk (nomer_reysa, kod_ekipazha, nalichie_dopuska) VALUES
(372, 120, true);
INSERT INTO airport.dopusk (nomer_reysa, kod_ekipazha, nalichie_dopuska) VALUES
(963 121, true);
INSERT INTO airport.dopusk (nomer_reysa, kod_ekipazha, nalichie_dopuska) VALUES
(404, 122, true);
INSERT INTO airport.dopusk (nomer_reysa, kod_ekipazha, nalichie_dopuska) VALUES
(109, 123, false);
INSERT INTO airport.dopusk (nomer_reysa, kod_ekipazha, nalichie_dopuska) VALUES
(551, 124, false);
INSERT INTO airport.dopusk (nomer_reysa, kod_ekipazha, nalichie_dopuska) VALUES
(109, 121, true);

-- Заполняем таблицу "разрешение"

INSERT INTO airport.razrechenie (pozyvnoi, kod_ekipazha, nalichie_razrecheniya) VALUES
('A-Tyazheliy', 120, true);
INSERT INTO airport.razrechenie (pozyvnoi, kod_ekipazha, nalichie_razrecheniya) VALUES
('Myagkiy-7', 121, true);
INSERT INTO airport.razrechenie (pozyvnoi, kod_ekipazha, nalichie_razrecheniya) VALUES
('B-Tyazheliy', 123, false);
INSERT INTO airport.razrechenie (pozyvnoi, kod_ekipazha, nalichie_razrecheniya) VALUES
('Tyazheliy-1', 124, false);
INSERT INTO airport.razrechenie (pozyvnoi, kod_ekipazha, nalichie_razrecheniya) VALUES
('Tyazheliy-9', 122, true);

-- Заполняем таблицу "полёт"

INSERT INTO airport.polet (kod_poleta, nomer_reysa, pozyvnoi, data_vyleta, vremya_vyleta, data_prileta, vremya_prileta, kolichestvo_prodannych_biletov, kolichestvo_soverchennych_reysov, data_tranzitnoy_posadki, vremya_tranzitnoy_posadki, data_vyleta_iz_tranzita, vremya_vyleta_iz_tranzita) VALUES
(1556, 372, 'A-Tyazheliy', '14.03.2020', '10:42:57', '14.03.2020', '12:06:17', 167, 104, null, null, null, null);
INSERT INTO airport.polet (kod_poleta, nomer_reysa, pozyvnoi, data_vyleta, vremya_vyleta, data_prileta, vremya_prileta, kolichestvo_prodannych_biletov, kolichestvo_soverchennych_reysov, data_tranzitnoy_posadki, vremya_tranzitnoy_posadki, data_vyleta_iz_tranzita, vremya_vyleta_iz_tranzita) VALUES
(1557, 963, 'Myagkiy-7', '15.03.2020', '15:56:41', '15.03.2020', '16:56:13', 137, 18, null, null, null, null);
INSERT INTO airport.polet (kod_poleta, nomer_reysa, pozyvnoi, data_vyleta, vremya_vyleta, data_prileta, vremya_prileta, kolichestvo_prodannych_biletov, kolichestvo_soverchennych_reysov, data_tranzitnoy_posadki, vremya_tranzitnoy_posadki, data_vyleta_iz_tranzita, vremya_vyleta_iz_tranzita) VALUES
(1559, 963, 'Myagkiy-7', '16.03.2020', '23:18:18', '17.03.2020', '00:16:29', 124, 19, null, null, null, null);
INSERT INTO airport.polet (kod_poleta, nomer_reysa, pozyvnoi, data_vyleta, vremya_vyleta, data_prileta, vremya_prileta, kolichestvo_prodannych_biletov, kolichestvo_soverchennych_reysov, data_tranzitnoy_posadki, vremya_tranzitnoy_posadki, data_vyleta_iz_tranzita, vremya_vyleta_iz_tranzita) VALUES
(1560, 109, 'Myagkiy-7', '21.03.2020', '23:56:37', '23.03.2020', '01:45:27', 144, 27, '22.03.2020', '03:46:37', '22.03.2020', '21:42:19');
INSERT INTO airport.polet (kod_poleta, nomer_reysa, pozyvnoi, data_vyleta, vremya_vyleta, data_prileta, vremya_prileta, kolichestvo_prodannych_biletov, kolichestvo_soverchennych_reysov, data_tranzitnoy_posadki, vremya_tranzitnoy_posadki, data_vyleta_iz_tranzita, vremya_vyleta_iz_tranzita) VALUES
(1561, 404, 'Tyazheliy-9', '19.03.2020', '19:00:01', '19.03.2020', '19:13:38', 132, 98, null, null, null, null);

-- Задаём первичные ключи

ALTER TABLE ONLY airport.aviacompany
    ADD CONSTRAINT aviacompany_pkey PRIMARY KEY (kod_rabotnika, kod_ekipazha);

ALTER TABLE ONLY airport.dopusk
    ADD CONSTRAINT dopusk_pkey PRIMARY KEY (nomer_reysa, kod_ekipazha);
    
ALTER TABLE ONLY airport.ekipazh
    ADD CONSTRAINT ekipazh_pkey PRIMARY KEY (kod_ekipazha);
    
ALTER TABLE ONLY airport.polet
    ADD CONSTRAINT polet_pkey PRIMARY KEY (pozyvnoi, nomer_reysa, kod_poleta);
    
ALTER TABLE ONLY airport.rabotnik
    ADD CONSTRAINT rabotnik_pkey PRIMARY KEY (kod_rabotnika);
  
ALTER TABLE ONLY airport.razrechenie
    ADD CONSTRAINT razrechenie_pkey PRIMARY KEY (pozyvnoi, kod_ekipazha);
    
ALTER TABLE ONLY airport.remont
    ADD CONSTRAINT remont_pkey PRIMARY KEY (kod_remonta, pozyvnoi);

ALTER TABLE ONLY airport.reys
    ADD CONSTRAINT reys_pkey PRIMARY KEY (nomer_reysa);

ALTER TABLE ONLY airport.samolet
    ADD CONSTRAINT samolet_pkey PRIMARY KEY (pozyvnoi);
 
ALTER TABLE ONLY airport.tranzit
    ADD CONSTRAINT tranzit_pkey PRIMARY KEY (kod_tranzita);

-- Задаём ограничения

ALTER TABLE airport.rabotnik
    ADD CONSTRAINT vozrast CHECK ((vozrast < 100)) NOT VALID; 
 
ALTER TABLE airport.rabotnik
    ADD CONSTRAINT stazh_raboty CHECK ((stazh_raboty < 100)) NOT VALID; 
   
ALTER TABLE airport.reys
    ADD CONSTRAINT rasstoyanie_do_punkta_naznachenia CHECK ((rasstoyanie_do_punkta_naznachenia < 20000)) NOT VALID;
    
-- Задаём внешние ключи

ALTER TABLE ONLY airport.aviacompany
    ADD CONSTRAINT kod_ekipazha FOREIGN KEY (kod_ekipazha) REFERENCES airport.ekipazh(kod_ekipazha) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
    
ALTER TABLE ONLY airport.dopusk
    ADD CONSTRAINT kod_ekipazha FOREIGN KEY (kod_ekipazha) REFERENCES airport.ekipazh(kod_ekipazha) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
    
ALTER TABLE ONLY airport.razrechenie
    ADD CONSTRAINT kod_ekipazha FOREIGN KEY (kod_ekipazha) REFERENCES airport.ekipazh(kod_ekipazha) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
    
ALTER TABLE ONLY airport.aviacompany
    ADD CONSTRAINT kod_rabotnika FOREIGN KEY (kod_rabotnika) REFERENCES airport.rabotnik(kod_rabotnika) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
  
ALTER TABLE ONLY airport.reys
    ADD CONSTRAINT kod_tranzita FOREIGN KEY (kod_tranzita) REFERENCES airport.tranzit(kod_tranzita) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
  
ALTER TABLE ONLY airport.polet
    ADD CONSTRAINT nomer_reysa FOREIGN KEY (nomer_reysa) REFERENCES airport.reys(nomer_reysa) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY airport.remont
    ADD CONSTRAINT pozyvnoi FOREIGN KEY (pozyvnoi) REFERENCES airport.samolet(pozyvnoi) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY airport.polet
    ADD CONSTRAINT pozyvnoi FOREIGN KEY (pozyvnoi) REFERENCES airport.samolet(pozyvnoi) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY airport.razrechenie
    ADD CONSTRAINT pozyvnoi FOREIGN KEY (pozyvnoi) REFERENCES airport.samolet(pozyvnoi) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY airport.dopusk
    ADD CONSTRAINT nomer_reysa FOREIGN KEY (nomer_reysa) REFERENCES airport.reys(nomer_reysa) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
    
