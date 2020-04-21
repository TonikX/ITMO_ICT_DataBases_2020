{\rtf1\ansi\ansicpg1252\cocoartf2512
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fnil\fcharset0 HelveticaNeue;}
{\colortbl;\red255\green255\blue255;\red87\green96\blue106;}
{\*\expandedcolortbl;;\cssrgb\c41569\c45098\c49020;}
\paperw11900\paperh16840\margl1440\margr1440\vieww14420\viewh14300\viewkind0
\deftab720
\pard\pardeftab720\partightenfactor0

\f0\fs24 \cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1089 \u1087 \u1086 \u1085 \u1089 \u1086 \u1088 \u1086 \u1074 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 CREATE TABLE show."Sponsors"\
(\
    "Organisation_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Occupation" text COLLATE pg_catalog."default" NOT NULL,\
    CONSTRAINT "Sponsors_pkey" PRIMARY KEY ("Organisation_name")\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Sponsors"\
    OWNER to postgres;\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1089 \u1087 \u1086 \u1085 \u1089 \u1086 \u1088 \u1086 \u1074 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Sponsors" ("Organisation_name", "Occupation") VALUES \
('Alpari', 'Charity\'92),\
('Aliprint', 'Advertisement\'92),\
('Mondial', 'Clothes\'92),\
('Bushe', 'Bakery\'92),\
('Pedigree', 'Dog food');\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1088 \u1080 \u1085 \u1075 \u1086 \u1074 \
CREATE TABLE show."Arena"\
(\
    "Arena_number" integer NOT NULL,\
    "Arena_name" text COLLATE pg_catalog."default" NOT NULL,\
    CONSTRAINT "\uc0\u1056 \u1080 \u1085 \u1075 _pkey" PRIMARY KEY ("Arena_number")\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Arena"\
    OWNER to postgres;\
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1088 \u1080 \u1085 \u1075 \u1086 \u1074 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Arena"("Arena_number", "Arena_name") VALUES \
(1, 'Lenexpo\'92),\
(2, 'Sibur\'92),\
(3, \'91M-1\'92),\
(4, 'Nova Arena\'92),\
(5, 'Yubileiniy');\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1091 \u1087 \u1088 \u1072 \u1078 \u1085 \u1077 \u1085 \u1080 \u1081 \
CREATE TABLE show."Exercises"\
(\
    "Exercise_number" integer NOT NULL,\
    "Exercise_name" text COLLATE pg_catalog."default" NOT NULL,\
    CONSTRAINT "Exercises _pkey" PRIMARY KEY ("Exercise_number")\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Exercises"\
    OWNER to postgres;\
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1091 \u1087 \u1088 \u1072 \u1078 \u1085 \u1077 \u1085 \u1080 \u1081 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Exercises" ("Exercise_number", "Exercise_name") VALUES \
(1, 'Jumping\'92),\
(2, 'Commands\'92),\
(3, 'Showing');\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1087 \u1086 \u1088 \u1086 \u1076 \
CREATE TABLE show."Breed"\
(\
    "Breed_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Arena_number" integer,\
    CONSTRAINT "Breed_pkey" PRIMARY KEY ("Breed_name"),\
    CONSTRAINT "Arena_number_breed" FOREIGN KEY ("Arena_number")\
        REFERENCES show."Arena" ("Arena_number") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Breed"\
    OWNER to postgres;\
-- Index: fki_Arena_number\
\
-- DROP INDEX show."fki_Arena_number";\
\
CREATE INDEX "fki_Arena_number"\
    ON show."Breed" USING btree\
    ("Arena_number" ASC NULLS LAST)\
    TABLESPACE pg_default;\
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1087 \u1086 \u1088 \u1086 \u1076 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Breed"("Arena_number", "Breed_name") VALUES \
(1, 'Dalmatian\'92),\
(2, 'Terrier\'92),\
(3, 'Spaniel\'92),\
(4, 'Spitz\'92),\
(5, 'Pudel');\
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1074 \u1083 \u1072 \u1076 \u1077 \u1083 \u1100 \u1094 \u1077 \u1074 \
CREATE TABLE show."Owner"\
(\
    "Owner_passport" text COLLATE pg_catalog."default" NOT NULL,\
    "Owner_name" text COLLATE pg_catalog."default" NOT NULL,\
    CONSTRAINT "\uc0\u1042 \u1083 \u1072 \u1076 \u1077 \u1083 \u1077 \u1094 _pkey" PRIMARY KEY ("Owner_passport")\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Owner"\
    OWNER to postgres;\
\
-- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1074 \u1083 \u1072 \u1076 \u1077 \u1083 \u1100 \u1094 \u1077 \u1074 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Owner"("Owner_passport", "Owner_name") VALUES \
(126745, 'Ivan'),\
(673849, 'Anna'),\
(346829, 'Elena'),\
(209483, 'Igor'),\
(673948, 'Andry');\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1101 \u1082 \u1089 \u1087 \u1077 \u1088 \u1090 \u1086 \u1074 \
CREATE TABLE show."Expert"\
(\
    "Expert_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Club" text COLLATE pg_catalog."default",\
    "Arena_number" integer,\
    CONSTRAINT "Expert_pkey" PRIMARY KEY ("Expert_name"),\
    CONSTRAINT "Arena_number" FOREIGN KEY ("Arena_number")\
        REFERENCES show."Arena" ("Arena_number") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID,\
    CONSTRAINT "Arena_number_expert" FOREIGN KEY ("Arena_number")\
        REFERENCES show."Arena" ("Arena_number") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Expert"\
    OWNER to postgres;\
-- Index: fki_Arena_number_expert\
\
-- DROP INDEX show."fki_Arena_number_expert";\
\
CREATE INDEX "fki_Arena_number_expert"\
    ON show."Expert" USING btree\
    ("Arena_number" ASC NULLS LAST)\
    TABLESPACE pg_default;\
\
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1101 \u1082 \u1089 \u1087 \u1077 \u1088 \u1090 \u1086 \u1074 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Expert"("Expert_name", "Club", "Arena_number") VALUES \
('Anton', 'Friends', 1),\
('Frederic', 'Polo', 2),\
('Yuriy', 'Cornuel', 3),\
('Vladimir', 'Cornuel', 4),\
('Jorsh', 'Friends', 5);\
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1089 \u1086 \u1073 \u1072 \u1082 -\u1091 \u1095 \u1072 \u1089 \u1090 \u1085 \u1080 \u1082 \u1086 \u1074 \
CREATE TABLE show."Dog_participant"\
(\
    "Dog_document_number" integer NOT NULL,\
    "Breed_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Dog_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Dog_age" integer NOT NULL,\
    "Club" text COLLATE pg_catalog."default",\
    "Classiness" text COLLATE pg_catalog."default",\
    "Mother_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Father_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Last_vaccination_date" date NOT NULL,\
    "Participation_payment" boolean NOT NULL,\
    "Owner_passport" text COLLATE pg_catalog."default",\
    CONSTRAINT "Dog_participant_pkey" PRIMARY KEY ("Dog_document_number"),\
    CONSTRAINT "Breed_name" FOREIGN KEY ("Breed_name")\
        REFERENCES show."Breed" ("Breed_name") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID,\
    CONSTRAINT "Owner_passport" FOREIGN KEY ("Owner_passport")\
        REFERENCES show."Owner" ("Owner_passport") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Dog_participant"\
    OWNER to postgres;\
-- Index: fki_Breed_name\
\
-- DROP INDEX show."fki_Breed_name";\
\
CREATE INDEX "fki_Breed_name"\
    ON show."Dog_participant" USING btree\
    ("Breed_name" COLLATE pg_catalog."default" ASC NULLS LAST)\
    TABLESPACE pg_default;\
-- Index: fki_Owner_passport\
\
-- DROP INDEX show."fki_Owner_passport";\
\
CREATE INDEX "fki_Owner_passport"\
    ON show."Dog_participant" USING btree\
    ("Owner_passport" COLLATE pg_catalog."default" ASC NULLS LAST)\
    TABLESPACE pg_default;\
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1089 \u1086 \u1073 \u1072 \u1082 -\u1091 \u1095 \u1072 \u1089 \u1090 \u1085 \u1080 \u1082 \u1086 \u1074 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Dog_participant"("Dog_document_number", "Breed_name", "Dog_name", "Dog_age", "Club", "Classiness", "Mother_name", "Father_name", "Last_vaccination_date", "Participation_payment", "Owner_passport") VALUES \
	(127809, 'Pudel', 'Lacky', 6, 'Friend', '7', 'Jecky', 'Boby', '12/03/2020', 'TRUE', 673849),\
	(178459, 'Dalmatian', 'Scooby', 5, 'Cornuel', '4', 'Coco', 'Max', '03/12/2020', 'TRUE', 673948),\
	(183940, 'Spaniel', 'Bella', 7, 'Friend', '9', 'Lola', 'Oscar', '02/21/2020', 'TRUE', 126745),\
	(189304, 'Spitz', 'Molly', 6, 'Cornuel', '6', 'Rosie', 'Milo', '03/17/2020', 'TRUE', 346829),\
	(289473, 'Pudel', 'Buddy', 8, 'Polo', '8', 'Daisy', 'Jack', '02/20/2020', 'TRUE', 209483);\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1074 \u1099 \u1089 \u1090 \u1072 \u1074 \u1086 \u1082 \
CREATE TABLE show."Show"\
(\
    "ID_show" integer NOT NULL,\
    "Organisation_name" text COLLATE pg_catalog."default",\
    "Show_name" text COLLATE pg_catalog."default" NOT NULL,\
    "Location" text COLLATE pg_catalog."default" NOT NULL,\
    "Date" date NOT NULL,\
    CONSTRAINT "Show_pkey" PRIMARY KEY ("ID_show"),\
    CONSTRAINT "Organisation_name" FOREIGN KEY ("Organisation_name")\
        REFERENCES show."Sponsors" ("Organisation_name") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Show"\
    OWNER to postgres;\
-- Index: fki_Organisation_name\
\
-- DROP INDEX show."fki_Organisation_name";\
\
CREATE INDEX "fki_Organisation_name"\
    ON show."Show" USING btree\
    ("Organisation_name" COLLATE pg_catalog."default" ASC NULLS LAST)\
    TABLESPACE pg_default;\
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1074 \u1099 \u1089 \u1090 \u1072 \u1074 \u1086 \u1082 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Show"("ID_show", "Organisation_name", "Show_name", "Location", "Date")\
	VALUES \
	(1, 'Pedigree', 'Best prize', 'Saint Petersburg', '04/28/2020'),\
	(2, NULL, 'Fantom', 'Saint Petersburg', '04/21/2020'),\
	(3, 'Aliprint', 'City dog show', 'Saint Petersburg', '04/18/2020'),\
	(4, 'Alpari', 'Champion', 'Moscow', '04/19/2020'),\
	(5, 'Pedigree', 'Rumor', 'Saint Petersburg', '04/12/2020');\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1088 \u1077 \u1075 \u1080 \u1089 \u1090 \u1088 \u1072 \u1094 \u1080 \u1081 \
CREATE TABLE show."Registration"\
(\
    "ID_of_contract" integer NOT NULL,\
    "Dog_document_number" integer NOT NULL,\
    "Arena_number" integer NOT NULL,\
    "ID_show" integer,\
    CONSTRAINT "Registration_pkey" PRIMARY KEY ("ID_of_contract"),\
    CONSTRAINT "Arena_number_registartion" FOREIGN KEY ("Arena_number")\
        REFERENCES show."Arena" ("Arena_number") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID,\
    CONSTRAINT "Dog_document_number_registration" FOREIGN KEY ("Dog_document_number")\
        REFERENCES show."Dog_participant" ("Dog_document_number") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID,\
    CONSTRAINT "ID_show" FOREIGN KEY ("ID_show")\
        REFERENCES show."Show" ("ID_show") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID,\
    CONSTRAINT "ID_show_reg" FOREIGN KEY ("ID_show")\
        REFERENCES show."Show" ("ID_show") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Registration"\
    OWNER to postgres;\
-- Index: fki_Arena_number_registartion\
\
-- DROP INDEX show."fki_Arena_number_registartion";\
\
CREATE INDEX "fki_Arena_number_registartion"\
    ON show."Registration" USING btree\
    ("Arena_number" ASC NULLS LAST)\
    TABLESPACE pg_default;\
-- Index: fki_Dog_document_number_registration\
\
-- DROP INDEX show."fki_Dog_document_number_registration";\
\
CREATE INDEX "fki_Dog_document_number_registration"\
    ON show."Registration" USING btree\
    ("Dog_document_number" ASC NULLS LAST)\
    TABLESPACE pg_default;\
-- Index: fki_ID_show_reg\
\
-- DROP INDEX show."fki_ID_show_reg";\
\
CREATE INDEX "fki_ID_show_reg"\
    ON show."Registration" USING btree\
    ("ID_show" ASC NULLS LAST)\
    TABLESPACE pg_default;\
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1088 \u1077 \u1075 \u1080 \u1089 \u1090 \u1088 \u1072 \u1094 \u1080 \u1081 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Registration"("ID_of_contract", "Dog_document_number", "Arena_number", "ID_show")\
	VALUES \
	(1, 127809, 5, 2),\
	(2, 178459, 1, 2),\
	(3, 183940, 3, 5),\
	(4, 189304, 4, 5),\
	(5, 289473, 5, 2);\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1084 \u1077 \u1076 \u1086 \u1089 \u1084 \u1086 \u1090 \u1088 \u1086 \u1074 \
CREATE TABLE show."Medical_check"\
(\
    "ID_medical_check" integer NOT NULL,\
    "Dog_document_number" integer NOT NULL,\
    "ID_show" integer NOT NULL,\
    "Result" text COLLATE pg_catalog."default" NOT NULL,\
    CONSTRAINT "Medical_check_pkey" PRIMARY KEY ("ID_medical_check"),\
    CONSTRAINT "Dog_document_number_medical" FOREIGN KEY ("Dog_document_number")\
        REFERENCES show."Dog_participant" ("Dog_document_number") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID,\
    CONSTRAINT "ID_show_medical" FOREIGN KEY ("ID_show")\
        REFERENCES show."Show" ("ID_show") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."Medical_check"\
    OWNER to postgres;\
-- Index: fki_Dog_document_number_medical\
\
-- DROP INDEX show."fki_Dog_document_number_medical";\
\
CREATE INDEX "fki_Dog_document_number_medical"\
    ON show."Medical_check" USING btree\
    ("Dog_document_number" ASC NULLS LAST)\
    TABLESPACE pg_default;\
-- Index: fki_ID_show_medical\
\
-- DROP INDEX show."fki_ID_show_medical";\
\
CREATE INDEX "fki_ID_show_medical"\
    ON show."Medical_check" USING btree\
    ("ID_show" ASC NULLS LAST)\
    TABLESPACE pg_default;\
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 \
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1084 \u1077 \u1076 \u1086 \u1089 \u1084 \u1086 \u1090 \u1088 \u1086 \u1074 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."Medical_check"("ID_medical_check", "Dog_document_number", "ID_show", "Result")\
	VALUES \
	(1, 127809, 2, 'Allowed'),\
	(2, 178459, 2, 'Allowed'),\
	(3, 289473, 2, 'Not allowed'),\
	(4, 183940, 5, 'Allowed'),\
	(5, 189304, 5, 'Allowed');\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1057 \u1086 \u1079 \u1076 \u1072 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1087 \u1088 \u1086 \u1090 \u1086 \u1082 \u1086 \u1083 \u1086 \u1074  \u1074 \u1099 \u1089 \u1090 \u1091 \u1087 \u1083 \u1077 \u1085 \u1080 \u1081 \
\pard\pardeftab560\slleading20\pardirnatural\partightenfactor0
\cf0 CREATE TABLE show."\uc0\u1057 ompetition_protocol"\
(\
    "ID_note" integer NOT NULL,\
    "Exercise_number" integer NOT NULL,\
    "ID_of_contract" integer NOT NULL,\
    "Score" integer NOT NULL,\
    CONSTRAINT "\uc0\u1057 ompetition_protocol_pkey" PRIMARY KEY ("ID_note"),\
    CONSTRAINT "ID_of_contract" FOREIGN KEY ("ID_of_contract")\
        REFERENCES show."Registration" ("ID_of_contract") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE show."\uc0\u1057 ompetition_protocol"\
    OWNER to postgres;\
-- Index: fki_Exercise_number\
\
-- DROP INDEX show."fki_Exercise_number";\
\
CREATE INDEX "fki_Exercise_number"\
    ON show."\uc0\u1057 ompetition_protocol" USING btree\
    ("Exercise_number" ASC NULLS LAST)\
    TABLESPACE pg_default;\
-- Index: fki_ID_show\
\
-- DROP INDEX show."fki_ID_show";\
\
CREATE INDEX "fki_ID_show"\
    ON show."\uc0\u1057 ompetition_protocol" USING btree\
    ("ID_of_contract" ASC NULLS LAST)\
    TABLESPACE pg_default;\
\
\pard\pardeftab720\partightenfactor0
\cf0 -- \uc0\u1047 \u1072 \u1087 \u1086 \u1083 \u1085 \u1103 \u1077 \u1084  \u1090 \u1072 \u1073 \u1083 \u1080 \u1094 \u1091  \u1087 \u1088 \u1086 \u1090 \u1086 \u1082 \u1086 \u1083 \u1086 \u1074  \u1074 \u1099 \u1089 \u1090 \u1091 \u1087 \u1083 \u1077 \u1085 \u1080 \u1081 \
\pard\pardeftab560\slleading20\partightenfactor0
\cf0 INSERT INTO show."\uc0\u1057 ompetition_protocol"("ID_note", "Exercise_number", "ID_of_contract", "Score")\
	VALUES \
	(1, 1, 1, 7),\
	(2, 2, 1, 10),\
	(3, 3, 1, 5),\
	(4, 1, 2, 8),\
	(5, 2, 2, 9),\
	(6, 1, 3, 10);}