CREATE SCHEMA airport;

ALTER SCHEMA airport OWNER TO postgres;

-- Creating a table "worker"

CREATE TABLE airport.worker (
    id_worker integer NOT NULL,
    id_plane integer NOT NULL,
    id_crew integer NOT NULL,
    name_company varchar(100) NOT NULL,
    contacts_worker varchar(100) NOT NULL,
    name_worker text NOT NULL,
    education varchar(100) NOT NULL,
    age integer NOT NULL,
    experience integer NOT NULL,
    passport integer NOT NULL
);

ALTER TABLE airport.worker OWNER TO postgres;

-- Creating a table "company"

CREATE TABLE airport.company (
    id_plane integer NOT NULL,
    name_company varchar(100) NOT NULL
);

ALTER TABLE airport.company OWNER TO postgres;

-- Creating a table "plane"

CREATE TABLE airport.plane (
    id_plane integer NOT NULL,
    type varchar(30) NOT NULL,
    number_of_seats integer NOT NULL,
    speed integer NOT NULL,
    airline text NOT NULL
);

ALTER TABLE airport.plane OWNER TO postgres;

-- Creating a table "repair"

CREATE TABLE airport.repair (
    id_repair integer NOT NULL,
    id_plane integer NOT NULL,
    issues varchar(900) 
);

ALTER TABLE airport.repair OWNER TO postgres;

-- Creating a table "voyage"

CREATE TABLE airport.voyage (
    id_voyage integer NOT NULL,
    id_license integer NOT NULL,
    id_crew integer NOT NULL,
    id_plane integer NOT NULL,
    id_flight integer NOT NULL,
    time_on_borad time NOT NULL,
    date_departure datetime NOT NULL,
    date_arrival datetime NOT NULL,
    number_of_sold_tickets integer NOT NULL
);

ALTER TABLE airport.voyage OWNER TO postgres;

-- Creating a table "flight"

CREATE TABLE airport.flight (
    id_flight integer NOT NULL,
    departure_point text NOT NULL,
    arrival_point text NOT NULL,
    id_transit integer,
    distance integer NOT NULL
);

ALTER TABLE airport.flight OWNER TO postgres;

-- Creating a table "transit"

CREATE TABLE airport.transit (
    id_transit integer NOT NULL,
    date_departure_transit datetime NOT NULL,
    date_arrival_transit datetime NOT NULL,
    transit_points text NOT NULL
);

ALTER TABLE airport.transit OWNER TO postgres;

-- Creating a table "license"

CREATE TABLE airport.license (
    id_license integer NOT NULL,
    id_crew integer NOT NULL,
    license_existence boolean NOT NULL
);

ALTER TABLE airport.license OWNER TO postgres;

-- Creating a table "crew"

CREATE TABLE airport.crew (
    id_crew integer NOT NULL,
    commander varchar(100) NOT NULL,
    second_pilot varchar(100) NOT NULL,
    navigator varchar(100) NOT NULL,
    stewards varchar(100) NOT NULL
);

ALTER TABLE airport.crew OWNER TO postgres;

-- Filling in a table "worker"

INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(1, 1251, 141, 'First company', '88001111111' 'First F.F.', 'Bachelor degree', 41, 11, 1111111111);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(2, 1252, 142, 'Second company', '88002222222' 'Second S.S.', 'Master degree', 42, 21, 2222222222);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(3, 1253, 143, 'First company', '88003333333' 'Third T.T.', 'Bachelor degree', 43, 14, 3333333333);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(4, 1254, 144, 'Third company', '88004444444' 'Fourth F.F.', 'Bachelor degree', 44, 16, 4444444444);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(5, 1255, 145, 'Fourth company', '88005555555' 'Fifth F.F.', 'Bachelor degree', 45, 22, 5555555555);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(6, 1251, 141, 'First company', '88006666666' 'Sixth S.S.', 'Master degree', 46, 17, 6666666666);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(7, 1252, 142, 'Fourth company', '88007777777' 'Seventh S.S.', 'Bachelor degree', 47, 14, 7777777777);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(8, 1253, 143, 'Third company', '88008888888' 'Eighth E.E.', 'Master degree', 48, 8, 8888888888);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(9, 1254, 144, 'Second company', '88009999999' 'Ninth N.N.', 'Master degree', 49, 9, 9999999999);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(10, 1255, 145, 'First company', '88001010101' 'Tenth T.T.', 'Bachelor degree', 50, 10, 1010101010);
INSERT INTO airport.worker (id_worker, id_plane, id_crew, name_company, contacts_worker, name_worker, education, age, experience, passport) VALUES 
(11, 1251, 141, 'Third company', '88001212121' 'Eleventh E.E.', 'Bachelor degree', 51, 11, 1212121212);

-- Filling in a table "company"

INSERT INTO airport.company (id_plane, name_company) VALUES (1251, 'First company');
INSERT INTO airport.company (id_plane, name_company) VALUES (1252, 'Second company');
INSERT INTO airport.company (id_plane, name_company) VALUES (1253, 'Third company');
INSERT INTO airport.company (id_plane, name_company) VALUES (1254, 'Fourth company');
INSERT INTO airport.company (id_plane, name_company) VALUES (1257, 'Fifth company');

-- Filling in a table "plane"

INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1251, 'jet aircraft', 210, 800, 'First airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1252, 'fixed-wing', 215, 830, 'Second airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1253, 'fixed-wing', 217, 870, 'Third airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1254, 'jet aircraft', 205, 790, 'Fourth airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1255, 'jet aircraft', 202, 810, 'Fifth airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES
(1256, 'fixed-wing', 214, 820, 'Sixth airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1257, 'jet aircraft', 200, 815, 'Seventh airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1258, 'jet aircraft', 209, 880, 'Eighth airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES
(1259, 'fixed-wing', 203, 800, 'Tenth airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES
(1260, 'fixed-wing', 260, 870, 'Eleventh airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1261, 'fixed-wing', 230, 835, 'Twelfth airline');
INSERT INTO airport.plane (id_plane, type, number_of_seats, speed, airline) VALUES 
(1262, 'jet aircraft', 209, 810, 'Thirteenth airline');

-- Filling in a table "repair"

INSERT INTO airport.repair (id_repair, id_plane, issues) VALUES (1, 1251, 'left wing');
INSERT INTO airport.repair (id_repair, id_plane, issues) VALUES (2, 1252, 'engine');
INSERT INTO airport.repair (id_repair, id_plane, issues) VALUES (3, 1253, 'right wing');
INSERT INTO airport.repair (id_repair, id_plane, issues) VALUES (4, 1251, 'security system');
INSERT INTO airport.repair (id_repair, id_plane, issues) VALUES (5, 1257, 'tail');
INSERT INTO airport.repair (id_repair, id_plane, issues) VALUES (6, 1262, 'right wing');
INSERT INTO airport.repair (id_repair, id_plane, issues) VALUES (7, 1255, 'right wing');

-- Filling in a table "voyage"

INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(1, 101, 141, 1251, 1001, 02:13:24, 2020-03-14 00:00:00, 2020-03-14 02:13:24, 195);
INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(2, 102, 142, 1252, 1002, 07:21:37, 2020-03-15 01:00:00, 2020-03-14 08:21:37, 201);
INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(3, 103, 141, 1253, 1003, 03:45:14, 2020-03-16 02:00:00, 2020-03-14 05:45:14, 193);
INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(4, 104, 143, 1254, 1004, 01:56:12, 2020-03-17 03:00:00, 2020-03-14 04:56:12, 191);
INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(5, 105, 145, 1256, 1001, 05:12:58, 2020-03-18 04:00:00, 2020-03-14 09:12:58, 194);
INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(6, 106, 144, 1258, 1006, 02:46:27, 2020-03-19 05:00:00, 2020-03-14 07:46:27, 187);
INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(7, 107, 144, 1257, 1002, 11:15:53, 2020-03-20 06:00:00, 2020-03-14 17:15:53, 163);
INSERT INTO airport.voyage (id_voyage, id_license, id_crew, id_plane, id_flight, time_on_borad, date_departure, date_arrival, number_of_sold_tickets) VALUES 
(8, 108, 141, 1260, 1005, 04:49:30, 2020-03-21 07:00:00, 2020-03-14 11:49:30, 191);

-- Filling in a table "flight"

INSERT INTO airport.flight (id_flight, departure_point, arrival_point, id_transit, distance) VALUES (1001, 'First City', 'Second City', null, 2462);
INSERT INTO airport.flight (id_flight, departure_point, arrival_point, id_transit, distance) VALUES (1002, 'First City', 'Third City', 1, 1728);
INSERT INTO airport.flight (id_flight, departure_point, arrival_point, id_transit, distance) VALUES (1003, 'First City', 'Fourth City', 2, 4845);
INSERT INTO airport.flight (id_flight, departure_point, arrival_point, id_transit, distance) VALUES (1004, 'Fifth City', 'First City', null, 1374);
INSERT INTO airport.flight (id_flight, departure_point, arrival_point, id_transit, distance) VALUES (1005, 'Sixth City', 'First City', null, 2938);
INSERT INTO airport.flight (id_flight, departure_point, arrival_point, id_transit, distance) VALUES (1006, 'Second City', 'First City', null, 2462);
INSERT INTO airport.flight (id_flight, departure_point, arrival_point, id_transit, distance) VALUES (1007, 'Seventh City', 'First City', null, 3826);

-- Filling in a table "transit"

INSERT INTO airport.transit (id_transit, date_departure_transit, date_arrival_transit, transit_points) VALUES 
(1, 2020-03-15 04:15:00, 2020-03-15 03:15:00, 'Airport One');
NSERT INTO airport.transit (id_transit, date_departure_transit, date_arrival_transit, transit_points) VALUES 
(2, 2020-03-16 03:25:00, 2020-03-16 02:45:00, 'Airport Two');

-- Filling in a table "license"

INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (101, 141, true);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (102, 142, true);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (103, 143, true);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (104, 144, false);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (105, 145, true);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (106, 146, true);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (107, 147, true);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (108, 148, true);
INSERT INTO airport.license (id_license, id_crew, license_existence) VALUES (109, 149, false);

-- Filling in a table "crew"

INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(141, 'First F.F.', 'Second S.S.', 'Third T.T.', 'Ninth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(142, 'Fifth F.F.', 'Second S.S.', 'Third T.T.', 'Fourth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(143, 'Sixth F.F.', 'Second S.S.', 'Eighth T.T.', 'Fourth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(144, 'Fifth F.F.', 'Seventh S.S.', 'Third T.T.', 'Fourth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(145, 'First F.F.', 'Eleventh S.S.', 'Eighth T.T.', 'Fourth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(146, 'First F.F.', 'Second S.S.', 'Third T.T.', 'Ninth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(147, 'Tenth F.F.', 'Second S.S.', 'Third T.T.', 'Fourth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(148, 'First F.F.', 'Eleventh S.S.', 'Third T.T.', 'Fourth F.F.');
INSERT INTO airport.crew (id_crew, commander, second_pilot, navigator, stewards) VALUES 
(149, 'Fifth F.F.', 'Seventh S.S.', 'Eighth T.T.', 'Ninth F.F.');

-- Primary keys

ALTER TABLE ONLY airport.worker
    ADD CONSTRAINT worker_pkey PRIMARY KEY (id_worker, id_plane, name_company, id_crew);

ALTER TABLE ONLY airport.company
    ADD CONSTRAINT company_pkey PRIMARY KEY (id_plane, name_company);
    
ALTER TABLE ONLY airport.plane
    ADD CONSTRAINT plane_pkey PRIMARY KEY (id_plane);
    
ALTER TABLE ONLY airport.repair
    ADD CONSTRAINT repair_pkey PRIMARY KEY (id_repair, id_plane);
    
ALTER TABLE ONLY airport.voyage
    ADD CONSTRAINT voyage_pkey PRIMARY KEY (id_voyage, id_plane, id_crew, id_license, id_flight);
  
ALTER TABLE ONLY airport.flight
    ADD CONSTRAINT flight_pkey PRIMARY KEY (id_flight);
    
ALTER TABLE ONLY airport.transit
    ADD CONSTRAINT transit_pkey PRIMARY KEY (id_transit);

ALTER TABLE ONLY airport.license
    ADD CONSTRAINT license_pkey PRIMARY KEY (id_crew, id_license);

ALTER TABLE ONLY airport.crew
    ADD CONSTRAINT crew_pkey PRIMARY KEY (id_crew);
 
-- Restrictions

ALTER TABLE ONLY airport.worker
    ADD CONSTRAINT id_worker UNIQUE (id_worker);

ALTER TABLE airport.worker
    ADD CONSTRAINT age CHECK ((vozrast < 150)) NOT VALID; 
   
ALTER TABLE airport.plane
    ADD CONSTRAINT number_of_seats CHECK ((number_of_seats < 1000)) NOT VALID;
    
-- Foreign keys

ALTER TABLE ONLY airport.worker
    ADD CONSTRAINT id_plane FOREIGN KEY (id_plane) REFERENCES airport.plane(id_plane);
    
ALTER TABLE ONLY airport.worker
    ADD CONSTRAINT name_company FOREIGN KEY (name_company) REFERENCES airport.company(name_company);
    
ALTER TABLE ONLY airport.worker
    ADD CONSTRAINT id_crew FOREIGN KEY (id_crew) REFERENCES airport.crew(id_crew);
    
ALTER TABLE ONLY airport.company
    ADD CONSTRAINT id_plane FOREIGN KEY (id_plane) REFERENCES airport.plane(id_plane);
  
ALTER TABLE ONLY airport.repair
    ADD CONSTRAINT id_plane FOREIGN KEY (id_plane) REFERENCES airport.plane(id_plane);
  
ALTER TABLE ONLY airport.voyage
    ADD CONSTRAINT id_plane FOREIGN KEY (id_plane) REFERENCES airport.plane(id_plane);

ALTER TABLE ONLY airport.voyage
    ADD CONSTRAINT id_crew FOREIGN KEY (id_crew) REFERENCES airport.crew(id_crew);

ALTER TABLE ONLY airport.voyage
    ADD CONSTRAINT id_license FOREIGN KEY (id_license) REFERENCES airport.voyage(id_license);    

ALTER TABLE ONLY airport.voyage
    ADD CONSTRAINT id_flight FOREIGN KEY (id_flight) REFERENCES airport.flight(id_flight);

ALTER TABLE ONLY airport.license
    ADD CONSTRAINT id_crew FOREIGN KEY (id_crew) REFERENCES airport.crew(id_crew);
